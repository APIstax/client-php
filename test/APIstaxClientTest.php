<?php

use \PHPUnit\Framework\TestCase;
use \donatj\MockWebServer\MockWebServer;
use \donatj\MockWebServer\Response;

class APIstaxClientTest extends TestCase
{
    /**
     * @var MockWebServer
     */
    private $server;

    /**
     * @var \APIstax\APIstaxClient
     */
    private $client;

    /**
     * @before
     */
    public function beforeEach()
    {
        $this->server = new MockWebServer();
        $this->server->start();

        $config = new \APIstax\Configuration();
        $config->setHost($this->server->getServerRoot());
        $config->setApiKey("API_KEY");

        $this->client = new \APIstax\APIstaxClient($config);
    }

    /**
     * @after
     */
    public function afterEach()
    {
        if ($this->server !== null) {
            $this->server->stop();
        }
    }

    /**
     * @test
     */
    public function testError()
    {
        $response = new Response(
            '{"messages":["errorMessage"]}',
            ['Content-Type' => 'application/json'],
            500
        );

        $this->server->setResponseOfPath("/v1/geocode/search", $response);

        try {
            $payload = new \APIstax\Models\GeocodeSearchPayload();
            $payload->setQuery("query");
            $this->client->geocodeSearch($payload);
        } catch (\APIstax\APIstaxException $e) {
            self::assertNotNull($e->getMessages());
            self::assertSame(1, count($e->getMessages()));
            self::assertSame("errorMessage", $e->getMessages()[0]);
        }
    }

    /**
     * @test
     */
    public function testConvertHtmlToPdf()
    {
        $response = new Response('PDF', ['Content-Type' => 'application/pdf']);
        $this->server->setResponseOfPath("/v1/html-to-pdf", $response);

        $payload = new \APIstax\Models\HtmlPayload();
        $payload->setContent("content");
        $payload->setHeader("header");
        $payload->setFooter("footer");
        $payload->setMarginTop(1.1);
        $payload->setMarginBottom(1.2);
        $payload->setMarginStart(1.3);
        $payload->setMarginEnd(1.4);
        $payload->setWidth(10.5);
        $payload->setHeight(5.25);
        $payload->setLandscape(true);
        $payload->setPrintBackground(true);

        $result = $this->client->convertHtmlToPdf($payload);

        self::assertSame("PDF", $result->fgets());
    }

    /**
     * @test
     */
    public function testGenerateEpcQrCode()
    {
        $response = new Response('EPC-QR-CODE', ['Content-Type' => 'image/png']);
        $this->server->setResponseOfPath("/v1/epc-qr-code", $response);

        $payload = new \APIstax\Models\EpcQrCodePayload();
        $payload->setAmount(1.1);
        $payload->setBic("bic");
        $payload->setCurrency("currency");
        $payload->setIban("iban");
        $payload->setRecipient("recipient");
        $payload->setReference("reference");
        $payload->setText("text");
        $payload->setSize(500);
        $payload->setFrame(true);
        $payload->setMessage("message");

        $result = $this->client->generateEpcQrCode($payload);

        self::assertSame("EPC-QR-CODE", $result->fgets());
    }

    /**
     * @test
     */
    public function testVerifyVatId()
    {
        $response = new Response(
            '{"valid":true,"name":"name","address":"address","countryCode":"countryCode"}',
            ['Content-Type' => 'application/json']
        );

        $this->server->setResponseOfPath("/v1/vat-verification", $response);

        $payload = new \APIstax\Models\VatVerificationPayload();
        $payload->setVatId("VAT_ID");

        $result = $this->client->verifyVatId($payload);

        self::assertNotNull($result);
        self::assertSame(true, $result->getValid());
        self::assertSame("name", $result->getName());
        self::assertSame("address", $result->getAddress());
        self::assertSame("countryCode", $result->getCountryCode());
    }

    /**
     * @test
     */
    public function testGeocodeSearch()
    {
        $response = new Response(
            '{"position":{"latitude":1.1,"longitude":2.2},"address":{"houseNumber":"houseNumber","street":"street","city":"city","postalCode":"postalCode","country":"country","countryCode":"countryCode"}}',
            ['Content-Type' => 'application/json']
        );

        $this->server->setResponseOfPath("/v1/geocode/search", $response);

        $payload = new \APIstax\Models\GeocodeSearchPayload();
        $payload->setQuery("query");
        $payload->setLanguage("language");

        $result = $this->client->geocodeSearch($payload);
        $this->assertGeocodeResult($result);
    }

    /**
     * @test
     */
    public function testGeocodeReverse()
    {
        $response = new Response(
            '{"position":{"latitude":1.1,"longitude":2.2},"address":{"houseNumber":"houseNumber","street":"street","city":"city","postalCode":"postalCode","country":"country","countryCode":"countryCode"}}',
            ['Content-Type' => 'application/json']
        );

        $this->server->setResponseOfPath("/v1/geocode/reverse", $response);

        $payload = new \APIstax\Models\GeocodeReversePayload();
        $payload->setLatitude(1.1);
        $payload->setLongitude(2.2);
        $payload->setLanguage("language");

        $result = $this->client->geocodeReverse($payload);
        $this->assertGeocodeResult($result);
    }

    private function assertGeocodeResult(\APIstax\Models\GeocodeResult $result)
    {
        self::assertNotNull($result);

        $position = $result->getPosition();
        self::assertNotNull($position);
        self::assertSame(1.1, $position->getLatitude());
        self::assertSame(2.2, $position->getLongitude());

        $address = $result->getAddress();
        self::assertNotNull($address);
        self::assertSame("houseNumber", $address->getHouseNumber());
        self::assertSame("street", $address->getStreet());
        self::assertSame("city", $address->getCity());
        self::assertSame("postalCode", $address->getPostalCode());
        self::assertSame("country", $address->getCountry());
        self::assertSame("countryCode", $address->getCountryCode());
    }

    /**
     * @test
     */
    public function testFetchIndex()
    {
        $response = new Response(
            '{"id":"at-cpi-1","name":"name","source":"source","frequency":"YEARLY","values":[{"year":1,"month":2,"value":10.10}]}',
            ['Content-Type' => 'application/json']
        );

        $this->server->setResponseOfPath("/v1/indexes/at-cpi-1", $response);

        $result = $this->client->fetchIndex("at-cpi-1", "YEARLY");

        self::assertNotNull($result);
        self::assertSame("at-cpi-1", $result->getId());
        self::assertSame("name", $result->getName());
        self::assertSame("source", $result->getSource());
        self::assertSame(\APIstax\Models\IndexFrequency::YEARLY, $result->getFrequency());
        self::assertNotNull($result->getValues());
        self::assertSame(1, count($result->getValues()));

        $value = $result->getValues()[0];

        self::assertSame(1, $value->getYear());
        self::assertSame(2, $value->getMonth());
        self::assertSame(10.10, $value->getValue());
    }
}