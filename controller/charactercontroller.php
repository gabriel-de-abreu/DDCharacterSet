<?php
    include ("../model/Character.php");
    //Dados do personagem
    $objChar=new Character();
    $objChar->name=$_POST["name"];
    $objChar->level=$_POST["level"];
    $objChar->RaceClass=$_POST["raceclass"];
    $objChar->background=$_POST["background"];
    $objChar->playername=$_POST["playername"];
    $objChar->alignment=$_POST["alignment"];
    $objChar->adventuringgrd=$_POST["adventuringgrd"];
    //Atributos
    $objChar->strength=$_POST["strength"];
    $objChar->dexterity=$_POST["dexterity"];
    $objChar->constitution=$_POST["dexterity"];
    $objChar->intelligence=$_POST["intelligence"];
    $objChar->wisdom=$_POST["wisdom"];
    $objChar->charisma=$_POST["charisma"];
    $objChar->inspiration=$_POST["inspiration"];
    $objChar->proefiencybonus=$_POST["proefiencybonus"];
    $objChar->svstrength=$_POST["svstrength"];
    $objChar->svintelligence=$_POST["svintelligence"];
    $objChar->svwisdom=$_POST["svwisdom"];
    $objChar->svcharisma=$_POST["svcharisma"];
    //Other panes
    $objChar->passiveperception=$_POST["passiveperception"];
    $objChar->initiative=$_POST["initiative"];
    $objChar->speed=$_POST["speed"];
    $objChar->vision=$_POST["vision"];
    //next

    //skills
    $objChar->acrobatics=$_POST["acrobatics"];
    $objChar->animalhand=$_POST["animalhand"];
    $objChar->arcana=$_POST["arcana"];
    $objChar->athletics=$_POST["athletics"];
    $objChar->deception=$_POST["deception"];
    $objChar->history=$_POST["history"];
    $objChar->insight=$_POST["intimidation"];
    $objChar->intimidation=$_POST["investigation"];
    $objChar->investigation=$_POST["investigation"];
    $objChar->medicine=$_POST["medicine"];
    $objChar->nature=$_POST["nature"];
    $objChar->perception=["perception"];
    $objChar->religion=$_POST["religion"];
    $objChar->sleiofhand=$_POST["sleiofhand"];
    $objChar->stealth=$_POST["stealth"];
    $objChar->survival=$_POST["survival"];
    
    //Attacks and spell casting

    //Features and traits

    //Inventory and equipment
    $objChar->iC=$_POST["iC"];
    $objChar->iS=$_POST["iS"];
    $objChar->iE=$_POST["iE"];
    $objChar->iG=$_POST["iG"];
    $objChar->iP=$_POST["iP"];
?>