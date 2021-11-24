<?php

    Class CadpostController{

        public function index(){

            $loader = new \Twig\Loader\FilesystemLoader('mvc/view');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('postcad.html');
                $parametro = array();

                $conteudo = $template->render($parametro);
                echo $conteudo;

        }

        public function cadastrarPost(){ //cria a funcao para poder cadastrar um post chamando o metodo insert da model postagem

            try {

                Postagem::insert($_POST); //chama o metodo insert, caso o banco de dados receba as informacoes
                echo '<script>alert("Postado com sucesso!!");</script>'; //ele mostra uma mensagem de sucesso 

                echo '<script>location.href="http://localhost/startbootstrap-sb-admin-2-master/cadpost"</script>'; //e redireciona para a parte de cadastro de post novamente
            }
            catch (Exception $e){ //caso nao receba as informacoes 
                
                echo '<script>alert("'.$e->getMessage().'");</script>'; //ele pega a mensagem de erro e armazena na variavel $e->getMessage e manda esse erro em um aviso na tela 

                echo '<script>location.href="http://localhost/startbootstrap-sb-admin-2-master/cadpost"</script>'; //redireciona para a tela de cadastro de post novamente


            }

        }

    }

?>