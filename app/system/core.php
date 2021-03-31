
<?php

    class Core
    {
        protected $currentController = "Login";
        protected $currentMethod = "init";
        protected $params = [];

        // Login/index/
        public function __construct()
        {
            $url = $this->getUrl();
            if($url!= null){
                $contrName = ucwords($url[0]);
                // controller file name start with uppercase letter (convention)
                if(file_exists('../app/controllers/'.$contrName.'.php')){
                    $this->currentController = $contrName;
                    unset($url[0]);
                }
            }
            // require controller
            require '../app/controllers/'.$this->currentController.'.php';
            $this->currentController = new $this->currentController;
            
            if(isset($url[1])){
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }
            $this->params = $url ? array_values($url): [];
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }
        public function getUrl(){
            if(isset($_GET['url'])){
                // remove the last "/" at the end
                $url = rtrim($_GET['url']);

                $url = filter_var($url, FILTER_SANITIZE_URL);
                // break url to array
                $url = explode('/', $url);
                return $url;
            }
        }
    }