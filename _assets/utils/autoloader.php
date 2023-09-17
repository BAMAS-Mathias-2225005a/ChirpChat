<?php
    function my_autoload(string $class): void {
        $class_path = str_replace('\\', '/', $class);
        require_once 'modules/' . $class_path . '.php';
    }

    spl_autoload_register('my_autoload');