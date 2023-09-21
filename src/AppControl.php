<?php

/**
 * File purpose is to make adjustments to $couriersDetails and call all required methods.
 */

declare(strict_types=1);

namespace Aras\SpreadsheetEvaluator;

use Aras\SpreadsheetEvaluator\ApiReader;
use Aras\SpreadsheetEvaluator\calculations\CellEquality;

/**
 * Class Control controls all pats of the solution.
 */
final class AppControl
{
    /**
     * This method executes all needed classes.
     *
     * @return void
     */
    public static function executeAllClasses(): void
    {
        $input = ApiReader::takeData();

        $output = CellEquality::equalToCell($input);

        // $output = CellsSum::equalToCellsSum($output);

        self::writeToStdout($output);
    }

    /**
     * This method writes the $output to stdout.
     *
     * @param $output The array of transactions with calculated discounts.
     *
     * @return void
     */
    public static function writeToStdout(array $output): void
    {
        print_r($output);
    }
}
