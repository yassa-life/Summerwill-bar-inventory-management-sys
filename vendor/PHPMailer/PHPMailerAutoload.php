<?php

// Function to autoload PHPMailer classes
function PHPMailerAutoload($classname)
{
    // Can't use __DIR__ as it's only in PHP 5.3+
    $filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'class.' . strtolower($classname) . '.php';
    if (is_readable($filename)) {
        require $filename;
    }
}

// Register PHPMailerAutoload function with spl_autoload_register
if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
    spl_autoload_register('PHPMailerAutoload', true, true);
} else {
    spl_autoload_register('PHPMailerAutoload');
}
