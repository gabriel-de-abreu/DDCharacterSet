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

        function uniqueUser(){
            try{
                $dbh = new PDO('mysql:host=localhost;dbname=ddtest', "root", "", array(
                    PDO::ATTR_PERSISTENT => true));
                $stmp=
                $dbh->prepare("SELECT `loginUser` FROM `User` WHERE loginUser=:login;");
                $stmp->bindParam(":login",$this->username);
                $stmp->execute();
               
                if($stmp->rowCount()==0){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                echo "Teste".$e->getMessage();
                die();
            }
        }

        function uniqueEmail(){
            try{
                $dbh = new PDO('mysql:host=localhost;dbname=ddtest', "root", "", array(
                    PDO::ATTR_PERSISTENT => true));
                $stmp=
                $dbh->prepare("SELECT `emailUser` FROM `User` WHERE emailUser=:email;");
                $stmp->bindParam(":email",$this->email);
                $stmp->execute();
               
                if($stmp->rowCount()==0){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                echo "Teste".$e->getMessage();
                die();
            }
        }

        function authenticateUser(){
            try{
                $dbh = new PDO('mysql:host=localhost;dbname=ddtest', "root", "", array(
                    PDO::ATTR_PERSISTENT => true));
                $stmp=
                $dbh->prepare("SELECT `loginUser`,`senhaUser` FROM `User` WHERE loginUser=:login;");
                $stmp->bindParam(":login",$this->username);
                $stmp->execute();
               
                return $stmp->fetchAll();
                
            }catch(PDOException $e){
                echo "Teste".$e->getMessage();
                die();
            }
        }
        function getUserMail($login){
            $mail="";
            $dbh = new PDO('mysql:host=localhost;dbname=ddtest', "root", "", array(
                PDO::ATTR_PERSISTENT => true));
            $stmp=
            $dbh->prepare("SELECT `emailUser`, `senhaUser`, `loginUser` FROM `User` WHERE loginUser=:login");
            $stmp->bindParam(":login",$login);
            if($stmp->execute()){
                while($row=$stmp->fetch()){
                    $mail= $row["emailUser"];
                }
            }
            return $mail;
        }

    }
?>