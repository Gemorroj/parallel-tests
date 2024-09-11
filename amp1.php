<?php

require __DIR__ . '/vendor/autoload.php';

use Amp\Future;

$startTime = \microtime(true);

$fp = \fopen(__FILE__, 'r');

$future1 = Amp\async(function () use ($fp) {
    // block
    \sleep(2);
    \fseek($fp, 0);
    return 'future1: '.\fread($fp, 1024);
});

$future2 = Amp\async(function () use ($fp) {
    // block
    \sleep(2);
    \fseek($fp, 0);
    return 'future2: '.\fread($fp, 1024);
});

//$result = Future::iterate([$future1, $future2]);
$result = Future\awaitAll([$future1, $future2]);

print_r($result);


$endTime = \microtime(true);
echo \PHP_EOL;
echo \round($endTime - $startTime, 2).'s'; // in fact 4 sec. not expected 2
