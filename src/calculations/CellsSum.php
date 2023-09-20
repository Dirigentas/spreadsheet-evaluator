<?php

declare(strict_types=1);

namespace Aras\SpreadsheetEvaluator;

class CellsSum
{
    /**
     * find SUM string
     * identify cells to sum
     * do the sum
     * replace string with actual sum
     */
    public static function equalToCellsSum($response)
    {
        foreach ($response['sheets'] as $key1 => &$sheet) {
            // print_r($sheet['data']);
            // echo '<br>';
            foreach ($sheet['data'] as $key2 => &$line) {
                // print_r($line);
                // echo '<br>';
                foreach ($line as $key3 => &$cell) {
                    if (str_contains((string) $cell, 'SUM')) {
                        $sumCells = explode(', ', substr($cell, 5, strlen($cell) - 6));
                        // echo(ord($sumCells[0][0]));
                        // $cell = 22 + 212212;
                        if (ord($sumCells[0][0]) === $key2 + 65) {
                            // echo $key2;
                        }
                    }
                    // echo @$sumCells[0][1];
                    // if (@$sumCells[0][1] == $key3) {
                    //     echo $key3;
                    // }
                }
            }
        }
        echo '<br><br>';    
        // print_r($response['sheets'][3]);
           
        // print_r($input['sheets'][2]['data']);

        // return self::multiply();
    }
    
    
}

?>