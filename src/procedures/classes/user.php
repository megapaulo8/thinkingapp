<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'./thinkingapp/src/procedures/classes/dbconnection.php';
    class User {
        private $name, $email, $password, $job_role, $is_responsable;

        public function getName(){
            return $this->name;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setPassword($password){
            $this->password = $password;
        }

        public function getJob_Role(){
            return $this->job_role;
        }

        public function setJob_Role($job_role){
            $this->job_role = $job_role;
        }

        public function getIs_Responsable(){
            return $this->is_responsable;
        }

        public function setIs_Responsable($is_responsable){
            $this->is_responsable = $is_responsable;
        } 
        
        public function getUserByEmail($email){
            $connection = new Connection();
            $info_user = mysqli_query($connection->connection(),"SELECT * FROM users WHERE email = '{$email}'");
            $connection->disconnect($connection->connection());
            return $info_user;
        }

        public function authenticateUser($email,$password){
            $connection = new Connection();
            if ($this->getUserByEmail($email)){
                $try_authenticate = mysqli_query($connection->connection(),"SELECT * FROM users WHERE email = '{$email}' && password = '{$password}'");
                if ($try_authenticate){
                    session_start();
                    $connection->disconnect($connection->connection());
                    $data = mysqli_fetch_assoc($try_authenticate);
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['name'] = $data['name'];
                    $_SESSION['job_role'] = $data['job_role'];
                    $_SESSION['is_responsable'] = $data['is_responsable'];
                    return True;
                }
                else {
                    $connection->disconnect($connection->connection());
                    return False;
                }
            }
            else {
                $connection->disconnect($connection->connection());
                return False;
            }
        }
    }
?>