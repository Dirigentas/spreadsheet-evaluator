<?php

// jei kartojasi key3, tai daryti continue
// pagrindinė pamoka, kad kai yra atskiroj funkcijoj, & prieš parametrą nepakeičia originalo, dėl to neatsnaujina duomenys

declare(strict_types=1);

namespace Aras\SpreadsheetEvaluator\calculations;

class CellEquality
{
    public static function equalToCell($input)
    {
        function recursion($input, $key = []) {
            foreach ($input['sheets'] as $key1 => &$sheet) {
                foreach ($sheet['data'] as $key2 => &$line) {
                    // echo 'DIDELIS Nr ' . $key2 . ' pradzia<br>';
                    foreach ($line as $key3 => &$column) {
                        // echo 'MAZAS Nr ' . $key3 . ' pradzia<br>';
                        if (in_array($key3, $key)) {
                                // echo 'continue ' . $key3 . ' ' . $column . '<br>';
                                continue;
                        }
                        if (strlen((string) $column) === 3 && str_contains((string) $column, '=')) {
                            if (!str_contains((string) $input['sheets'][$key1]['data'][$column[2] - 1][ord($column[1]) - 65], '=')) {
                                // echo $column . ' equal<br>';
                                $column = $input['sheets'][$key1]['data'][$column[2] - 1][ord($column[1]) - 65];
                            } else {
                                $keysArray = $key;
                                $keysArray[] = $key3;
                                // print_r($keysArray);
                                // echo 'recursion<br>';
                                recursion($input, $keysArray);
                                // echo $column . ' equal<br>';
                                $column = $input['sheets'][$key1]['data'][$column[2] - 1][ord($column[1]) - 65];
                            }
                        }
                    }
                }
            }
            return $input;
        }

        $input = recursion($input);
   
        return $input;
    }
}

?>