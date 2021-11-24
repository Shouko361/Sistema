<?php

    use lib\databases\Connection;


    class Comentario {

            public static function selecionarComentarios($idPost){ //funcao que vai selecionar todos os comentarios do banco de dados

                $con = Connection::getConn(); //recebe a conexao com o banco dados

                $sql = "SELECT * FROM comentario WHERE id_post = :id"; //sql pro banco de dados
                $sql = $con->prepare($sql); //montando o sql pro banco de dados
                $sql->bindValue(':id', $idPost, PDO::PARAM_INT); 
                $sql->execute();

                $resultado = array();

                while ($row = $sql->fetchObject('Comentario')) {
                    $resultado[] = $row;
                }

                return $resultado;
            }

            public static function inserir($reqPost){ //funcao para criar um novo comentario

                $con = Connection::getConn(); //recebe a conexao com o banco dados

                $sql = "INSERT INTO comentario (nome, comentario, id_post) VALUES (:nom, :msg, :idp)"; //sql pro banco de dados
                $sql = $con->prepare($sql); //montando o sql pro banco de dados
                $sql->bindValue(':nom', $reqPost['nome']); //recebe os valores dos campos pela $reqPost e pega os valores no campo nome
                $sql->bindValue(':msg', $reqPost['comentario']); //recebe os valores dos campos pela $reqPost e pega os valores no campo email
                $sql->bindValue(':idp', $reqPost['id']); //recebe os valores dos campos pela $reqPost e pega os valores no campo id
                $sql->execute();

                if ($sql->rowCount()) {
                    return true;
                }

                throw new Exception("Falha na inserção"); //apresenta msg de erro
            }
        }

?>