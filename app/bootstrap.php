<?php
    require_once 'config/config.php';

    /*
     * Autoload Core libraries to avoid `require_once` for each
    */
    spl_autoload_register(function ($className) {
        require_once 'libraries/' . $className . '.php';
    });
