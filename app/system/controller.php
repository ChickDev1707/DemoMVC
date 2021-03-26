

<?php
    class Controller
    {
        protected function view($view){
            $viewDir = '../views/'.$view.'.php';
            if(file_exists($viewDir)){
                require_once $viewDir;
            }else{
                echo "can't load view";
            }
        }
        protected function model($model){
            $modelDir = '../models/'.$model.'.php';
            if(file_exists($modelDir)){
                require_once $modelDir;
                return new $model();
            }else{
                echo "can't load model";
            }
        }
    }
