<?php
    // Switch statement to use either dev_config or prod_config files based off of environment
    switch ($_SERVER['SERVER_NAME']) {
        case 'localhost':
            require_once 'dev_config.php';
            break;
        // replace prod url with the server name for prod site once ready for deploy
        case 'prod-url':
            require_once 'prod_config.php';
            break;
        default:
            // Error occurred
    }
