<?php

function loadClassInBasePath($class, $baseDir)
{
    $relative_class_path = str_replace('\\', '/', $class);

    $file = $baseDir . $relative_class_path . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
}

function loadClassByPrefix($class, $namespacePrefix, $baseDir)
{
    $len = strlen($namespacePrefix);

    if (strncmp($namespacePrefix, $class, $len) !== 0) {
        return;
    }

    loadClassInBasePath($class, $baseDir);
}
