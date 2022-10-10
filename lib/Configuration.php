<?php

namespace APIstax;

class Configuration
{
    /**
     * @var Configuration
     */
    private static $defaultConfiguration;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $tempFolderPath;

    public function __construct()
    {
        $this->host = 'https://api.apistax.io';
        $this->tempFolderPath = sys_get_temp_dir();
    }

    /**
     * @return Configuration
     */
    public static function getDefaultConfiguration(): Configuration
    {
        if (self::$defaultConfiguration === null) {
            self::$defaultConfiguration = new Configuration();
        }
        return self::$defaultConfiguration;
    }

    /**
     * @param Configuration $default
     */
    public static function setDefaultConfiguration(Configuration $default): void
    {
        self::$defaultConfiguration = $default;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getTempFolderPath(): string
    {
        return $this->tempFolderPath;
    }

    /**
     * @param string $tempFolderPath
     */
    public function setTempFolderPath(string $tempFolderPath): void
    {
        $this->tempFolderPath = $tempFolderPath;
    }
}