<?php
    session_start();
    include ("../model/User.php");
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
    $useraux=new User();
    include ("../model/Character.php");
    switch ($_POST["tag"]){

        case 0: //Executar quando a pagina é carregada
        $obj= new Character();
        $st=$obj->getAllCharsNameLevel($_SESSION["mailUser"]);
        while($row =$st->fetch()){
            charDiv($row["nameCharacter"],$row["Level"]);
        }
        break;

        case 1: //Para excluir o char
        break;
        
        case 2: //Para fazer o logoff
        break;
        
    }

?>