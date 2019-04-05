<?php
// (A) Pages is the default controller and index is the default method - libraries/core.php
class Pages extends Controller{ // (B1)

    //(A1.2) in the libraries/core.php this is the default controller
    public function __construct(){
        //echo 'Pages loaded';

    }

    // (A3.1) make this function like this don't ger error if don't include a url
    public function index(){ //(B2) can use the methods of the Controller

        $data = [
            'title'=>'SharePosts2'

        ];

        $this->view('pages/index',$data);
    }

    //(A2.1) The method of this controller from core.php DR: SO EACH PAGE HAS ITS OWN CONTROLLER FUNCTION?
    public function about(){ //(A3.1) the parameters are inside the method from core.php
        $this->view('pages/about'); //(B3) fromt the controller
}
}