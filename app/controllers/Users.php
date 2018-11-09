<?php
    class Users extends Controller
    {
        public function __construct()
        {

        }

        public function register()
        {
            // check for post
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                // validation
                if (empty($data['name'])) {
                    $data['name_err'] = 'Please enter your name';
                }

                if (empty($data['email'])) {
                    $data['email_err'] = 'Please enter your email';
                }

                if (empty($data['password'])) {
                    $data['password_err'] = 'Please enter your password';
                } elseif (strlen($data['password']) < 6) {
                    $data['password_err'] = 'Your password must be at least 6 characters';
                }

                if (empty($data['confirm_password'])) {
                    $data['confirm_password_err'] = 'Please confirm your password';
                } else {
                    if ($data['password'] != $data['confirm_password']) {
                        $data['confirm_password_err'] = 'Passwords do not match';
                    }
                }

                // ensure errors are empty
                if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                    die('SUCCESS');
                } else {
                    // load view with errors
                    $this->view('users/register', $data);
                }

                

            } else {
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                // load view
                $this->view('users/register', $data);
            }
        }

        public function login()
        {
            // check for post
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => '',
                ];

                // validation
                if (empty($data['email'])) {
                    $data['email_err'] = 'Please enter your email';
                }

                if (empty($data['password'])) {
                    $data['password_err'] = 'Please enter your password';
                }

                // ensure errors are empty
                if (empty($data['email_err']) && empty($data['password_err'])) {
                    die('SUCCESS');
                } else {
                    // load view with errors
                    $this->view('users/login', $data);
                }

            } else {
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => '',
                ];

                // load view
                $this->view('users/login', $data);
            }
        }
    }