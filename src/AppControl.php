<?php

/**
 * File purpose is to make adjustments to $couriersDetails and call all required methods.
 */

declare(strict_types=1);

namespace Aras\SpreadsheetEvaluator;

use Aras\SpreadsheetEvaluator\ApiReader;
use Aras\SpreadsheetEvaluator\calculations\ReferenceCell;
use Aras\SpreadsheetEvaluator\calculations\SumCells;
use Aras\SpreadsheetEvaluator\calculations\MultiplyCells;
use Aras\SpreadsheetEvaluator\calculations\DivideCells;
use Aras\SpreadsheetEvaluator\calculations\EqualCells;
use Aras\SpreadsheetEvaluator\calculations\NegatesCell;

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

        $output = ReferenceCell::referenceToCell($input);

        $output = SumCells::equalToCellsSum($output);

        $output = MultiplyCells::equalToCellsMultiply($output);

        $output = DivideCells::equalToCellsDivide($output);

        $output = EqualCells::isCellsEqual($output);

        $output = NegatesCell::equalOppositeCell($output);

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
