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
        //Pane saving throws
        public $svstrength;
        public $svdexterity;
        public $svconstitution;
        public $svintelligence;
        public $svwisdom;
        public $svcharisma;
        //Other panes
        public $passiveperception;
        public $initiative;
        public $speed;
        public $vision;
        public $armorclass;
        public $maxhp;
        public $temphp;
        public $currenthp;
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
        function  getAllCharsNameLevel($user){
            try{
                $dbh = new PDO('mysql:host=localhost;dbname=ddtest', "root", "", array(
                    PDO::ATTR_PERSISTENT => true
                ));
                $st=$dbh->prepare("SELECT `nameCharacter`, `User_emailUser`, `Level` FROM `character` WHERE User_emailUser=:user");
                $st->bindParam(":user",$user);
                if($st->execute()){     
                    return $st;
                }else{
                    return null;
                }
            }
            catch(PDOException $e){
                echo "Teste".$e->getMessage();
                die();
            }
        }
        function explodeGen($strFromPage){
            $strFromPage=explode("|sep|",$strFromPage);
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
        function addChar($user){
            try{
               $dbh = new PDO('mysql:host=localhost;dbname=ddtest', "root", "", array(
                    PDO::ATTR_PERSISTENT => true
                ));
                $this->insertGeneralInfos($user,$dbh);
                $this->insertAttributes($user,$dbh);
                $this->insertOthers($user,$dbh);
                $this->insertSavings($user,$dbh);
                $this->insertSkills($user,$dbh);
                $this->insertProfAndLang($user,$dbh);
                $this->insertFeatsAndTraits($user,$dbh);
                $this->insertInventory($user,$dbh);
                $this->insertAttacksAndSpells($user,$dbh);
            }
            catch(PDOException $e){
                echo "Teste".$e->getMessage();
                die();
            }
            echo "Adicionando character";
        }
        function updateChar(){
            echo "Atualizando Character";
        }
        function removeChar(){
            echo "Removendo Character";
        }
        function getChar($userName,$charName){
            //echo "Buscando Character";
            try{
                $dbh = new PDO('mysql:host=localhost;dbname=ddtest', "root", "", array(
                    PDO::ATTR_PERSISTENT => true
                ));
                $this->getGeneralInfo($dbh,$userName,$charName);
                $this->getAttributes($dbh,$userName,$charName);
                $this->getOthers($dbh,$userName,$charName);
                $this->getSavings($dbh,$userName,$charName);
                $this->getProfAndLang($dbh,$userName,$charName);
                $this->getFeatsAndTraits($dbh,$userName,$charName);
                $this->getInventory($dbh,$userName,$charName);
                $this->getAttacksAndSpells($dbh,$userName,$charName);
                $this->getSkills($dbh,$userName,$charName);

            }
            catch(PDOException $e){
                echo "Teste".$e->getMessage();
                die();                
            }
            echo json_encode($this);
            //print_r($this);
        }
        function getGeneralInfo($connection,$userName,$charName){
            $st=$connection->prepare("SELECT `nameCharacter`, `User_emailUser`, `RaceClass`, `Background`, `PlayerName`,
             `ExperiencePoints`, `Alignment`, `AdventureGround`,`Level` FROM `Character`
              WHERE User_emailUser = :mail AND nameCharacter=:charName");
              $st->bindParam(":mail",$userName);
              $st->bindParam(":charName",$charName);
              if($st->execute()){
                  while($row=$st->fetch()){
                     // print_r($row);
                      $this->name=$row['nameCharacter'];
                      $this->RaceClass=$row["RaceClass"];
                      $this->background=$row["Background"];
                      $this->playername=$row["PlayerName"];
                      $this->xppoints=$row["ExperiencePoints"];
                      $this->alignment=$row["Alignment"];
                      $this->adventuringgrd=$row["AdventureGround"];
                      $this->level=$row["Level"];
                  }
              }
        }
        function getAttributes($connection,$userName,$charName){
            try{
                $st=$connection->prepare("SELECT `Character_User_emailUser`, `Character_nameCharacter`, 
                `Strength`, 
                `Dexterity`, `Constitution`, `Intelligence`, `Wisdom`, 
                `Charisma`, `Inspiration`, `ProefiencyBonus` 
                FROM `Attributes` WHERE Character_User_emailUser = :mail AND Character_nameCharacter=:charName");
                 $st->bindParam(":mail",$userName);
                 $st->bindParam(":charName",$charName);
                 if($st->execute()){
                    while($row=$st->fetch()){
                        //print_r($row);
                        $this->strength=$row["Strength"];
                        $this->dexterity=$row["Dexterity"];
                        $this->constitution=$row["Constitution"];
                        $this->intelligence=$row["Intelligence"];
                        $this->wisdom=$row["Wisdom"];
                        $this->charisma=$row["Charisma"];
                        $this->inspiration=$row["Inspiration"];
                        $this->proefiencybonus=$row["ProefiencyBonus"];
                    }
                 }
            }
            catch(PDOException $e){
                throw $e;
            }
        }
        function getOthers($connection,$userName,$charName){
            try{
                $st=$connection->prepare("SELECT `Character_nameCharacter`, `Character_User_emailUser`, 
                `PassivePerception`, 
                `Iniative`, `Speed`, `Vision`, `ArmorClass`, `MaxHP`, `CurrentHP`,
                 `TempHP` FROM `Other` WHERE Character_User_emailUser = :mail AND Character_nameCharacter=:charName");
                $st->bindParam(":mail",$userName);
                $st->bindParam(":charName",$charName);
                if($st->execute()){
                    while($row=$st->fetch()){
                        $this->passiveperception=$row["PassivePerception"];
                        $this->initiative=$row["Iniative"];
                        $this->speed=$row["Speed"];
                        $this->vision=$row["Vision"];
                        $this->armorclass=$row["ArmorClass"];
                        $this->maxhp=$row["MaxHP"];
                        $this->currenthp=$row["CurrentHP"];
                        $this->temphp=$row["TempHP"];
                    }
                }
            }
            catch(PDOException $e){
                throw $e;   
            }
        }
        function getSavings($connection,$userName,$charName){
            try{
                $st=$connection->prepare("SELECT `Character_nameCharacter`, `Character_User_emailUser`, 
                `Strength`, 
                `Dexterity`, `Constitution`, `Intelligence`, `Wisdom`, `Charisma`
                 FROM `SavingThrows` WHERE Character_User_emailUser = :mail AND Character_nameCharacter=:charName");
                $st->bindParam(":mail",$userName);
                $st->bindParam(":charName",$charName);
                if($st->execute()){
                    while($row=$st->fetch()){
                        $this->svstrength=$row["Strength"];
                        $this->svdexterity=$row["Dexterity"];
                        $this->svconstitution=$row["Constitution"];
                        $this->svintelligence=$row["Intelligence"];
                        $this->svwisdom=$row["Wisdom"];
                        $this->svcharisma=$row["Charisma"];
                    }
                }
            }
            catch(PDOException $e){
                throw $e;
            }
        }
        function getSkills($connection,$userName,$charName){
            try{
                $st=$connection->prepare("SELECT `Character_nameCharacter`, `Character_User_emailUser`, `Acrobatics`, 
                `AnimalHandling`, `Arcana`, `Athletics`, `Deception`, `History`, `Insigth`, `Intimidation`,
                 `Investigation`, `Medicine`, `Nature`, `Perception`, `Performance`, `Persuasion`, `Religion`, 
                 `SleightofHand`, `Stealth`, `Survival` FROM `Skills` 
                 WHERE Character_User_emailUser = :mail AND Character_nameCharacter=:charName");
                 $st->bindParam(":mail",$userName);
                 $st->bindParam(":charName",$charName);
                 if($st->execute()){
                     while($row=$st->fetch()){
                        $this->acrobatics=$row["Acrobatics"];
                        $this->animalhand=$row["AnimalHandling"];
                        $this->arcana=$row["Arcana"];
                        $this->athletics=$row["Athletics"];
                        $this->deception=$row["Deception"];
                        $this->history=$row["History"];
                        $this->insight=$row["Insigth"];
                        $this->intimidation=$row["Intimidation"];
                        $this->investigation=$row["Investigation"];
                        $this->medicine=$row["Medicine"];
                        $this->nature=$row["Nature"];
                        $this->perception=$row["Perception"];
                        $this->performance=$row["Performance"];
                        $this->persuasion=$row["Persuasion"];
                        $this->religion=$row["Religion"];
                        $this->sleiofhand=$row["SleightofHand"];
                        $this->stealth=$row["Stealth"];
                        $this->survival=$row["Survival"];                        
                     }
                 }
            }
            catch(PDOException $e){
                throw $e;   
            }
        }
        function getProfAndLang($connection,$userName,$charName){
            $this->profandlang=array();
            try{
                $st=$connection->prepare("SELECT `Character_nameCharacter`, `Character_User_emailUser`, `Line1`, `Line2`, `Line3`, 
                `Line4`, `Line5`, `Line6`, `Line7`, `Line8`, `Line9`, `Line10` FROM `ProfAndLang` 
                WHERE Character_User_emailUser = :mail AND Character_nameCharacter=:charName");
                $st->bindParam(":mail",$userName);
                $st->bindParam(":charName",$charName);
                if($st->execute()){                    
                    while($row=$st->fetch()){
                        for($i=1;$i<11;$i++){
                            array_push($this->profandlang,$row["Line".($i)]);
                        }
                    }
                }
            }
            catch(PDOException $e){
                
            }
        }
        function getFeatsAndTraits($connection,$userName,$charName){
            $this->featandtraits=array();
            try{
                $st=$connection->prepare("SELECT `Character_nameCharacter`, `Character_User_emailUser`, `Line1`, `Line2`, 
                `Line3`, `Line4`, `Line5`, `Line6`, `Line7`, `Line8`, `Line9`, `Line10`, `Line11`, `Line12`, 
                `Line13`, `Line14`, `Line15`, `Line16`, `Line17`, `Line18` FROM `FeaturesAndTraits` 
                WHERE Character_User_emailUser = :mail AND Character_nameCharacter=:charName");
                $st->bindParam(":mail",$userName);
                $st->bindParam(":charName",$charName);
                if($st->execute()){
                    while($row=$st->fetch()){
                        for($i=1;$i<19;$i++){
                            array_push($this->featandtraits,$row["Line".($i)]);
                        }
                    }
                }
            }
            catch(PDOException $e){
                throw $e;
            }
        }
        function getInventory($connection,$userName,$charName){
            try{
                $st=$connection->prepare("SELECT `Character_nameCharacter`, `Character_User_emailUser`, 
                `iC`, `iS`, `iE`, `iG`, `iP` FROM `InventoryAndEquipment`
                 WHERE Character_User_emailUser = :mail AND Character_nameCharacter=:charName");
                  $st->bindParam(":mail",$userName);
                  $st->bindParam(":charName",$charName);
                  if($st->execute()){
                      while($row=$st->fetch()){
                          $this->iC=$row["iC"];
                          $this->iS=$row["iS"];
                          $this->iE=$row["iE"];
                          $this->iG=$row["iG"];
                          $this->iP=$row["iP"];
                      }
                  }
                  
                  $st=$connection->prepare("SELECT `Character_nameCharacter`, `Character_User_emailUser`, 
                  `Line1`, `Line2`,
                  `Line3`, `Line4`, `Line5`, `Line6`, `Line7`, `Line8`, `Line9`, `Line10`, `Line11`, 
                  `Line12`, `Line13` 
                  FROM `InventoryExtra` 
                  WHERE Character_User_emailUser = :mail AND Character_nameCharacter=:charName");
                  $st->bindParam(":mail",$userName);
                  $st->bindParam(":charName",$charName);                  
                  if($st->execute()){
                    $this->iextra=array();
                      while($row=$st->fetch()){
                          for($i=1;$i<14;$i++){
                            array_push($this->iextra,$row["Line".($i)]);
                          }
                      }
                  }
            }
            catch(PDOException $e){
                throw $e;
            }            
        }
        function getAttacksAndSpells($connection,$userName,$charName){
            $this->attsandspell=array();
            try{
                $st=$connection->prepare("SELECT `Name`, `Attack`, `Damage`, `Range`, `Ammo`, `Used`,
                 `Attributes_Character_User_emailUser`, `Attributes_Character_nameCharacter` 
                 FROM `AttacksAndSpells` 
                 WHERE Attributes_Character_User_emailUser = :mail 
                 AND Attributes_Character_nameCharacter=:charName");
                 $st->bindParam(":mail",$userName);
                 $st->bindParam(":charName",$charName);
                 if($st->execute()){
                     while($row=$st->fetch()){
                         $aesobj=new Aes();
                         $aesobj->name=$row["Name"];
                         $aesobj->attack=$row["Attack"];
                         $aesobj->damage=$row["Damage"];
                         $aesobj->range=$row["Range"];
                         $aesobj->ammo=$row["Ammo"];
                         $aesobj->used=$row["Used"];
                         array_push($this->attsandspell,$aesobj);
                     }
                 }

            }
            catch(PDOException $e){
                throw $e;
            }
        }
        function insertGeneralInfos($user,$connection){
             try{
                $stmp=
                $connection->prepare("INSERT INTO `ddtest`.`Character` (`nameCharacter`, `User_emailUser`, 
                `RaceClass`, `Background`, `PlayerName`, `ExperiencePoints`, `Alignment`, 
                `AdventureGround`, `Level`) 
                VALUES (:nameCharacter,:emailUser, :RaceClass, :Background, :PlayerName, :ExperiencePoints
                ,:aligment, :AdventureGround, :level);"); 
                $stmp->bindParam(":nameCharacter",$this->name);
                $stmp->bindParam(":emailUser",$user);
                $stmp->bindParam(":RaceClass",$this->RaceClass);
                $stmp->bindParam(":Background",$this->background);
                $stmp->bindParam(":PlayerName",$this->playername);
                $stmp->bindParam(":ExperiencePoints",$this->xppoints);
                $stmp->bindParam(":aligment",$this->alignment);
                $stmp->bindParam(":AdventureGround",$this->adventuringgrd);
                $stmp->bindParam(":level",$this->level);
                $stmp->execute();
            }
            catch(PDOException $e){
                throw $e;
            }
        }       
        function insertAttributes($user,$connection){
            try{
                $stmp=$connection->prepare("INSERT INTO `ddtest`.`Attributes` (`Character_User_emailUser`, `Character_nameCharacter`,
                 `Strength`, `Dexterity`, `Constitution`, `Intelligence`, `Wisdom`, `Charisma`, `Inspiration`, `ProefiencyBonus`) 
                VALUES (:userEmail,:nameChar, :str, :dex, :cons, :inte, :wis, :chari, :inspi, :prof);");
                 $stmp->bindParam(":userEmail",$user);
                 $stmp->bindParam(":nameChar",$this->name);
                 $stmp->bindParam(":str",intval($this->strength));
                 $stmp->bindParam(":dex",intval($this->dexterity));
                 $stmp->bindParam(":cons",intval($this->constitution));
                 $stmp->bindParam(":inte",intval($this->intelligence));
                 $stmp->bindParam(":wis",intval($this->wisdom));
                 $stmp->bindParam(":chari",intval($this->charisma));
                 $stmp->bindParam(":inspi",($this->inspiration));
                 $stmp->bindParam(":prof",($this->proefiencybonus));
                 $stmp->execute();


            }
            catch(PDOException $e){
                throw $e;
            }
        }
        function insertOthers($user,$connection){
            try{
                $st=$connection->prepare("INSERT INTO `ddtest`.`Other` (`Character_nameCharacter`,
                 `Character_User_emailUser`, `PassivePerception`, `Iniative`, `Speed`, `Vision`, `ArmorClass`, 
                 `MaxHP`, `CurrentHP`, `TempHP`) 
                VALUES (:nameChar, :userName, :Pp, :initiative, :speed, :vision, :armorclass, :maxhp,
                :currenthp, :temphp);");
                $st->bindparam(":nameChar",$this->name);
                $st->bindparam(":userName",$user);
                $st->bindParam(":Pp",$this->passiveperception);
                $st->bindParam(":initiative",$this->initiative);
                $st->bindParam(":speed",$this->speed);
                $st->bindParam(":vision",$this->vision);
                $st->bindParam(":armorclass",intval($this->armorclass));
                $st->bindParam(":maxhp",intval($this->maxhp));
                $st->bindParam(":currenthp",intval($this->currenthp));
                $st->bindParam(":temphp",intval($this->temphp));
                $st->execute();
            }
            catch(PDOException $e){
                throw $e;
            }
        }
        function insertSavings($user,$connection){
            try{
                $st=$connection->prepare("INSERT INTO `ddtest`.`SavingThrows` 
                (`Character_nameCharacter`, `Character_User_emailUser`, `Strength`, 
                `Dexterity`, `Constitution`, `Intelligence`, `Wisdom`, `Charisma`) 
                VALUES (:nameChar, :userName,:str, :dex, :con, :inte, :wis, :chari);");
                $st->bindParam(":nameChar",$this->name);
                $st->bindParam(":userName",$user);
                $st->bindParam(":str",$this->svstrength);
                $st->bindParam(":dex",$this->svdexterity);
                $st->bindParam(":con",$this->svconstitution);
                $st->bindParam(":inte",$this->svintelligence);
                $st->bindParam(":wis",$this->svwisdom);
                $st->bindParam(":chari",$this->svcharisma);
                $st->execute();
            }   
            catch(PDOException $e){
                throw $e;
            }
        }
        function insertSkills($user,$connection){
            try{
                $st=$connection->prepare("INSERT INTO `ddtest`.`Skills` (`Character_nameCharacter`, 
                `Character_User_emailUser`, `Acrobatics`, `AnimalHandling`, `Arcana`, `Athletics`, 
                `Deception`, `History`, `Insigth`, `Intimidation`, `Investigation`, `Medicine`, 
                `Nature`, `Perception`, `Performance`, `Persuasion`, 
                `Religion`, `SleightofHand`, `Stealth`, `Survival`) 
                VALUES (:charName, :userName, :acro, :animal, :arc,:ath , :dece, 
                :his, :ins, :intimi, :invest, :med, 
                :nat, :perc, :perf, :pers, :religion, :slei, :steal, :surv);");
                $st->bindParam(":charName",$this->name);
                $st->bindParam(":userName",$user);
                $st->bindParam(":acro",$this->acrobatics);
                $st->bindParam(":animal",$this->animalhand);
                $st->bindParam(":arc",$this->arcana);
                $st->bindParam(":ath",$this->athletics);
                $st->bindParam(":dece",$this->deception);
                $st->bindParam(":his",$this->history);
                $st->bindParam(":ins",$this->inspiration);
                $st->bindParam(":intimi",$this->intimidation);
                $st->bindParam(":invest",$this->investigation);
                $st->bindParam(":med",$this->medicine);
                $st->bindParam(":nat",$this->nature);
                $st->bindParam(":perc",$this->perception);
                $st->bindParam(":perf",$this->performance);
                $st->bindParam(":pers",$this->persuasion);
                $st->bindParam(":religion",$this->religion);
                $st->bindParam(":slei",$this->sleiofhand);
                $st->bindParam(":steal",$this->stealth);
                $st->bindParam(":surv",$this->survival);
                $st->execute();
            }
            catch(PDOException $e){
                throw $e;
            }
        }
        function insertProfAndLang($user,$connection){
            $this->explodeProfAndLang();

            try{
                $st=$connection->prepare("INSERT INTO `ddtest`.`ProfAndLang` (`Character_nameCharacter`, 
                `Character_User_emailUser`, 
                `Line1`, `Line2`, `Line3`, `Line4`, `Line5`, `Line6`, `Line7`, `Line8`, `Line9`, `Line10`) 
                VALUES ( :nameChar,:userName ,:line1, :line2, :line3, :line4, :line5, :line6, 
                :line7, :line7, :line8, :line10);");
                $st->bindParam(":nameChar",$this->name);
                $st->bindParam(":userName",$user);
                for($i=0;$i<count($this->profandlang)-1;$i++){
                    $st->bindParam(":line".($i+1),$this->profandlang[$i]);
                }
                $st->execute();
            }
            catch(PDOException $e){
                throw $e;
            }
        }
        function insertFeatsAndTraits($user,$connection){
            $this->explodeFeatsAndTraits();
            try{
                $st=$connection->prepare("INSERT INTO `ddtest`.`FeaturesAndTraits` (`Character_nameCharacter`,
                 `Character_User_emailUser`, `Line1`, `Line2`, `Line3`, `Line4`, `Line5`, `Line6`, `Line7`, 
                 `Line8`, `Line9`, `Line10`, `Line11`, `Line12`, `Line13`, `Line14`, `Line15`, `Line16`, 
                 `Line17`, `Line18`) 
                 VALUES (:charName,:userName,:line1, :line2, :line3, :line4, :line5,:line6,:line7, 
                 :line8, :line9, :line10, :line11, 
                 :line12, :line13, :line14, :line15, :line16, :line17, :line18);");
                 $st->bindParam(":charName",$this->name);
                 $st->bindParam(":userName",$user);
                 for($i=0;$i<count($this->featandtraits)-1;$i++){
                     $st->bindParam(":line".($i+1),$this->featandtraits[$i]);                     
                 }
                 $st->execute();
            }
            catch(PDOException $e){
                throw $e;
            }
        }
        function insertInventory($user,$connection){
            $this->explodeInvetoryAndEquips();
            try{
                $st=$connection->prepare("INSERT INTO `ddtest`.`InventoryAndEquipment` (`Character_nameCharacter`, 
                `Character_User_emailUser`, `iC`, `iS`, `iE`, `iG`, `iP`) 
                VALUES (:nameChar,:userName,:ic, :isi, :ie, :ig, :iP);");
                $st->bindParam(":nameChar",$this->name);
                $st->bindParam(":userName",$user);
                $st->bindParam(":ic",$this->iC);
                $st->bindParam(":isi",$this->iS);
                $st->bindParam(":ie",$this->iE);
                $st->bindParam(":ig",$this->iG);
                $st->bindParam(":iP",$this->iP);
                $st->execute();
                //Para as linhas extras do inventário
                $st=$connection->prepare("INSERT INTO `ddtest`.`InventoryExtra` (`Character_nameCharacter`, 
                `Character_User_emailUser`, `Line1`, `Line2`, `Line3`, `Line4`, `Line5`, `Line6`, `Line7`, 
                `Line8`, `Line9`, `Line10`, `Line11`, `Line12`, `Line13`) 
                VALUES (:nameChar,:userName, :line1, :line2, :line3, :line4, :line5, 
                :line6, :line7, :line8, :line9, :line10, :line11, :line12, :line13);");
                $st->bindParam(":nameChar",$this->name);
                $st->bindParam(":userName",$user);
                for($i=0;$i<count($this->iextra)-1;$i++){
                    $st->bindParam(":line".($i+1),$this->iextra[$i]);
                }
                $st->execute();
            }
            catch (PDOException $e){
                throw $e;
            }
        }   
        function insertAttacksAndSpells($user,$connection){
            $this->explodeAttAndSpell();
            try{
                for($i=0;$i<count($this->attsandspell)-1;$i++){
                    $st=$connection->prepare("INSERT INTO `ddtest`.`AttacksAndSpells` (`Name`, `Attack`, `Damage`,
                     `Range`, 
                    `Ammo`, `Used`, `Attributes_Character_User_emailUser`, `Attributes_Character_nameCharacter`) 
                    VALUES (:nameA,:att , :dam, :ran, :amm, :used, :userName, :nameChar);");
                    $st->bindParam(":nameA",$this->attsandspell[$i]->name);
                    $st->bindParam(":att",$this->attsandspell[$i]->attack);
                    $st->bindParam(":dam",$this->attsandspell[$i]->damage);
                    $st->bindParam(":ran",$this->attsandspell[$i]->range);
                    $st->bindParam(":amm",$this->attsandspell[$i]->ammo);
                    $st->bindParam(":used",$this->attsandspell[$i]->used);
                    $st->bindParam(":userName",$user);
                    $st->bindParam(":nameChar",$this->name);
                    $st->execute();
                }
            }
            catch(PDOException $e){
                throw $e;
            }
        }     
    }
?>