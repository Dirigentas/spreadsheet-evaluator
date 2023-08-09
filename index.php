<?php

declare(strict_types=1);

// define('URL', 'http://localhost/file_reader/public/index.php/');

require __DIR__ . '/autoloader/autoloader.php';

use Spreadsheet\Api; 

echo Api::take();

?>