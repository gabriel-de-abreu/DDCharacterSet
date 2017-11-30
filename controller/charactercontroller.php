<?php
    include ("../model/Character.php");
    $i=$_POST["controllertag"];
        switch($i){
            case 0:
            //Adicionar um novo character
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
                $objChar->perception=["perception"];
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
                $objChar->addChar("fulano");
                break;
            
            case 1:
                $objChar= new Character();
                $objChar::updateChar();
                break;
            case 2:
                $objChar=new Character();
                $objChar::removeChar();
                break;
            case 3: 
                $objChar=new Character();
                $objChar::getChar();
                break;
        }
?>