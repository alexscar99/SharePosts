<?php
    /*
     *******************************************
     *******************************************
     *    Base Controller                      *
     *    Loads the models and views           *
     *******************************************
     *******************************************
    */

    class Controller
    {
        // Load model
        public function model($model)
        {
            // Require model file
            require_once '../app/models/' . $model . '.php';

            // Instantiate the model
            return new $model();
        }

        // Load view
        // Second parameter is to pass data into the view whether
        // it is hardcoded, from the DB, etc.
        public function view($view, $data = [])
        {
            if (file_exists('../app/views/' . $view . '.php')) {
                require_once '../app/views/' . $view . '.php';
            } else {
                die('View does not exist');
            }
        }
    }
