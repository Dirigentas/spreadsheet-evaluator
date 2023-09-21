<?php

// jei kartojasi $cellColumnNo, tai daryti continue
// pagrindinė pamoka, kad kai yra atskiroj funkcijoj, & prieš parametrą nepakeičia originalo, dėl to neatsnaujina duomenys

declare(strict_types=1);

namespace Aras\SpreadsheetEvaluator\calculations;

class CellEquality
{
    public static function equalToCell($input)
    {
        function recursion($input, $lineColumnNoArrayToSkip = []) {
            foreach ($input['sheets'] as $sheetNo => &$sheet) {
                foreach ($sheet['data'] as $lineNo => &$line) {
                    foreach ($line as $cellColumnNo => &$cell) {
                        if (in_array($cellColumnNo, $lineColumnNoArrayToSkip)) {
                                continue;
                        }
                        if (
                            strlen((string) $cell) === 3
                            && str_contains((string) $cell, '=')
                        ) {
                            if (!str_contains((string) $input['sheets'][$sheetNo]['data'][$cell[2] - 1][ord($cell[1]) - 65], '=')) {
                                $cell = $input['sheets'][$sheetNo]['data'][$cell[2] - 1][ord($cell[1]) - 65];
                            } else {
                                $lineColumnNoArrayToSkip[] = $cellColumnNo;

                                recursion($input, $lineColumnNoArrayToSkip);

                                $cell = $input['sheets'][$sheetNo]['data'][$cell[2] - 1][ord($cell[1]) - 65];
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
