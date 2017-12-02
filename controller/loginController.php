<?php
    include ("../model/User.php");
    $user = new User;
    $user->setUsername($_POST["login"]);
    $user->setPassword($_POST["password"]);

    $res = $user->authenticateUser();
    if(empty($res)){
        echo "0";
    }else{
        if($res[0]["senhaUser"]==$user->getPassword()){
            echo "1";
        }else{
            echo "2";
        }
    }
?>