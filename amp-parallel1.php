<?php

require __DIR__ . '/vendor/autoload.php';

use Amp\Future;
use Amp\Parallel\Worker;
use App\FetchTask;

$startTime = \microtime(true);

$fp = \fopen(__FILE__, 'r');
$execution1 = Worker\submit(new FetchTask($fp));
$execution2 = Worker\submit(new FetchTask($fp));

$result = Future\awaitAll([$execution1->getFuture(), $execution2->getFuture()]);

print_r($result);


$endTime = \microtime(true);
echo \PHP_EOL;
echo \round($endTime - $startTime, 2).'s'; // in fact 4 sec. not expected 2
