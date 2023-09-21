<?php

declare(strict_types=1);

namespace Aras\SpreadsheetEvaluator\calculations;

class CellsDivide
{
    public static function equalToCellsDivide($output)
    {
        foreach ($output['sheets'] as $sheetNo => &$sheet) {
            foreach ($sheet['data'] as $lineNo => &$line) {
                foreach ($line as $cellColumnNo => &$cell) {
                    if (str_contains((string) $cell, Constants::DIVIDE_IDENTIFIER)) {
                        $divideArray = explode(', ', substr($cell, strlen(Constants::DIVIDE_IDENTIFIER) + Constants::SYMBOLS_BEFORE, strlen($cell) - strlen(Constants::DIVIDE_IDENTIFIER) - Constants::SYMBOLS_BEFORE_AFTER));
                        
                        foreach ($divideArray as &$value) {
                            $columnLetter = $value[0];

                            if (ctype_alpha($columnLetter)) {
                                $lineNumber = $value[1];

                                $value = $output['sheets'][$sheetNo]['data'][$lineNumber - Constants::ARRAY_TO_EXCEL][ord($columnLetter) - Constants::ASCII];
                            }
                        }
                        $dividend = $divideArray[0];
                        $divisor = $divideArray[1];

                        $cell = $dividend / $divisor;
                    }
                }
            }
        }

        // print_r($output['sheets'][8]);
        // print_r($output['sheets'][9]);
           
        return $output;
    }
}

?>