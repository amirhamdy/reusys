<?php

/**
 * Write code on Method
 *
 * @return response()
 */
if (!function_exists('readCSVFile')) {
    function readCSVFile($csvFile): array
    {
        $array = array('delimiter' => ',');
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 0, $array['delimiter']);
        }
        fclose($file_handle);
        return $line_of_text;
    }
}

