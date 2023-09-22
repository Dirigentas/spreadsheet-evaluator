<?php

declare(strict_types=1);

namespace Aras\SpreadsheetEvaluator\calculations;

class NegatesCell
{
    public static function equalOppositeCell($output)
    {
        foreach ($output['sheets'] as $sheetNo => &$sheet) {
            foreach ($sheet['data'] as $lineNo => &$line) {
                foreach ($line as $cellColumnNo => &$cell) {
                    if (str_contains((string) $cell, Constants::OPPOSITE_IDENTIFIER)) {
                        
                        $trimCell = substr($cell, strlen(Constants::OPPOSITE_IDENTIFIER) + Constants::SYMBOLS_BEFORE, strlen($cell) - strlen(Constants::OPPOSITE_IDENTIFIER) - Constants::SYMBOLS_BEFORE_AFTER);
                        
                            $columnLetter = $trimCell[0];

                            if (ctype_alpha($columnLetter)) {
                                $lineNumber = $trimCell[1];

                                $trimCell = $output['sheets'][$sheetNo]['data'][$lineNumber - Constants::ARRAY_TO_EXCEL][ord($trimCell) - Constants::ASCII];
                            }

                        $cell = !$trimCell;
                    }
                }
            }
        }

        // print_r($output['sheets'][13]);
           
        return $output;
    }
}

?>