<?php

declare(strict_types=1);

namespace Aras\SpreadsheetEvaluator\calculations;

class CellsSum
{
    public static function equalToCellsSum($output)
    {
        foreach ($output['sheets'] as $sheetNo => &$sheet) {
            foreach ($sheet['data'] as $lineNo => &$line) {
                foreach ($line as $cellColumnNo => &$cell) {
                    if (str_contains((string) $cell, Constants::SUM_IDENTIFIER)) {
                        $sumArray = explode(', ', substr($cell, strlen(Constants::SUM_IDENTIFIER) + 2, strlen($cell) - strlen(Constants::SUM_IDENTIFIER) - 3));
                        foreach ($sumArray as &$value) {
                            if (ctype_alpha($value[0])) {
                                $value = $output['sheets'][$sheetNo]['data'][$value[1] - Constants::ARRAY_TO_EXCEL][ord($value[0]) - Constants::ASCII];
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