<?php

/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 15.02.2018
 */

namespace Helpers\Csv;

class SEOInfoCSVParser extends AbstractCSVParser
{
    /**
     * Get parsed CSV array with parsed fields
     *
     * @return array
     */
    public function getParsedSEOInfoArray()
    {
        $seo_info_array = array();
        $csv_parsed_array = self::getParsedArray();
        foreach ($csv_parsed_array as $parsed_row) {
            array_push($seo_info_array, array($parsed_row["0"], $parsed_row["1"], $parsed_row["2"]));
        }

        return $seo_info_array;
    }
}
