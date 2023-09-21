<?php

declare(strict_types=1);

namespace Aras\SpreadsheetEvaluator\calculations;

class CellsMultiply
{
    public static function equalToCellsMultiply($output)
    {
        $multiplyIdentifier = 'MULTIPLY';

        foreach ($output['sheets'] as $sheetNo => &$sheet) {
            foreach ($sheet['data'] as $lineNo => &$line) {
                foreach ($line as $cellColumnNo => &$cell) {
                    if (str_contains((string) $cell, $multiplyIdentifier)) {
                        $multiplyArray = explode(', ', substr($cell, strlen($multiplyIdentifier) + 2, strlen($cell) - strlen($multiplyIdentifier) - 3));
                        foreach ($multiplyArray as &$value) {
                            if (ctype_alpha($value[0])) {
                                $value = $output['sheets'][$sheetNo]['data'][$value[1] - 1][ord($value[0]) - 65];
                            }
                        }
                        $cell = array_product($multiplyArray);
                    }
                }
            }
        }

        // print_r($output['sheets'][6]);
        // print_r($output['sheets'][7]);
           
        return $output;
    }
}

?>