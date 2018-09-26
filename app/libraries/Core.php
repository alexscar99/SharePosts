<?php
    /*
     *************************************************
     *************************************************
     *     App Core Class                            *
     *     Creates url and loads core controller     *
     *     URL Format: /controller/method/params     *
     *************************************************
     *************************************************
    */

    class Core
    {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct()
        {
            $url = $this->getUrl();

            /*
             * Look in controllers for first value, but make sure to define
             * path from index.php since everything gets routed there.
            */
            if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                // If exists then set as controller
                $this->currentController = ucwords($url[0]);
                // Unset index 0
                unset($url[0]);
            }

            // Require current controller
            require_once '../app/controllers/' . $this->currentController . '.php';

            // Instantiate controller class
            // Example: if it's Pages,`$pages = new Pages`
            $this->currentController = new $this->currentController;

            // Check for second part of url
            if (isset($url[1])) {
                // Check to see if method exists in controller
                if (method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    // Unset index 1
                    unset($url[1]);
                }
            }

            // Get params
            $this->params = $url ? array_values($url) : [];

            // Callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl()
        {
            if (isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                // Sanitize value as a url
                $url = filter_var($url, FILTER_SANITIZE_URL);
                // Break url into an array
                $url = explode('/', $url);

                return $url;
            }
        }
    }
