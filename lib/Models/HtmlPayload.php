<?php
/**
 * HtmlPayload
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  APIstax
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * APIstax
 *
 * No description provided (generated by Openapi Generator https://github.com/openapitools/openapi-generator)
 *
 * The version of the OpenAPI document: 1.1.0
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.4.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace APIstax\Models;

use \ArrayAccess;
use \APIstax\ObjectSerializer;

/**
 * HtmlPayload Class Doc Comment
 *
 * @category Class
 * @package  APIstax
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class HtmlPayload implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'HtmlPayload';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'content' => 'string',
        'header' => 'string',
        'footer' => 'string',
        'width' => 'float',
        'height' => 'float',
        'margin_top' => 'float',
        'margin_bottom' => 'float',
        'margin_start' => 'float',
        'margin_end' => 'float',
        'landscape' => 'bool',
        'print_background' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'content' => null,
        'header' => null,
        'footer' => null,
        'width' => 'float',
        'height' => 'float',
        'margin_top' => 'float',
        'margin_bottom' => 'float',
        'margin_start' => 'float',
        'margin_end' => 'float',
        'landscape' => null,
        'print_background' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'content' => 'content',
        'header' => 'header',
        'footer' => 'footer',
        'width' => 'width',
        'height' => 'height',
        'margin_top' => 'marginTop',
        'margin_bottom' => 'marginBottom',
        'margin_start' => 'marginStart',
        'margin_end' => 'marginEnd',
        'landscape' => 'landscape',
        'print_background' => 'printBackground'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'content' => 'setContent',
        'header' => 'setHeader',
        'footer' => 'setFooter',
        'width' => 'setWidth',
        'height' => 'setHeight',
        'margin_top' => 'setMarginTop',
        'margin_bottom' => 'setMarginBottom',
        'margin_start' => 'setMarginStart',
        'margin_end' => 'setMarginEnd',
        'landscape' => 'setLandscape',
        'print_background' => 'setPrintBackground'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'content' => 'getContent',
        'header' => 'getHeader',
        'footer' => 'getFooter',
        'width' => 'getWidth',
        'height' => 'getHeight',
        'margin_top' => 'getMarginTop',
        'margin_bottom' => 'getMarginBottom',
        'margin_start' => 'getMarginStart',
        'margin_end' => 'getMarginEnd',
        'landscape' => 'getLandscape',
        'print_background' => 'getPrintBackground'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['content'] = $data['content'] ?? null;
        $this->container['header'] = $data['header'] ?? null;
        $this->container['footer'] = $data['footer'] ?? null;
        $this->container['width'] = $data['width'] ?? 21;
        $this->container['height'] = $data['height'] ?? 29.7;
        $this->container['margin_top'] = $data['margin_top'] ?? 1;
        $this->container['margin_bottom'] = $data['margin_bottom'] ?? 1;
        $this->container['margin_start'] = $data['margin_start'] ?? 1;
        $this->container['margin_end'] = $data['margin_end'] ?? 1;
        $this->container['landscape'] = $data['landscape'] ?? false;
        $this->container['print_background'] = $data['print_background'] ?? false;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['content'] === null) {
            $invalidProperties[] = "'content' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->container['content'];
    }

    /**
     * Sets content
     *
     * @param string $content The HTML document to be converted
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->container['content'] = $content;

        return $this;
    }

    /**
     * Gets header
     *
     * @return string|null
     */
    public function getHeader()
    {
        return $this->container['header'];
    }

    /**
     * Sets header
     *
     * @param string|null $header A HTML document used as PDF header
     *
     * @return self
     */
    public function setHeader($header)
    {
        $this->container['header'] = $header;

        return $this;
    }

    /**
     * Gets footer
     *
     * @return string|null
     */
    public function getFooter()
    {
        return $this->container['footer'];
    }

    /**
     * Sets footer
     *
     * @param string|null $footer A HTML document used as PDF footer
     *
     * @return self
     */
    public function setFooter($footer)
    {
        $this->container['footer'] = $footer;

        return $this;
    }

    /**
     * Gets width
     *
     * @return float|null
     */
    public function getWidth()
    {
        return $this->container['width'];
    }

    /**
     * Sets width
     *
     * @param float|null $width Page width in centimeter
     *
     * @return self
     */
    public function setWidth($width)
    {
        $this->container['width'] = $width;

        return $this;
    }

    /**
     * Gets height
     *
     * @return float|null
     */
    public function getHeight()
    {
        return $this->container['height'];
    }

    /**
     * Sets height
     *
     * @param float|null $height Page height in centimeter
     *
     * @return self
     */
    public function setHeight($height)
    {
        $this->container['height'] = $height;

        return $this;
    }

    /**
     * Gets margin_top
     *
     * @return float|null
     */
    public function getMarginTop()
    {
        return $this->container['margin_top'];
    }

    /**
     * Sets margin_top
     *
     * @param float|null $margin_top Top page margin in centimeter
     *
     * @return self
     */
    public function setMarginTop($margin_top)
    {
        $this->container['margin_top'] = $margin_top;

        return $this;
    }

    /**
     * Gets margin_bottom
     *
     * @return float|null
     */
    public function getMarginBottom()
    {
        return $this->container['margin_bottom'];
    }

    /**
     * Sets margin_bottom
     *
     * @param float|null $margin_bottom Bottom page margin in centimeter
     *
     * @return self
     */
    public function setMarginBottom($margin_bottom)
    {
        $this->container['margin_bottom'] = $margin_bottom;

        return $this;
    }

    /**
     * Gets margin_start
     *
     * @return float|null
     */
    public function getMarginStart()
    {
        return $this->container['margin_start'];
    }

    /**
     * Sets margin_start
     *
     * @param float|null $margin_start Start (left) page margin in centimeter
     *
     * @return self
     */
    public function setMarginStart($margin_start)
    {
        $this->container['margin_start'] = $margin_start;

        return $this;
    }

    /**
     * Gets margin_end
     *
     * @return float|null
     */
    public function getMarginEnd()
    {
        return $this->container['margin_end'];
    }

    /**
     * Sets margin_end
     *
     * @param float|null $margin_end End (right) page margin in centimeter
     *
     * @return self
     */
    public function setMarginEnd($margin_end)
    {
        $this->container['margin_end'] = $margin_end;

        return $this;
    }

    /**
     * Gets landscape
     *
     * @return bool|null
     */
    public function getLandscape()
    {
        return $this->container['landscape'];
    }

    /**
     * Sets landscape
     *
     * @param bool|null $landscape Page orientation
     *
     * @return self
     */
    public function setLandscape($landscape)
    {
        $this->container['landscape'] = $landscape;

        return $this;
    }

    /**
     * Gets print_background
     *
     * @return bool|null
     */
    public function getPrintBackground()
    {
        return $this->container['print_background'];
    }

    /**
     * Sets print_background
     *
     * @param bool|null $print_background Print background graphics
     *
     * @return self
     */
    public function setPrintBackground($print_background)
    {
        $this->container['print_background'] = $print_background;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}

