<?php

/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 14.02.2018
 */

namespace Helpers\Csv;


use Exceptions\CSVFileNotFoundException;

abstract class AbstractCSVParser
{

    private $csv_file_path;

    /**
     * AbstractCSVParser constructor
     * @param $csv_file_path
     * @throws CSVFileNotFoundException
     */
    public function __construct($csv_file_path)
    {
        if ($csv_file_path != null && file_exists(realpath($csv_file_path))) {
            $this->csv_file_path = $csv_file_path;
        } else {
            throw new CSVFileNotFoundException("CSV file not found by specified file path: " . $csv_file_path);
        }
    }

    /**
     * Get parsed CVS Array
     *
     * @return array parsed data array
     */
    public function getParsedArray()
    {
        $handle = fopen($this->csv_file_path, "r");
        $csv_data_array = array();

        fgetcsv($handle, 0, ";"); # пропустить headers
        while (($line = fgetcsv($handle, 0, ";")) !== FALSE) {
            $csv_data_array[] = $line;
        }
        fclose($handle);
        return $csv_data_array;
    }
}