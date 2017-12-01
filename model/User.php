<?php
    class User{
        private $email;
        private $username;
        private $password;

        function setEmail($email){
            $this->email=$email;
        }
        function setUsername($username){
            $this->username=$username;
        }
        function setPassword($password){
            $this->password=$password;
        }
        function getEmail(){
            return $this->email;
        }
        function getUsername(){
            return $this->username;
        }
        function getPassword(){
            return $this->password;
        }

        function createUser(){
            try{
                $dbh = new PDO('mysql:host=localhost;dbname=ddtest', "root", "", array(
                    PDO::ATTR_PERSISTENT => true));
                $stmp=
                $connection->prepare("INSERT INTO `ddtest`.`User` (`emailUser`, `senhaUser`, `loginUser`) VALUES (:email,:senha,:login);"); 
                $stmp->bindParam(":email",$this->email);
                $stmp->bindParam(":senha",$this->username);
                $stmp->bindParam(":login",$this->password);
                $stmp->execute();
                print_r($this);
            }catch(PDOException $e){
                echo "Teste".$e->getMessage();
                die();
            }
        }

    }
?>