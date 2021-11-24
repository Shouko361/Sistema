<?php

    use lib\databases\Connection;

    Class User{

        private $id;
        private $name_usr;
        private $email_usr;
        private $password;

        public function validateUser(){ //funcao para validacao do usuario

            $con = Connection::getConn(); //faz a conexao com o banco dados

            $query = 'SELECT * FROM usr WHERE email_usr = :email'; //sql pro banco de dados
            $sql = $con->prepare($query); //monta o sql pro banco de dados
            $sql->bindValue(':email', $this->email_usr);
            $sql->execute();

            if($sql->rowCount()){

                $result = $sql->fetch();

                if($result['senha'] === $this->password){

                    $_SESSION['id'] = $result['id'];
                    $_SESSION['nome'] = $result['nome_usr'];
                    return true;

                }

            }

            throw new Exception("Email ou Senha Incorretos!"); //caso insira algum dado errado
            
        }

        public function setEmail($email){ //manda o email para variaveis fora da classe
            $this->email_usr = $email;
        }

        public function setNome($nome){ //manda o nome para variaveis fora da classe
            $this->name_usr = $nome;
        }

        public function setSenha($password){ //manda a senha para variaveis fora da classe
            $this->password = $password;
        }

        public function getEmail(){
            return $this->email_usr;
        }

        public function getNome(){
            return $this->name_usr;
        }

        public function getSenha(){
            return $this->password;
        }

        public static function insert($dadosPost){ //funcao para criar um novo usuario

            if(empty($dadosPost['nome']) OR empty($dadosPost['email'] OR empty($dadosPost['senha']))){ //verifica se nao existe nenhum campo vazio

                throw new Exception("Preencha todos os campos"); //caso sim exibe a msg de erro
                return false;

            }

            $con = Connection::getConn(); //chama a conexao com o banco de dados
            $sql = "INSERT INTO usr (nome_usr, email_usr, senha) VALUES (:n, :m, :s)"; //sql pro banco de dados
            $sql = $con->prepare($sql); //montando o sql pro banco de dados
            $sql->bindValue(':n', $dadosPost['nome']); //setando os campos
            $sql->bindValue(':m', $dadosPost['email']);
            $sql->bindValue(':s', $dadosPost['senha']);
            $res = $sql->execute();
            
            if($res == 0){ //caso nao receba os dados ou nao consiga mandar pro banco de dados

                throw new Exception("Falha ao inserir no banco de dados"); //exibe essa msg
                return false;

            }

            return true;
        }
    }
    

?>