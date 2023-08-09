<?php

declare(strict_types=1);

namespace Spreadsheet;

class Calculations
{
    /**
     * find SUM string
     * identify cells to sum
     * do the sum
     * replace string with actual sum
     */
    public static function sum($response)
    {
        foreach ($response['sheets'] as $key1 => &$sheet) {
            // print_r($sheet['data']);
            // echo '<br>';
            foreach ($sheet['data'] as $key2 => &$line) {
                // print_r($line);
                // echo '<br>';
                foreach ($line as $key3 => &$cell) {
                    if (str_contains((string) $cell, 'SUM')) {
                        

                        
                        $cell = 'TAAAAAAAAAAAAAAIP';
                    }
                }
            }
            // break;
        }



        print_r($response['sheets'][3]);

        // return self::multiply();
    }
    
    public static function multiply()
    {
        // echo '<br>multuply';
        // return;
    }
}

?>