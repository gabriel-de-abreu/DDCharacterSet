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
                $dbh->prepare("INSERT INTO `ddtest`.`User` (`emailUser`, `senhaUser`, `loginUser`) VALUES (:email,:senha,:login);"); 
                $stmp->bindParam(":email",$this->email);
                $stmp->bindParam(":login",$this->username);
                $stmp->bindParam(":senha",$this->password);
                if($stmp->execute()){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                echo "Teste".$e->getMessage();
                die();
            }
        }

    }
?>