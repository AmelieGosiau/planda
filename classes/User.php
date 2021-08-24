<?php
    class User{

        private $userId;
        private $username;
        private $password;
        private $email;

        const MIN_USERNAME = 5;
        const MAX_USERNAME = 20; 
        const MIN_PASSWORD = 5; 
        const MAX_PASSWORD = 200; 
        const MIN_CAPITAL = 1;   
 

        const COST_PASSWORD = 11; 

        public static function canLogin($username, $password) {
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT * FROM users WHERE username = :username");
            
            $query->bindValue(":username", $username);
            $query->execute();

            $user = $query->fetch();
            $hash = $user['password'];

            if(!$user) {
                return false;
            }
            
            if(password_verify($password, $hash)) {
                return true;
            } else {
                return false;
            }
        }

        public function setUserId($userId){
            $this->userId = $userId;
        }

        public function getUserId(){
            return $this->userId;
        }

        public static function getUserIdByName($username){
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT id FROM users WHERE username = :username");

            $query-> bindValue(":username", $username);
            $query->execute();
            $result = $query->fetch();

            return $result['id']; 
        }

        public function setUsername($username){

            self::checkUsername($username);

            $this->username = $username;
        }

        public function getUsername(){
            return $this->username;
        }

        public static function getUsernameById($userId){
            $conn = Database::getConnection(); 
            $query = $conn->prepare("SELECT username FROM users WHERE id = :userId");
            
            $query->bindValue(":userId", $userId);
            $query->execute();
            $username = $query->fetch();
            
            return $username["username"];
        }

        public function setPassword($password){
            self::checkPassword($password);
            
            $options = [
                'cost' => self::COST_PASSWORD,
            ];

            $password = password_hash($password, PASSWORD_BCRYPT, $options);

            $this->password = $password;
            return $this;
        }

        public function getPassword(){
            return $this->password;
        }

        public static function getPasswordById($userId){
            $conn = Database::getConnection(); 
            $query = $conn->prepare("SELECT password FROM users WHERE id = :userId");
            
            $query->bindValue(":userId", $userId);
            $query->execute();
            $password = $query->fetch();
            
            return $password["password"];
        }

        public function setEmail($email){
            self::checkEmail($email);
            $this->email = $email;
        }

        public function getEmail(){
            return $this->email;
        }

        public static function getEmailById($userId){
            $conn = Database::getConnection(); 
            $query = $conn->prepare("SELECT email FROM users WHERE id = :userId");
            
            $query->bindValue(":userId", $userId);
            $query->execute();
            $email = $query->fetch();
            
            return $email["email"];
        }


        public function save(){
            $conn = Database::getConnection();
            $query = $conn->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
            
            $query->bindValue(":username", $this->username);
            $query->bindValue(":password", $this->password);
            $query->bindValue(":email", $this->email);   

            $result=$query->execute();
            return $result;
        }

        private function checkPassword($password){
            if($password == ""){
                throw new Exception("Password cannot be empty.");
            }

            if(strpos($password, " ")){
                throw new Exception("Password cannot contain blank spaces.");
            }

            if(strlen($password) > self::MAX_PASSWORD){
                throw new Exception("Password can only be ". self::MAX_PASSWORD ." characters long.");
            }

            if(strlen($password) < self::MIN_PASSWORD){
                throw new Exception("Password must be at least ". self::MIN_PASSWORD ." characters.");
            }

            if(strlen(preg_replace('![^A-Z]+!', '', $password)) < self::MIN_CAPITAL){
                throw new Exception("Password must contain at least ". self::MIN_CAPITAL ." capital letter.");
            }
        }

        private function checkUsername($username){
            if($username == ""){
                throw new Exception("Username cannot be empty.");
            }

            if(strpos($username, " ")){
                throw new Exception("Username cannot contain blank spaces.");
            }

            if(strlen($username) > self::MAX_USERNAME){
                throw new Exception("Usernames can only be ". self::MAX_USERNAME ." characters long");
            }

            if(strlen($username) < self::MIN_USERNAME){
                throw new Exception("Usernames must be at least ". self::MIN_USERNAME ." characters");
            }

            if($this->usernameExists($username)){
                throw new Exception("This username is taken.");
            }
        } 

        private function checkEmail($email){
            if(empty($email)){
                throw new Exception("Email cannot be empty.");
            }

            if(!strpos($email, "@") || !strpos($email, ".") || strpos($email, " ") ){
                throw new Exception("Email is invalid");
            }

            if($this->emailExists($email)){
                throw new Exception("This email has already been registered.");
            }
        }

        private function emailExists($email){ 
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT id FROM users WHERE email = :email");

            $query->bindValue(":email", $email);            
            $query->execute();
            $result = $query->fetch();

            if(!$result){
                return False;
            } else {
                if (!empty($this->userId)) {
                    if ($result['id'] == $this->userId) {
                        return False;
                    }
                }
                return True;
            }
        }

        private function usernameExists($username){ 
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT id FROM users WHERE username = :username");

            $query->bindValue(":username", $username);            
            $query->execute();
            $result = $query->fetch();

            if(!$result){
                return False;
            } else {
                return True;
            }
        }
       
    }
?>
    

    
