<?php
    /*
        App Core Class:
        - Create url and load core controller
        - URL Format: /controller/method/params
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
                Look in controllers for first value, make sure to define
                path from index.php (everything gets routed there)
            */
            if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
            }

            require_once '../app/controllers/' . $this->currentController . '.php';

            // instantiate controller class
            $this->currentController = new $this->currentController;

            // check second part of url
            if (isset($url[1])) {
                // set method if it exists in controller
                if (method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            // get params
            $this->params = $url ? array_values($url) : [];

            // callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl()
        {
            if (isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                // sanitize value as a url
                $url = filter_var($url, FILTER_SANITIZE_URL);
                // break url into an array
                $url = explode('/', $url);

                return $url;
            }
        }
    }
