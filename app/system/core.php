
<?php

    // class Core
    // {
    //     protected $currentController = "Pages";
    //     protected $currentMethod = "index";
    //     protected $params = [];

    //     public function __construct()
    //     {
    //         $url = $this->getUrl();
    //         if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
    //             // look for file in controllers
    //             // file begin with the first letter capitalize, so we use ucwords
    //             $this->currentController = ucwords($url[0]);
    //             unset($url);
    //         }
    //         require_once '../app/controllers/'.$this->currentController.'.php';
    //         $this->currentController = new $this->currentController;
    //     }
    //     public function getUrl(){

    //         if(isset($_GET['url'])){
                
    //             $url = rtrim($_GET['url'], '/');

    //             $url = filter_var($url, FILTER_SANITIZE_URL);

    //             $url = explode('/', $_GET['url']);
    //             return $url;
    //         }
    //     }
    // }