<?php
    // Load config
    require_once 'config/config.php';

    /*
     * Autoload Core libraries
     * This saves you from writing a require_once statement
     * for each library. Autoloading libraries is especially
     * helpful if you are using many in your application.
    */
    spl_autoload_register(function ($className) {
        require_once 'libraries/' . $className . '.php';
    });
