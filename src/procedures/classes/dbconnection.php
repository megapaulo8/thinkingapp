<?php
    class Connection {
        private $host,$login,$password,$database;

        public function getHost(){
            return $this->host;
        } 

        public function setHost($host){
            $this->host = $host;
        }

        public function getLogin(){
            return $this->login;
        }

        public function setLogin($login){
            $this->login = $login;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setPassword($password){
            $this->password = $password;
        }

        public function getDatabase(){
            return $this->database; 
        }

        public function setDatabase($database){
            $this->database = $database;
        }

        public function connection(){
            $this->setHost('127.0.0.1');
            $this->setLogin('root');
            $this->setPassword('senhadobanco');
            $this->setDatabase('thinkingdb');
            return mysqli_connect($this->getHost(),$this->getLogin(),$this->getPassword(),$this->getDatabase());
        }

        public function disconnect($connection){
            return mysqli_close($connection);
        }

    }
?>
