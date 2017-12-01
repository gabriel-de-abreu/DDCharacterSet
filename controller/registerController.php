<?php
    include ("../model/User.php");
    $user = new User;
    $user->setUsername($_POST["login"]);
    $user->setEmail($_POST["email"]);
    $user->setPassword($_POST["password"]);

    $ctrl = true;
    if(!$user->uniqueUser()){
        echo "2";
        $ctrl = false;
    }
    if(!$user->uniqueEmail()){
        echo "3";
        $ctrl = false;
    }

    if($ctrl){
        if($user->createUser()){
            echo "1";
        }else{
            echo "0";
        }
    }

    
?>