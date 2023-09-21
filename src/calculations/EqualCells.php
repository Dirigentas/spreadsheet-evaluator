<?php

declare(strict_types=1);

namespace Aras\SpreadsheetEvaluator\calculations;

class EqualCells
{
    public static function isCellsEqual($output)
    {
        foreach ($output['sheets'] as $sheetNo => &$sheet) {
            foreach ($sheet['data'] as $lineNo => &$line) {
                foreach ($line as $cellColumnNo => &$cell) {
                    if (str_contains((string) $cell, Constants::EQUAL_IDENTIFIER)) {
                        $equalArray = explode(', ', substr($cell, strlen(Constants::EQUAL_IDENTIFIER) + Constants::SYMBOLS_BEFORE, strlen($cell) - strlen(Constants::EQUAL_IDENTIFIER) - Constants::SYMBOLS_BEFORE_AFTER));
                        
                        foreach ($equalArray as &$value) {
                            $columnLetter = $value[0];

                            if (ctype_alpha($columnLetter)) {
                                $lineNumber = $value[1];

                                $value = $output['sheets'][$sheetNo]['data'][$lineNumber - Constants::ARRAY_TO_EXCEL][ord($columnLetter) - Constants::ASCII];
                            }
                        }
                        $firstComparative = $equalArray[0];
                        $secondComparative = $equalArray[1];

                        $cell = var_export($firstComparative === $secondComparative, true);
                    }
                }
            }
        }

        // print_r($output['sheets'][11]);
        // print_r($output['sheets'][12]);
           
        return $output;
    }
}

?>