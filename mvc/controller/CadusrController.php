<?php

    Class CadusrController{

        public function index(){

            $loader = new \Twig\Loader\FilesystemLoader('mvc/view');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('cadusr.html');

                $parametro = array();

                $conteudo = $template->render($parametro);
                echo $conteudo;

        }

        public function cadastrar(){ //cria a funcao para poder cadastrar um usuario chamando o metodo insert da model user

            try {

                User::insert($_POST); //chama o metodo insert, caso o banco de dados receba as informacoes
                echo '<script>alert("Cadastrado com sucesso!!");</script>'; //ele mostra uma mensagem de sucesso 

                echo '<script>location.href="http://localhost/startbootstrap-sb-admin-2-master/cadusr"</script>'; //e redireciona para a parte de cadastro de usuario novamente
            }
            catch (Exception $e){ //caso nao receba as informacoes
                
                echo '<script>alert("'.$e->getMessage().'");</script>'; //ele pega a mensagem de erro e armazena na variavel $e->getMessage e manda esse erro em um aviso na tela 

                echo '<script>location.href="http://localhost/startbootstrap-sb-admin-2-master/cadusr"</script>'; //redireciona para a tela de cadastro de usuario novamente


            }

        }

    }

?>