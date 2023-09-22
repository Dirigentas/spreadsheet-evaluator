<?php

// jei kartojasi $cellColumnNo, tai daryti continue
// pagrindinė pamoka, kad kai yra atskiroj funkcijoj, & prieš parametrą nepakeičia originalo, dėl to neatsnaujina duomenys

declare(strict_types=1);

namespace Aras\SpreadsheetEvaluator\calculations;

class ReferenceCell
{
    public static function ReferenceToCell($input)
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
                            && str_contains((string) $cell, Constants::REFERENCE_IDENTIFIER)
                        ) {
                            $columnLetter = $cell[1];

                            $lineNumber = $cell[2];

                            if (!str_contains((string) $input['sheets'][$sheetNo]['data'][$lineNumber - Constants::ARRAY_TO_EXCEL][ord($columnLetter) - Constants::ASCII], '=')) {
                                $cell = $input['sheets'][$sheetNo]['data'][$lineNumber - Constants::ARRAY_TO_EXCEL][ord($columnLetter) - Constants::ASCII];
                            } else {
                                $lineColumnNoArrayToSkip[] = $cellColumnNo;

                                recursion($input, $lineColumnNoArrayToSkip);

                                $cell = $input['sheets'][$sheetNo]['data'][$lineNumber - Constants::ARRAY_TO_EXCEL][ord($columnLetter) - Constants::ASCII];
                            }
                        }
                    }
                }
            }
            return $input;
        }

        $input = recursion($input);

        // print_r($input['sheets'][2]);
        // print_r($input['sheets'][21]);
        // print_r($input['sheets'][22]);
        // print_r($input['sheets'][23]);
   
        return $input;
    }
}

?>
