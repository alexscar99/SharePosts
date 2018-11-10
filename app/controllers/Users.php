<?php
    class Users extends Controller
    {
        public function __construct()
        {
            $this->userModel = $this->model('User');
        }

        public function register()
        {
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
                } else {
                    // show err if account already exists with that email
                    if ($this->userModel->findUserByEmail($data['email'])) {
                        $data['email_err'] = 'Email is already taken';
                    }
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
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    if ($this->userModel->register($data)) {
                        flash('register_success', 'You are registered and can now log in');
                        redirect('users/login');
                    } else {
                        die('Something went wrong');
                    }

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

                // load view with empty data fields
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

                // check for user
                if ($this->userModel->findUserByEmail($data['email'])) {
                    //
                } else {
                    $data['email_err'] = 'No user found for that email';
                }

                // ensure errors are empty
                if (empty($data['email_err']) && empty($data['password_err'])) {
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                    if ($loggedInUser) {
                        // create session
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['password_err'] = 'Password incorrect, please try again';

                        $this->view('users/login', $data);
                    }
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

                // load view with empty data
                $this->view('users/login', $data);
            }
        }

        public function createUserSession($user) 
        {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            redirect('posts');
        }

        public function logout()
        {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            session_destroy();
            redirect('users/login');
        }
    }