<?php

declare(strict_types=1);

namespace Aras\SpreadsheetEvaluator\calculations;

class SumCells
{
    public static function equalToCellsSum($output)
    {
        foreach ($output['sheets'] as $sheetNo => &$sheet) {
            foreach ($sheet['data'] as $lineNo => &$line) {
                foreach ($line as $cellColumnNo => &$cell) {
                    if (str_contains((string) $cell, Constants::SUM_IDENTIFIER)) {
                        $sumArray = explode(', ', substr($cell, strlen(Constants::SUM_IDENTIFIER) + Constants::SYMBOLS_BEFORE, strlen($cell) - strlen(Constants::SUM_IDENTIFIER) - Constants::SYMBOLS_BEFORE_AFTER));
                        foreach ($sumArray as &$value) {
                            $columnLetter = $value[0];
                            
                            if (ctype_alpha($columnLetter)) {
                                $lineNumber = $value[1];

                                $value = $output['sheets'][$sheetNo]['data'][$lineNumber - Constants::ARRAY_TO_EXCEL][ord($columnLetter) - Constants::ASCII];
                            }
                        }
                        $cell = array_sum($sumArray);
                    }
                }
            }
        }

        // print_r($output['sheets'][3]);
        // print_r($output['sheets'][4]);
        // print_r($output['sheets'][5]);
           
        return $output;
    }
    
    
}

?>