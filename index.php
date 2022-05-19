<?php

require_once "./Counter.php";

try {
    $fileCounter = new Counter();
    $totalSum = $fileCounter->getTotalSum(getcwd() . DIRECTORY_SEPARATOR . 'data', "count");
    echo $totalSum . PHP_EOL;
} catch (\Exception $e) {
    echo "Could not calculate total sum : {$e->getMessage()}" . PHP_EOL;
}
