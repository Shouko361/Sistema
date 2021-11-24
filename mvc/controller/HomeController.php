<?php

    Class HomeController{

        public function index(){

            try {

                $colect = Postagem::selecionaTodos(); //chama todas as postagens cadastradas no banco de dados

                $loader = new \Twig\Loader\FilesystemLoader('mvc/view');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('home.html'); //carrega tudo na home.html

                $parametro = array();
                $parametro['postagens'] = $colect;

                $conteudo = $template->render($parametro);
                echo $conteudo;

            } 
            catch (Exception $e) {

                echo $e->getMessage();

            }
            
        }

        public function logout(){ //funcao para fazer o logof e destruir a sessao do usuario

            unset($_SESSION['id']);
            session_destroy();

            header('location: http://localhost/startbootstrap-sb-admin-2-master/'); //redireciona para a pagina de login

        }

    }

?>