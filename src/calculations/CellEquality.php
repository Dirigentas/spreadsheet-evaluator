<?php

// jei kartojasi $lineColumnNo, tai daryti continue
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
                    foreach ($line as $lineColumnNo => &$lineColumn) {
                        if (in_array($lineColumnNo, $lineColumnNoArrayToSkip)) {
                                continue;
                        }
                        if (strlen((string) $lineColumn) === 3 && str_contains((string) $lineColumn, '=')) {
                            if (!str_contains((string) $input['sheets'][$sheetNo]['data'][$lineColumn[2] - 1][ord($lineColumn[1]) - 65], '=')) {
                                $lineColumn = $input['sheets'][$sheetNo]['data'][$lineColumn[2] - 1][ord($lineColumn[1]) - 65];
                            } else {
                                $lineColumnNoArrayToSkip[] = $lineColumnNo;

                                recursion($input, $lineColumnNoArrayToSkip);
                                
                                $lineColumn = $input['sheets'][$sheetNo]['data'][$lineColumn[2] - 1][ord($lineColumn[1]) - 65];
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
