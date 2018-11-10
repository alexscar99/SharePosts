<?php
    require_once 'config/config.php';

    require_once 'helpers/url_helper.php';

    /*
     * Autoload Core libraries to avoid `require_once` for each
    */
    spl_autoload_register(function ($className) {
        require_once 'libraries/' . $className . '.php';
    });
