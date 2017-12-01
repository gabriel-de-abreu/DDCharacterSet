<?php
    include ("../model/User.php");
    $user = new User;
    $user->setUsername($_POST["login"]);
    $user->setEmail($_POST["email"]);
    $user->setPassword($_POST["password"]);
    if($user->createUser()){
        echo "Usuário criado com sucesso";
    }else{
        echo "Usuário não criado";
    }
?>