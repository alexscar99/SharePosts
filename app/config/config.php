<?php
    // Create switch statement to use either dev_config or prod_config
    // files based off of environment

    switch ($_SERVER['SERVER_NAME']) {
        case 'localhost':
            require_once 'dev_config.php';
            break;
        // replace production-url with the server name for your production site
        case 'production-url':
            require_once 'production_config.php';
            break;
        default:
            // Error occurred
    }
