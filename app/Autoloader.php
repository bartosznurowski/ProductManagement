<?php

spl_autoload_register(function($class)
{
    $className = explode("\\",$class)[count(explode("\\",$class))-1];
    
    $classPath = str_replace(strtolower($className), ucfirst($className), strtolower($class));
    
    $file = $_SERVER['DOCUMENT_ROOT'] . "/" . str_replace('\\','/', $classPath) . '.php';
       
    if (file_exists($file)) {
        require($file);
    }
});