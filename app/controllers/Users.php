<?php
session_start();
class Users extends Controller{
    public function __construct(){
        $this->userModel = $this->model('User');
    }


    //***************** REGISTER *******************//
    public function register(){
        // check for post
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //process form

            //sanitize post data
            $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //init data
            $data=[
                'name'=>trim($_POST['name']),
                'email'=>trim($_POST['email']),
                'age'=>trim($_POST['age']),
                'username'=>trim($_POST['username']),
                'password'=>trim($_POST['password']),
                'confirm_password'=>trim($_POST['confirm_password']),
                'name_err'=>'',
                'email_err'=>'',
                'age_err'=>'',
                'username_err'=>'',
                'password_err'=>'',
                'confirm_password_err'=>''
            ];
            // validate email
            if(empty($data['email'])){
                $data['email_err']='Please enter emil';
            }
            /*
            else{
                //check email
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err']='email exists';
                }
            }
            */

            // validate name
            if(empty($data['name'])){
                $data['name_err']='Please enter name';
            }

            // validate age
            if(empty($data['age'])){
                $data['age_err']='Please enter age';
            }
            elseif(($data['age'])*1 <=0){
                $data['age_err']='Age must be > 0';
            }

            // validate username
            if(empty($data['username'])){
                $data['username_err']='Please enter username';
            }
            else{
                //check username
                if($this->userModel->findUserByUsername($data['username'])){
                    $data['username_err']='username exists';
                }
            }

            // validate password
            if(empty($data['password'])){
                $data['password_err']='Please enter password';
            }
            // validate password
            elseif(strlen($data['password'])!=8){
                $data['password_err']='Password must be exactly 8 chars';
            }
            // validate confirm password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err']='Please enter password';
            }
            else{
                if($data['password']!=$data['confirm_password']){
                    $data['confirm_password_err']='not equal';
                }
            }

            // make sure errors are empty
            if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['age_err']) && empty($data['username_err']) ){
                // validate

                //Register User
                if($this->userModel->register($data)){
                    redirect('users/login');
                }else{
                    die('something went wrong');
                }
            }
            else{
                // load view with errors
                $this->view('users/register',$data);
            }

        } else{
            //Init data
            $data=[
                'name'=>'',
                'email'=>'',
                'age'=>'',
                'username'=>'',
                'password'=>'',
                'confirm_password'=>'',
                'name_err'=>'',
                'email_err'=>'',
                'age_err'=>'',
                'username_err'=>'',
                'password_err'=>'',
                'confirm_password_err'=>''
            ];

            //Load view
            $this->view('users/register',$data);
        }
    }

/**************************************************************************/




















//***************************** LOGIN ************************************//
    public function login(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data =[
                'name' => trim($_POST['name']),
                'username' => trim($_POST['username']),
                'name_err' => '',
                'username_err' => '',
            ];

            // Validate Email
            if(empty($data['name'])){
                $data['name_err'] = 'Pleae enter name';
            }

            // Validate Password
            if(empty($data['username'])){
                $data['username_err'] = 'Please enter username';
            }


            // Check for user /email
            if($this->userModel->findUserByUsername($data['username'])){
                //user found
            }else{
                $data['username_err'] = "no user found";
            }


            // Make sure errors are empty
            if(empty($data['name_err']) && empty($data['username_err'])) {
                // Validated
               //check and set logged in user
                $loggedInUser = $this->userModel->login($data['name'],$data['username']);
            if($loggedInUser){
                // create sessions
                //die('you are logged');
                //$this->view('pages/about', $data);
                $_SESSION['in'] = $data['username'];
                header('Location: http://localhost/Final/views/about');

            }else{
                $data['username_err']='username incorrect';
                $this->view('users/login', $data);
            }

            } else{
                    //Load view with errors
                    $this->view('users/login',$data);
            }

        }


        else {
            // Init data
            $data =[
                'name' => '',
                'username' => '',
                'name_err' => '',
                'username_err' => '',
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }
/************************************************************************************/
















//********************* THE AJAX PART FOR THE REGISTRATION ***********************//

    public function createAccountAjax(){
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'){

        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (isset($_POST["submit"])) {
                //check they are set later
                $data=[
                    'name'=>trim($_POST['name']),
                    'email'=>trim($_POST['email']),
                    'age'=>trim($_POST['age']),
                    'username'=>trim($_POST['username']),
                    'password'=>trim($_POST['password']),
                    'name_err'=>'',
                    'email_err'=>'',
                    'age_err'=>'',
                    'username_err'=>'',
                    'password_err'=>''
                ];

                if(empty($data['name'])){
                    $data['name_err']='Please enter name';

                     $this->view('users/createAccountAjax',$data);
                }

                else {
                    //how do we reference the model
                    $model = $this->model("User");
                    $success = $model->createAccount($data['name'], $data['email'], $data['age'], $data['username'],$data['password']);
                    if ($success) {
                        echo "successfully inserted";
                    } else {
                        echo "insert failed";
                    }
                    $data=[
                        'name'=>'',
                        'email'=>'',
                        'age'=>'',
                        'username'=>'',
                        'password'=>'',
                        'name_err'=>'',
                        'email_err'=>'',
                        'age_err'=>'',
                        'username_err'=>'',
                        'password_err'=>''
                    ];
                    $this->view('users/createAccountAjax',$data);

                }
            }
        } else {
            $data=[
                'name'=>'',
                'email'=>'',
                'age'=>'',
                'username'=>'',
                'password'=>'',
                'name_err'=>'',
                'email_err'=>'',
                'age_err'=>'',
                'username_err'=>'',
                'password_err'=>''
            ];
             $this->view('users/createAccountAjax',$data);
        }
    }









}