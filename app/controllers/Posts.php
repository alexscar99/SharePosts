<?php
    class Posts extends Controller
    {
        public function __construct()
        {
            if (!isLoggedIn()) {
                redirect('users/login');
            }

            $this->postModel = $this->model('Post');
        }

        public function index()
        {
            $posts = $this->postModel->getPosts();

            $data = [
                'posts' => $posts
            ];

            $this->view('posts/index', $data);
        }

        public function add()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // sanitize POST
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_err' => '',
                    'body_err' => ''
                ];

                // validation
                if (empty($data['title'])) {
                    $data['title_err'] = 'Enter a title for your post';
                }

                if (empty($data['body'])) {
                    $data['body_err'] = 'Enter a body for your post';
                }

                // ensure no errors
                if (empty($data['title_err']) && empty($data['body_err'])) {
                    if ($this->postModel->addPost($data)) {
                        flash('post_message', 'Post successfully added');
                        redirect('posts');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    // load view with errors
                    $this->view('posts/add', $data);
                }

            } else {
                $data = [
                    'title' => '',
                    'body' => ''
                ];
                
                // load view with empty form
                $this->view('posts/add', $data);
            }
        }
    }