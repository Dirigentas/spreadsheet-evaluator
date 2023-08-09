<?php

declare(strict_types=1);

// phpinfo();  to chech if cURL is present

namespace Spreadsheet;

use Spreadsheet\Calculations;

class Api
{
    public static function take()
    {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, 'https://www.wix.com/_serverless/hiring-task-spreadsheet-evaluator/sheets');
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = json_decode(curl_exec($ch), true);
        
        curl_close($ch);
        
        // return $response ? print_r($response): print_r('cURL Error ' . curl_error($ch));    
        return Calculations::sum($response);
    }
}
    
    ?>

<!-- iskart patarimai
daryk modular
ne i viena faila
prie manes del to prisi...o -->
<!-- rekursija butu buve gerai naudot -->
<!-- o as visur su while loopais variau -->
<!-- ten gal 4 lygiu nestinimas gavos -->
