<?php

declare(strict_types=1);

namespace Spreadsheet;

class Recursion
{
    public static function equalRecursion($column, $key1, $response)
    {
        
        if (str_contains((string) $response['sheets'][$key1]['data'][$column[2] - 1][ord($column[1]) - 65], '=')) {
            $column = 2;
        } else {
            $column = 1;
        }
        
        return $column;
    }   
}
?>

<!-- const numbers = [
    10,
    2,
    [1, 2, [5, -2], 2],
    [1, 1, 2],
    6,
];

function sumCount(list) {
    let ats = 0;
    for (const item of list) {
        if (typeof item === 'number') {
            ats += item;
        } else {
            ats += sumCount(item);
        }
    }
    return ats;
}

const sum = sumCount(numbers); -->