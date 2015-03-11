<?php

function my_autoload($class) {
    $name = explode('\\', $class);
    $name[0] = __DIR__;
    $path = implode(DIRECTORY_SEPARATOR, $name) . '.php';

    if (file_exists($path)) {
        require $path;
    }
}

spl_autoload_register('my_autoload');

require __DIR__ . '/vendor/autoload.php';