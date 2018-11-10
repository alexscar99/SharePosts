<?php
    // Use either dev_config or prod_config files based off of env
    switch ($_SERVER['SERVER_NAME']) {
        case 'localhost':
            require_once 'dev_config.php';
            break;
        case 'prod-url':
            require_once 'prod_config.php';
            break;
        default:
            print 'Error occurred';
    }
