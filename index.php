<?php

    session_start(); //recebe a sessao 

    require_once 'lib/databases/Connection.php';
    require_once 'mvc/model/User.php';
    require_once 'mvc/model/Comentario.php';
    require_once 'mvc/model/Postagem.php';
    require_once 'mvc/core/Core.php';
    require_once 'mvc/controller/PostController.php';
    require_once 'mvc/controller/CadpostController.php';
    require_once 'mvc/controller/CadusrController.php';
    require_once 'mvc/controller/HomeController.php';
    require_once 'mvc/controller/LoginController.php';
    
    require_once 'vendor/autoload.php';

    $core = new Core; //chama a classe core

    if(isset($_SESSION['id'])){ //verifica se existe uma sessao

        $template = file_get_contents('mvc/template/estrutura.html'); //pega a estrutura do site
        $template = str_replace('{{nome}}', $_SESSION['nome'], $template); //altera o nome de usuario no canto superior direito da estrutura de acordo com o nome no banco de dados
        ob_start(); //cria o objeto start    
            $core->start($_GET); //chama o metodo start recebendo o metodo GET trasendo os dados da url

            $saida = ob_get_contents(); //armazena em $saida
        ob_end_clean();

    $tpl = str_replace('{{conteudo_aqui}}', $saida, $template); //altera o campo {{conteudo_aqui}} pelo conteudo dinamico das controllers

    echo $tpl; //mostra o conteudo

    }else{

        $core->start($_GET); //caso nao exista uma sessao ele permanece no login

    }

    
?>