#!/usr/bin/php
<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$start = microtime(true);

$net = new Network(NetworkMode::Train, true);
$net->train($net);

$end = microtime(true);
$time = $end - $start;
print("Время обучения сети: $time сек.\n");

$net = new Network(NetworkMode::Test);
$net->test($net);
