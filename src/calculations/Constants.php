<?php

declare(strict_types=1);

namespace Aras\SpreadsheetEvaluator\calculations;

class Constants
{
    const ASCII = 65;
    
    const ARRAY_TO_EXCEL = 1;

    const REFERENCE_IDENTIFIER = '=';

    const SUM_IDENTIFIER = 'SUM';
    
    const MULTIPLY_IDENTIFIER = 'MULTIPLY';

    const DIVIDE_IDENTIFIER = 'DIVIDE';

    const EQUAL_IDENTIFIER = 'EQ';

    const OPPOSITE_IDENTIFIER = 'NOT';

    const ALL_TRUE_IDENTIFIER = 'AND';
    
    const SYMBOLS_BEFORE = 2;

    const SYMBOLS_BEFORE_AFTER = 3;
}
