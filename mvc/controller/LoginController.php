<?php

    Class LoginController{

        public function index(){

            $loader = new \Twig\Loader\FilesystemLoader('mvc/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('login.html',['auto_reload' =>true]);
            $params['error'] = $_SESSION['msg_error'] ?? null;

            return $template->render($params);

        }

        public function checking(){ //verifica o cadastro do usuario no banco de dados

            try {

                $user = new User; //chama a classe user
                $user->setEmail($_POST['email']); //recebe o email
                $user->setSenha($_POST['senha']); //recebe a senha
                $user->validateUser(); //usa o metodo validateuser para poder verificar as informacoes recebidas

                header('location: http://localhost/startbootstrap-sb-admin-2-master/home'); //verifica se os dados estao corretos e cria a sessao e redireciona pra home
                
            } catch (\Throwable $th) { //caso os dados sejam incorretos

                $_SESSION['msg_error'] = array('error' => $th->getMessage(), 'count' => 0); //recebe a msg de erro e mostra na tela

                header('location: http://localhost/startbootstrap-sb-admin-2-master/login'); //redireciona para a pagina de login novamente

            }

        }

    }

?>