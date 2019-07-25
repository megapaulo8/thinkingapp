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
            $this->setHost('us-cdbr-iron-east-02.cleardb.net');
            $this->setLogin('bb326c5e31e512');
            $this->setPassword('d53612da');
            $this->setDatabase('heroku_d189b0ce11f93ea');
            return mysqli_connect($this->getHost(),$this->getLogin(),$this->getPassword(),$this->getDatabase());
        }

        public function disconnect($connection){
            return mysqli_close($connection);
        }

    }
?>