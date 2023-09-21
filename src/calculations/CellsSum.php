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
                    if (str_contains((string) $cell, 'SUM')) {
                        $sumArray = explode(', ', substr($cell, 5, strlen($cell) - 6));
                        foreach ($sumArray as $sumArrayKey => &$value) {
                            if (ctype_alpha($value[0])) {
                                $value = $output['sheets'][$sheetNo]['data'][$value[1] - 1][ord($value[0]) - 65];
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