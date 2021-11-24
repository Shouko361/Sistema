<?php

    Class Core{

        private $url;
        private $controller;
        private $method = 'index';
        private $params = array();

        public function __construct(){ //metodo que vai montar a sessao do usuario

            $this->user = $_SESSION['id'] ?? null; //recebe o id da sessao
            $this->error = $_SESSION['msg_error'] ?? null; //recebe o erro caso exista
            
            if(isset($this->error)){
                if($this->error['count'] === 0){

                    $_SESSION['msg_error']['count'] ++;

                }else{

                    unset($_SESSION['msg_error']);
                }
            }

        }

        public function start($request){
            if(isset($request['url'])){

                $this->url = explode('/', $request['url']);
                
                $this->controller = ucfirst($this->url[0]).'Controller';
                array_shift($this->url);

                if(isset($this->url[0])){

                    $this->method = $this->url[0];
                    array_shift($this->url);

                    if(isset($this->url[0])){

                        $this->params = $this->url[0];
                        
                    }else{

                        $this->params = 'index';

                    }

                }else{

                    $this->method = 'index';

                }

            }else{

                $this->controller = 'LoginController';
                $this->method = 'index';

            }
            
            if($this->user){
                $pg_permission = ['HomeController','PostController','CadusrController','CadpostController'];
                if(!isset($this->controller) || !in_array($this->controller, $pg_permission)){
                
                    $this->controller = 'HomeController';
                    $this->method = 'index';
                }
            }
            else{
                $pg_permission = ['LoginController'];

                if(!isset($this->controller) || !in_array($this->controller, $pg_permission)){

                    $this->controller = 'LoginController';
                    $this->method = 'index';
                }
            }
                   

            echo call_user_func(array(new $this->controller, $this->method), $this->params);
        }
    }

?>
