<?php

    namespace lib\databases;

    abstract Class Connection{ //cria uma classe abstract para facil e deixar mais seguro as chamadas da classe no codigo

        private static $con; //cria uma variavel privada (mais segurança no codigo)

        public static function getConn(){

            if(!self::$con){ //cria a conexao com o banco de dados
                self::$con = new \PDO('mysql: host=localhost; dbname=sistema', 'root', 'Qwe123@@');
            }

            return self::$con;
        }
    }

?>