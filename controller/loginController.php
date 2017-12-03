<?php
    include ("../model/User.php");
    switch ($_POST["tag"]){
        case 0: //Login
            $user = new User;
            $user->setUsername($_POST["login"]);
            $user->setPassword($_POST["password"]);

            $res = $user->authenticateUser();
                if(empty($res)){
                    echo "0";
                }
                else{
                    if($res[0]["senhaUser"]==$user->getPassword()){
                        session_start();
                        $_SESSION["mailUser"]=$user->getUserMail($_POST["login"]);
                        $_POST["password"]="";
                        echo "1";
                    }else{
                        echo "2";
                    }
                }
        break;
        case 1://logoff
            session_start();
            $_SESSION["mailUser"]="";
            session_destroy();
        break;

        case 2: //Check session

        break;
    }
?>