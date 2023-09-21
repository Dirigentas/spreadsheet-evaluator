<?php

declare(strict_types=1);

namespace Aras\SpreadsheetEvaluator\calculations;

class CellsMultiply
{
    public static function equalToCellsMultiply($output)
    {
        foreach ($output['sheets'] as $sheetNo => &$sheet) {
            foreach ($sheet['data'] as $lineNo => &$line) {
                foreach ($line as $cellColumnNo => &$cell) {
                    if (str_contains((string) $cell, Constants::MULTIPLY_IDENTIFIER)) {
                        $multiplyArray = explode(', ', substr($cell, strlen(Constants::MULTIPLY_IDENTIFIER) + 2, strlen($cell) - strlen(Constants::MULTIPLY_IDENTIFIER) - 3));
                        foreach ($multiplyArray as &$value) {
                            if (ctype_alpha($value[0])) {
                                $value = $output['sheets'][$sheetNo]['data'][$value[1] - Constants::ARRAY_TO_EXCEL][ord($value[0]) - Constants::ASCII];
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