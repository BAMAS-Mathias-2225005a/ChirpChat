<?php
    function my_autoload(string $class): void {
        $class_path = str_replace('\\', '/', $class);
        $class_path = strtolower($class_path);
        require_once './modules/' . $class_path . '.php';
    }

    spl_autoload_register('my_autoload');