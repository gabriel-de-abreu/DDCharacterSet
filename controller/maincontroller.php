<?php
    session_start();
    include ("../model/User.php");
    include ("../model/Character.php");

    function charDiv($name,$level){
        $var="'".$name."alter'";
        $var2="'".$name."remov'";
        echo "<!--TEMPLATE DE ENTRADA-->
        <label>$name</label>
        <label>$level</label>
        <div>
            <button id=$var>View</button>
        </div>
        <div>
            <button id=$var2>Remove</button>
        </div>";
    }

    
    switch ($_POST["tag"]){

        case 0: //Executar quando a pagina é carregada
            $obj= new Character();
            $st=$obj->getAllCharsNameLevel($_SESSION["mailUser"]);
            while($row =$st->fetch()){
                charDiv($row["nameCharacter"],$row["Level"]);
            }
        break;

        case 1: //Para excluir o char
            $obj= new Character();
            $obj->deleteCharacter($_SESSION["mailUser"],$_POST["charName"],false);
        break;        
        
        case 2: //Para deletar o user
            $obj= new User();
            if($obj->deleteUser($_SESSION["mailUser"])){
                echo "Usuário deletado com sucesso!";
            }
        break;
    }

?>