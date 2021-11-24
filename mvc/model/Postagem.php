<?php

    use lib\databases\Connection;

    Class Postagem{

        public static function selecionaTodos(){ //funcao que tras todas as postagens do banco de dados

            $con = Connection::getConn(); //recebe a conexao com o banco dados

            $sql = "SELECT * FROM postagens ORDER BY id_post";  //seleciona todas as postagens do banco de dados
            $query = $con->prepare($sql); //montando o sql pro banco de dados
            $query->execute();

            $result = array();

            while ($row = $query->fetchObject('Postagem')){

                $result[] = $row;

            }

            if(!$result){

                throw new Exception("Não foi encontrado nenhum registro em nosso banco de dados!"); //se estiver algum erro aparece essa msg

            }

            return $result;

        }

        public static function selecionaPorId($idPost){ //seleciona a postagem selecionada pelo id

            $con = Connection::getConn(); //recebe a conexao com o banco dados

            $sql = "SELECT * FROM postagens WHERE id_post = :id"; //sql pro banco de dados
            $query = $con->prepare($sql); //montando o sql pro banco de dados
            $query->bindValue(':id', $idPost, PDO::PARAM_INT);
            $query->execute();

            $resultado = $query->fetchObject('Postagem');

            if(!$resultado){

                throw new Exception("Não foi encontrado nenhum registro em nosso banco de dados!! Por favor tente mais tarde!");

            }
            else{

				$resultado->comentario = Comentario::selecionarComentarios($resultado->id_post); //tras os comentarios
            
            }
            return $resultado;

        }

        public static function insert($dadosPost){  //cria uma nova postagem

            if(empty($dadosPost['titulo']) OR empty($dadosPost['conteudo'])){ //verifica se os campos nao estao vazios

                throw new Exception("Preencha todos os campos"); //se estiver algum faltando aparece essa msg
                return false;

            } //se nao ele continua o codigo

            $con = Connection::getConn(); //recebe a conexao com o banco dados
            $sql = "INSERT INTO postagem (titulo, conteudo) VALUES (:titulo, :conteudo)"; //sql pro banco de dados
            $sql = $con->prepare($sql); //montando o sql pro banco de dados
            $sql->bindValue(':titulo', $dadosPost['titulo']);
            $sql->bindValue(':conteudo', $dadosPost['conteudo']);
            $res = $sql->execute();
            
            if($res == 0){

                throw new Exception("Falha ao inserir no banco de dados"); //se estiver algum erro aparece essa msg
                return false;

            }

            return true;

        }

    }

?>