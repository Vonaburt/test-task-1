<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 15.02.2018
 */

namespace Helpers\Dom;


class DOMElementFinder
{
    private $DOMDocument;

    /**
     * DOMElementFinder constructor.
     * @param $DOMDocument
     */
    public function __construct($DOMDocument)
    {
        $this->DOMDocument = $DOMDocument;
    }

    /**
     * Get dom-element from dom-document by xpath expression
     *
     * @param $xpath
     * @return \DOMNodeList
     */
    public function getElementByXpath($xpath)
    {
        $dom_xpath_finder = new \DOMXPath($this->DOMDocument);
        return $dom_xpath_finder->query($xpath);
    }

}