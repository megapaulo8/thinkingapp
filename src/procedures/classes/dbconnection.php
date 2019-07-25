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
            //Ligar com o DB usando o HEROKU 
            $url = parse_url(getenv("mysql://bb326c5e31e512:d53612da@us-cdbr-iron-east-02.cleardb.net/heroku_d189b0ce11f93ea?reconnect=true"));
            $this->setHost($url["us-cdbr-iron-east-02.cleardb.net"]);
            $this->setLogin($url["bb326c5e31e512"]);
            $this->setPassword($url["d53612da"]);
            $this->setDatabase(substr($url["mysql://bb326c5e31e512:d53612da@us-cdbr-iron-east-02.cleardb.net/heroku_d189b0ce11f93ea?reconnect=true"], 1));
            return new mysqli($this->getHost(),$this->getLogin(),$this->getPassword(),$this->getDatabase());
        }

        public function disconnect($connection){
            return mysqli_close($connection);
        }

    }
?>