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
            $_SESSION=array();
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            session_destroy();
        break;

        case 2: //Check session
                session_start();
                if(isset($_SESSION["mailUser"])){
                    echo "OK";
                }else{
                    echo "You shall not Pass";
                }
        break;
    }
?>