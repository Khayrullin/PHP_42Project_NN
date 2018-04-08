<?php

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

ini_set("max_execution_time", "600");
$start = microtime(true);

$net = new Network();
$net->train($net);

$end = microtime(true);
$time = $end-$start;
print("Время обучения сети: $time сек.\n");

$net->test($net);
