<?php
    $atrib = array("str","dex","con","int","wis","char");
    for($i=0;$i<6;$i++){
        $array[$atrib[$i]] = rand(3,18);
    }
    echo json_encode($array);
?>