<?php

// App core class - creates URL and loads core controller  - /controller/method/params

Class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        print_r($this->getUrl()); //(A1.1) DR: returns the array from the url
        $url = $this->getUrl();
        // (A1.2) Look in controllers for first value - it will be our CONTROLLER
        if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){ // (A1.2) DR: so if our url is ...mvc/posts/edit/1 it will check if posts.php exists (we are in public/INDEX.PHP !!!)
            // if exists set as current controller, otherwise it is the default Pages which will be loaded
            $this->currentController = ucwords($url[0]);
            // (A1.2) unset the 0 index
            unset($url[0]);
        }

        // (A1.3) Require the controller
        require_once '../app/controllers/'.$this->currentController.'.php';

        // (A1.4) Instantiate the controller class
        $this->currentController = new $this->currentController; // So if it is pages it will be $pages = new Pages;

        // (A2) Next step is to get the method from the url - it is the "2nd parameter"
        // (A2.1) check for 2nd part of url
        if(isset($url[1])){
            //(A2.1) check to see if method exists in controller
            if(method_exists($this->currentController,$url[1])){
                //(A2.1) if the method exists we set it as the current method
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        //(A3) Any values that are left ovet in the url are the parameters
        $this->params= $url ? array_values($url):[]; // equals what is left or an empty array

        //(A3.1) Call a callback with array of params
        call_user_func_array([$this->currentController,$this->currentMethod], $this->params); // loads the method and we pass the parameters into that method
    }

    // (A1.1) The function that gets the url
    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL); // get rid of any characters url shouldn't have
            $url = explode('/', $url); // put into array everything sepaarted by / char
            return $url;
        }
    }
}