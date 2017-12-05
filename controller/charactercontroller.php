<?php
    session_start();
    include ("../model/Character.php");
    function generateCharacter(){
                //Dados do personagem
                $objChar=new Character();
                $objChar->name=$_POST["name"];
                $objChar->level=$_POST["level"];
                $objChar->RaceClass=$_POST["raceclass"];
                $objChar->background=$_POST["background"];
                $objChar->playername=$_POST["playername"];
                $objChar->xppoints=$_POST["xppoints"];
                $objChar->alignment=$_POST["alignment"];
                $objChar->adventuringgrd=$_POST["adventuringgrd"];
                //Atributos
                $objChar->strength=$_POST["strength"];
                $objChar->dexterity=$_POST["dexterity"];
                $objChar->constitution=$_POST["constitution"];
                $objChar->intelligence=$_POST["intelligence"];
                $objChar->wisdom=$_POST["wisdom"];
                $objChar->charisma=$_POST["charisma"];
                $objChar->inspiration=$_POST["inspiration"];
                $objChar->proefiencybonus=$_POST["proefiencybonus"];
                //SavingThrows
                $objChar->svstrength=$_POST["svstrength"];
                $objChar->svconstitution=$_POST["svconstitution"];
                $objChar->svdexterity=$_POST["svdexterity"];
                $objChar->svintelligence=$_POST["svintelligence"];
                $objChar->svwisdom=$_POST["svwisdom"];
                $objChar->svcharisma=$_POST["svcharisma"];
                //Other panes
                $objChar->passiveperception=$_POST["passiveperception"];
                $objChar->initiative=$_POST["initiative"];
                $objChar->speed=$_POST["speed"];
                $objChar->vision=$_POST["vision"];
                $objChar->armorclass=$_POST["armorclass"];
                $objChar->maxhp=$_POST["maxhp"];
                $objChar->temphp=$_POST["temphp"];
                $objChar->currenthp=$_POST["currenthp"];
                //next
                $objChar->profandlang=$_POST["profandlang"];
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
                $objChar->perception=$_POST["perception"];
                $objChar->performance=$_POST["performance"];
                $objChar->persuasion=$_POST["persuasion"];
                $objChar->religion=$_POST["religion"];
                $objChar->sleiofhand=$_POST["sleiofhand"];
                $objChar->stealth=$_POST["stealth"];
                $objChar->survival=$_POST["survival"];    
                //Attacks and spell casting
                $objChar->attsandspell=$_POST["attsandspell"];
                //Features and traits
                $objChar->featandtraits=$_POST["featandtraits"];
                //Inventory and equipment
                $objChar->iC=$_POST["iC"];
                $objChar->iS=$_POST["iS"];
                $objChar->iE=$_POST["iE"];
                $objChar->iG=$_POST["iG"];
                $objChar->iP=$_POST["iP"];
                $objChar->iextra=$_POST["iextra"];
                return $objChar;       

    }
    $i=$_POST["controllertag"];
        switch($i){
            case 0:
            //Adicionar um novo character
                generateCharacter()->addChar($_SESSION["mailUser"],false);
                break;
            
            case 1:
            //Atualizar character
                $checkaux=($_POST["charName"]==$_POST["name"]);
                generateCharacter()->updateChar($_SESSION["mailUser"],$_POST["charName"],$checkaux);
                break;
            case 2:
            //Deletar Character
                $objChar=new Character();
                $objChar->deleteCharacter($_SESSION["mailUser"],$_POST["charName"],false);
                break;
            case 3: 
            //Recuperar informações
                $objChar=new Character();
                echo $objChar->getChar($_SESSION["mailUser"],$_POST["charName"]);
                break;
        }
?>