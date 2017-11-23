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
            return $email;
        }
        function getUsername($username){
            return $username;
        }
        function getPassword(){
            return $password;
        }
    }
?>