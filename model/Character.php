<?php
    include("AeS.php");
   class Character{
       //Basic information
        public $name;
        public $level;
        public $RaceClass;
        public $background; 
        public $playername;
        public $xppoints;
        public $alignment;
        public $adventuringgrd;
        public $strength;
        public $dexterity;
        public $constitution;
        public $intelligence;
        public $wisdom;
        public $charisma;
        //Pane 2 e 3
        public $inspiration;
        public $proefiencybonus;
        public $armorclass;
        public $maxhp;
        public $temphp;
        public $currenthp;
        //Pane saving throws
        public $svstrength;
        public $svdexterity;
        public $svconstitution;
        public $svintelligence;
        public $svwisdom;
        public $svcharisma;
        public $svinspiration;
        //Other panes
        public $passiveperception;
        public $initiative;
        public $speed;
        public $vision;
        //Next
        public $profandlang;
        //Skills
        public $acrobatics;
        public $animalhand;
        public $arcana;
        public $athletics;
        public $deception;
        public $history;
        public $insight;
        public $intimidation;
        public $investigation;
        public $medicine;
        public $nature;
        public $perception;
        public $performance;
        public $persuasion;
        public $religion;
        public $sleiofhand;
        public $stealth;
        public $survival;
        //Attacks and spellcasting
        public $attsandspell;
        //features and traits
        public $featandtraits;
        //Invetory and equipment
        public $iC;
        public $iS;
        public $iE;
        public $iG;
        public $iP;
        public $iextra;

        function explodeGen($strFromPage){
            $strFromPage=explode("|sep|",$strFromPage);
            for($i=0; $i<count($strFromPage)-1;$i++){
                echo $strFromPage[$i];
                echo "\n";
            }
            return $strFromPage;
        }

        function explodeProfAndLang(){
            $this->profandlang=$this->explodeGen($this->profandlang);

        }
        function explodeAttAndSpell(){
            $arrayAttacks=array();
            $attsandspell=explode("|sepL|",$this->attsandspell);
           // print_r($attsandspell);
            for($i=0;$i<count($attsandspell)-1;$i++){
               $tempitems=explode("|sepC|",$attsandspell[$i]);
            //   print_r($tempitems);
                $objaux= new AeS();
                $objaux->name=$tempitems[0];
                $objaux->attack=$tempitems[1];
                $objaux->damage=$tempitems[2];
                $objaux->range=$tempitems[3];
                $objaux->ammo=$tempitems[4];
                $objaux->used=$tempitems[5];
                array_push($arrayAttacks,$objaux);                
            }
           // print_r($arrayAttacks);
            $this->attsandspell=$arrayAttacks;
        }
        function explodeFeatsAndTraits(){
            $this->featandtraits=$this->explodeGen($this->featandtraits);
        }
        function explodeInvetoryAndEquips(){
            $this->iextra=$this->explodeGen($this->iextra);
        }
        function addChar(){
            echo "Adicionando character";
        }
        function updateChar(){
            echo "Atualizando Character";
        }
        function removeChar(){
            echo "Removendo Character";
        }
        function getChar(){
            echo "Buscando Character";
        }
    }
?>