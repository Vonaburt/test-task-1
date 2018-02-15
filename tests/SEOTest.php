<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 15.02.2018
 */

namespace Tests;

use Helpers\Csv\SEOInfoCSVParser;
use Helpers\Dom\DOMElementFinder;
use Helpers\Dom\DOMParser;
use PHPUnit\Framework\TestCase;

class SEOTest extends TestCase
{
    private $currentDomDocument = null;

    /**
     * SEO-info data provider
     *
     * @return array
     * @throws \Exceptions\CSVFileNotFoundException
     */
    public static function addDataProvider()
    {
        $seo_info_parser_instance = new SEOInfoCSVParser(getenv("seo_file_path"));
        return $seo_info_parser_instance->getParsedSEOInfoArray();
    }

    /**
     * @dataProvider addDataProvider
     * @param $url
     * @param $title
     * @param $description
     */
    public function testTitle($url, $title, $description)
    {
        $titleElement = $this->getDomElementFinder($url)->getElementByXpath("//title");
        $titleElementText = $titleElement->item(0)->textContent;
        self::assertEquals($title, $titleElementText, "Titles is not equals on url: " . $url);
    }

    /**
     * @dataProvider addDataProvider
     * @param $url
     * @param $title
     * @param $description
     */
    public function testDescription($url, $title, $description)
    {
        $descriptionElement = $this->getDomElementFinder($url)->getElementByXpath("//meta[@name='description']");
        $descriptionElementText = $descriptionElement->item(0)->getAttribute("content");
        self::assertEquals($description, $descriptionElementText, "Meta descriptions is not equals on url: " . $url);
    }

    /**
     * Init dom-document and element-finder by url
     *
     * @param $url
     * @return DOMElementFinder
     * @throws \Exceptions\DomParserException
     */
    private function getDomElementFinder($url)
    {
        if ($this->currentDomDocument === null) {
            $domParser = new DOMParser();
            $domParser->addCookies(getenv("cookies"));
            $this->currentDomDocument = $domParser->getDomFromUrl($url);
        }

        return new DOMElementFinder($this->currentDomDocument);
    }
}