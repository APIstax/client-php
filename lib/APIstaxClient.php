<?php

namespace APIstax;

use APIstax\Models\EpcQrCodePayload;
use APIstax\Models\GeocodeResult;
use APIstax\Models\GeocodeReversePayload;
use APIstax\Models\GeocodeSearchPayload;
use APIstax\Models\HtmlPayload;
use APIstax\Models\IndexResult;
use APIstax\Models\ModelInterface;
use APIstax\Models\VatVerificationPayload;
use APIstax\Models\VatVerificationResult;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Utils;
use Psr\Http\Message\ResponseInterface;
use SplFileObject;

class APIstaxClient
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var Configuration
     */
    private $configuration;

    public function __construct(Configuration $configuration = null)
    {
        $this->client = new Client();

        if($configuration === null) {
            $this->configuration = Configuration::getDefaultConfiguration();
        } else {
            $this->configuration = $configuration;
        }
    }

    /**
     * Convert HTML to PDF
     *
     * @param HtmlPayload $payload HTML payload to convert (required)
     *
     * @return SplFileObject
     * @throws APIstaxException on non-2xx response
     */
    public function convertHtmlToPdf(HtmlPayload $payload): SplFileObject
    {
        return $this->requestBinary("/v1/html-to-pdf", $payload);
    }

    /**
     * Generate a valid EPC QR Code
     *
     * @param EpcQrCodePayload $payload QR Code payload to generate (required)
     *
     * @return SplFileObject
     * @throws APIstaxException on non-2xx response
     */
    public function generateEpcQrCode(EpcQrCodePayload $payload): SplFileObject
    {
        return $this->requestBinary("/v1/epc-qr-code", $payload);
    }

    /**
     * Verify a companies VAT ID if it is valid
     *
     * @param VatVerificationPayload $payload VAT ID payload to verify (required)
     *
     * @return VatVerificationResult
     * @throws APIstaxException on non-2xx response
     */
    public function verifyVatId(VatVerificationPayload $payload): VatVerificationResult
    {
        return $this->requestJson("/v1/vat-verification", $payload, null, "\APIstax\Models\VatVerificationResult");
    }

    /**
     * Convert a known address to geo-coordinates
     *
     * @param GeocodeSearchPayload $payload Query payload to search for (required)
     *
     * @return GeocodeResult|null
     * @throws APIstaxException on non-2xx response
     */
    public function geocodeSearch(GeocodeSearchPayload $payload): ?GeocodeResult
    {
        return $this->requestJson("/v1/geocode/search", $payload, null, "\APIstax\Models\GeocodeSearchPayload");
    }

    /**
     * Convert geo-coordinates to a postal address
     *
     * @param GeocodeReversePayload $payload Coordinates payload to search for (required)
     *
     * @return GeocodeResult|null
     * @throws APIstaxException on non-2xx response
     */
    public function geocodeReverse(GeocodeReversePayload $payload): ?GeocodeResult
    {
        return $this->requestJson("/v1/geocode/reverse", $payload, null, "\APIstax\Models\GeocodeReversePayload");
    }

    /**
     * List various, always up-to-date indexes like consumer price index for many countries
     *
     * @param string $index The identification of the index. A complete list of available indexes can be found in the documentation (required)
     * @param string|null $frequency The frequency in which the index is published (optional)
     *
     * @return IndexResult|null
     * @throws APIstaxException on non-2xx response
     */
    public function fetchIndex(string $index, string $frequency = null): ?IndexResult
    {
        $query = [
            'frequency' => $frequency
        ];
        return $this->requestJson("/v1/indexes/".$index, null, $query, "\APIstax\Models\IndexResult");
    }

    /**
     * @throws APIstaxException
     */
    private function requestBinary(string $path, ModelInterface $body): SplFileObject
    {
        $response = $this->request($path, $body);
        $content = $response->getBody();

        return ObjectSerializer::deserialize($content, '\SplFileObject', []);
    }

    /**
     * @throws APIstaxException
     */
    private function requestJson(string $path, $body, $query, string $type): ModelInterface
    {
        $response = $this->request($path, $body, $query);
        $content = (string)$response->getBody();

        return ObjectSerializer::deserialize($content, $type, []);
    }

    /**
     * @throws APIstaxException
     */
    private function request(string $path, $body, $query = null): ResponseInterface
    {
        $url = $this->configuration->getHost() . $path;
        $options = $this->createRequestOptions($body, $query);

        try {
            if (isset($body)) {
                $response = $this->client->post($url, $options);
            } else {
                $response = $this->client->get($url, $options);
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                $error = ObjectSerializer::deserialize((string)$response->getBody(), '\APIstax\Models\ErrorMessage', []);
                throw new APIstaxException($error->getMessages());
            }

            return $response;
        } catch (GuzzleException $e) {
            throw new APIstaxException(null, $e);
        }
    }

    private function createRequestOptions($body, $query): array
    {
        $options = [
            'headers' => [
                'User-Agent' => 'apistax-php-client',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->configuration->getApiKey()
            ],
            'http_errors' => false
        ];

        if (isset($query)) {
            $options['query'] = $query;
        }

        if (isset($body)) {
            $options['body'] = Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($body));
        }

        return $options;
    }
}