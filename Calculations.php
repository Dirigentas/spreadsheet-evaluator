<?php

// jei kartojasi key3, tai daryti continue
// pagrindinė pamoka, kad kai yra atskiroj funkcijoj, & prieš parametrą nepakeičia originalo, dėl to neatsnaujina duomenys

declare(strict_types=1);

namespace Spreadsheet;

use Spreadsheet\Recursion;

class Calculations
{
    public static function equal($response)
    {
        function recursion($response, $key = []) {
            foreach ($response['sheets'] as $key1 => &$sheet) {
                foreach ($sheet['data'] as $key2 => &$line) {
                    echo 'DIDELIS Nr ' . $key2 . ' pradzia<br>';
                    foreach ($line as $key3 => &$column) {
                        echo 'MAZAS Nr ' . $key3 . ' pradzia<br>';
                        if (in_array($key3, $key)) {
                                echo 'continue ' . $key3 . ' ' . $column . '<br>';
                                continue;
                        }
                        if (strlen((string) $column) === 3 && str_contains((string) $column, '=')) {
                            if (!str_contains((string) $response['sheets'][$key1]['data'][$column[2] - 1][ord($column[1]) - 65], '=')) {
                                echo $column . ' equal<br>';
                                $column = $response['sheets'][$key1]['data'][$column[2] - 1][ord($column[1]) - 65];
                            } else {
                                $keysArray = $key;
                                $keysArray[] = $key3;
                                print_r($keysArray);
                                echo 'recursion<br>';
                                recursion($response, $keysArray);
                                echo $column . ' equal<br>';
                                $column = $response['sheets'][$key1]['data'][$column[2] - 1][ord($column[1]) - 65];
                            }
                        }
                    }
                }
            }
            return $response;
        }

        
        $response = recursion($response);
   
        print_r($response['sheets'][21]['data']);
        echo '<br><br>';
        print_r($response['sheets'][22]['data']);
        echo '<br><br>';
        print_r($response['sheets'][23]['data']);
        // echo '<br>';
        // print_r($response['sheets'][2]['data'][0][0]);

        // return self::sum();
    }












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

        // return self::multiply();
    }
    
    public static function multiply()
    {
        // echo '<br>multuply';
        // return;
    }
}

?>