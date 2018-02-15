<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 14.02.2018
 */

namespace Helpers\Dom;

use DOMDocument;
use Exceptions\DomParserException;

class DOMParser
{

    private const TIMEOUT = 30;

    private $options = array(
        'http' => array(
            'method' => "GET",
            'timeout' => self::TIMEOUT
        ));

    /**
     * Add cookies to request options
     *
     * @param $cookies_values_string , example: "user=user123; pass=pass123"
     * @throws DomParserException
     */
    public function addCookies($cookies_values_string)
    {
        if ($cookies_values_string == null) {
            throw new DomParserException("Empty cookies string was pass");
        }

        $this->addHttpOption(array('header' => "Accept-language: en\r\n" .
            "Cookie: " . $cookies_values_string . "\r\n"));
    }

    /**
     * @param $option array
     */
    public function addHttpOption($option)
    {
        array_push($this->options['http'], $option);
    }

    /**
     * Return DOM-document from specified URL
     *
     * @param $url
     * @return bool|DOMDocument
     * @throws DomParserException
     */
    public function getDomFromUrl($url)
    {
        $url = $this->normalizeUrl($url);
        $this->validateUrl($url);
        $htmlString = $this->getHTMLString($url, $this->options);
        $pageDOM = $this->getDOMFromHTMLString($htmlString);

        return $pageDOM;
    }


    /**
     * Return HTML-document string of specified URL
     *
     * @param $url
     * @param $options
     * @return string
     * @throws DomParserException
     */
    private function getHTMLString($url, $options)
    {
        $context = stream_context_create($options);
        $htmlString = file_get_contents($url, false, $context);
        if ($htmlString === false) {
            throw new DomParserException("Error while getting content from url: " . $url);
        }
        return $htmlString;
    }

    /**
     * Add protocol to url, if it`s not indicated
     *
     * @param $url
     *
     * @return string
     */
    private function normalizeUrl($url)
    {
        $urlScheme = parse_url($url, PHP_URL_SCHEME);
        if (($urlScheme === false) || is_null($urlScheme)) {
            $url = 'http://' . $url;
        }
        return $url;
    }

    /**
     * Validate specific url
     *
     * @param $url
     *
     * @throws DomParserException
     */
    private function validateUrl($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new DomParserException("Given url is not valid: " . $url);
        }
    }


    /**
     * Get DOM Document from HTML string.
     *
     * @param $string
     *
     * @return bool|DOMDocument
     */
    private function getDOMFromHTMLString($string)
    {
        if (empty($string)) {
            return false;
        }
        $pageDOM = new DOMDocument(null, 'UTF-8');
        libxml_use_internal_errors(true); # disable err_reporting
        $pageDOM->loadHTML(mb_convert_encoding($string, 'HTML-ENTITIES', 'UTF-8'));
        return $pageDOM;
    }
}