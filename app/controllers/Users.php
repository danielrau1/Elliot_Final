<?php
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
                'password'=>trim($_POST['password']),
                'confirm_password'=>trim($_POST['confirm_password']),
                'name_err'=>'',
                'email_err'=>'',
                'password_err'=>'',
                'confirm_password_err'=>''
            ];
            // validate email
            if(empty($data['email'])){
                $data['email_err']='Please enter emil';
            }else{
                //check email
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err']='email exists';
                }
            }
            // validate name
            if(empty($data['name'])){
                $data['name_err']='Please enter name';
            }

            // validate password
            if(empty($data['password'])){
                $data['password_err']='Please enter password';
            }
            // validate password
            if(empty($data['password'])){
                $data['password_err']='Please enter password';
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
            if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
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
                'password'=>'',
                'confirm_password'=>'',
                'name_err'=>'',
                'email_err'=>'',
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
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            // Validate Email
            if(empty($data['email'])){
                $data['email_err'] = 'Pleae enter email';
            }

            // Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }


            // Check for user /email
            if($this->userModel->findUserByEmail($data['email'])){
                //user found
            }else{
                $data['email_err'] = "no user found";
            }


            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['password_err'])) {
                // Validated
               //check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'],$data['password']);
            if($loggedInUser){
                // create sessions
                die('success');
            }else{
                $data['password_err']='password incorrect';
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
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
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
                    'password'=>trim($_POST['password']),
                    'name_err'=>'',
                    'email_err'=>'',
                    'password_err'=>''
                ];

                if(empty($data['name'])){
                    $data['name_err']='Please enter name';

                     $this->view('users/createAccountAjax',$data);
                }

                else {
                    //how do we reference the model
                    $model = $this->model("User");
                    $success = $model->createAccount($data['name'], $data['email'], $data['password']);
                    if ($success) {
                        echo "successfully inserted";
                    } else {
                        echo "insert failed";
                    }
                    $data=[
                        'name'=>'',
                        'email'=>'',
                        'password'=>'',
                        'name_err'=>'',
                        'email_err'=>'',
                        'password_err'=>''
                    ];
                    $this->view('users/createAccountAjax',$data);

                }
            }
        } else {
            $data=[
                'name'=>'',
                'email'=>'',
                'password'=>'',
                'name_err'=>'',
                'email_err'=>'',
                'password_err'=>''
            ];
             $this->view('users/createAccountAjax',$data);
        }
    }









}