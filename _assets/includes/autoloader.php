<?php
    function my_autoload(string $class): void {
        $class_path = str_replace( '\\', '/', $class);
        $class_path = explode('/',$class_path);
        $newClass_path = "";

        foreach ($class_path as $section){
            if($section != $class_path[count($class_path) - 1]){
                $newClass_path .= strtolower($section) . '/';
            }else{
                $newClass_path .= lcfirst($section);
            }
        }

        require_once  'modules/' . $newClass_path . '.php';
    }

    spl_autoload_register('my_autoload');