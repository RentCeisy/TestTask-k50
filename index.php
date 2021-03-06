<?php

use task\Task;

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class).'.php';
    if(file_exists($class)) {
        require $class;
    }
});

try {
    $task = new Task($argv[1], $argv[2]);
    $task->start();
    die();
} catch(Exception $e) {
   die($e->getMessage());
}
