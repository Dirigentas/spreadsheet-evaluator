<?php

declare(strict_types=1);

// phpinfo();  to chech if cURL is present

namespace Aras\SpreadsheetEvaluator;

class ApiReader
{
    public static function takeData()
    {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, 'https://www.wix.com/_serverless/hiring-task-spreadsheet-evaluator/sheets');
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $input = json_decode(curl_exec($ch), true);
        
        curl_close($ch);
        
        // return $input ? print_r($input): print_r('cURL Error ' . curl_error($ch));

        return $input;
    }
}
    
?>
