<?php

declare(strict_types=1);

namespace Aras\SpreadsheetEvaluator\calculations;

class MultiplyCells
{
    public static function equalToCellsMultiply($output)
    {
        foreach ($output['sheets'] as $sheetNo => &$sheet) {
            foreach ($sheet['data'] as $lineNo => &$line) {
                foreach ($line as $cellColumnNo => &$cell) {
                    if (str_contains((string) $cell, Constants::MULTIPLY_IDENTIFIER)) {
                        $multiplyArray = explode(', ', substr($cell, strlen(Constants::MULTIPLY_IDENTIFIER) + Constants::SYMBOLS_BEFORE, strlen($cell) - strlen(Constants::MULTIPLY_IDENTIFIER) - Constants::SYMBOLS_BEFORE_AFTER));
                        foreach ($multiplyArray as &$value) {
                            $columnLetter = $value[0];
                            
                            if (ctype_alpha($columnLetter)) {
                                $lineNumber = $value[1];

                                $value = $output['sheets'][$sheetNo]['data'][$lineNumber - Constants::ARRAY_TO_EXCEL][ord($columnLetter) - Constants::ASCII];
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