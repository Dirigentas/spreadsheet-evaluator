<?php

declare(strict_types=1);

namespace Aras\SpreadsheetEvaluator\calculations;

class AllTrueCell
{
    public static function checkIfAllTrue($output)
    {
        foreach ($output['sheets'] as $sheetNo => &$sheet) {
            foreach ($sheet['data'] as $lineNo => &$line) {
                foreach ($line as $cellColumnNo => &$cell) {
                    if (str_contains((string) $cell, Constants::ALL_TRUE_IDENTIFIER)) {
                        $allTrueArray = explode(', ', substr($cell, strlen(Constants::ALL_TRUE_IDENTIFIER) + Constants::SYMBOLS_BEFORE, strlen($cell) - strlen(Constants::ALL_TRUE_IDENTIFIER) - Constants::SYMBOLS_BEFORE_AFTER));
                        
                        foreach ($allTrueArray as &$value) {
                            $columnLetter = $value[0];

                            if (ctype_alpha($columnLetter)) {
                                $lineNumber = $value[1];

                                $value = $output['sheets'][$sheetNo]['data'][$lineNumber - Constants::ARRAY_TO_EXCEL][ord($columnLetter) - Constants::ASCII];
                            }
                        }
                        $cell = array_reduce($allTrueArray, function($carry, $item) {
                            return $carry && $item;
                        }, true);
                    }
                }
            }
        }

        // var_dump($output['sheets'][14]);
        // var_dump($output['sheets'][15]);
           
        return $output;
    }
}

?>