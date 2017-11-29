function gbn (name){
    return document.getElementsByName(name)[0].value;
}
function gbcac(classname, size){
    var message="";    
    for(i=1;i<=size;i++){
        message+=(gbn(classname+i) +"|sep|");
    }
    return message;
}

function gattacks(size){
    var line="";
    for(i=1;i<=size;i++){
        line+= gbn("equip-name-"+i)+"|sepC|"+gbn("equip-atk-"+i)
        +"|sepC|"+gbn("equip-dam-"+i)+"|sepC|"+gbn("equip-range-"+i)+
        "|sepC|"+gbn("equip-ammo-"+i)+"|sepC|"+gbn("equip-used-"+i)+"|sepL|";
    }
    return line;
}
function Send(){
    $.post("../controller/charactercontroller.php",
    {
        //Dados do personagem
        controllertag: 0,
        name: gbn("char_name"),
        level: gbn("char_level"),
        raceclass: gbn("race_class"),
        xppoints: gbn("exp"),
        background: gbn("background"),
        alignment: gbn("alignment"),
        playername: gbn("player_name"),
        adventuringgrd: gbn("adventure-ground"),
        ///Atributos
        strength: gbn("str"),
        dexterity: gbn("dex"),
        constitution: gbn("con"),
        intelligence: gbn("int"),
        wisdom: gbn("wis"),
        charisma: gbn("char"),
        inspiration: gbn("inspi"),
        proefiencybonus: gbn("profbonus"),
        svstrength:gbn("str-sav"),
        svconstitution: gbn("con-sav"),
        svintelligence: gbn("int-sav"),
        svwisdom: gbn("wis-sav"),
        svcharisma: gbn("char-sav"),
        svdexterity:gbn("dex-sav"),
        //Other panes
        passiveperception: gbn("passive-perc"),
        initiative: gbn("initiative"),
        speed: gbn("speed"),
        vision: gbn("vision"),
        //Next
        profandlang: gbcac("other_",10),
        //skills
        acrobatics: gbn("input-acro"),
        animalhand: gbn("input-ah"),
        arcana: gbn("input-arca"),
        athletics: gbn("input-ath"),
        deception: gbn("input-dec"),
        history: gbn("input-his"),
        insight: gbn("input-ins"),
        intimidation: gbn("input-intim"),
        investigation: gbn("input-inves"),
        medicine: gbn("input-med"),
        nature: gbn("input-nat"),
        perception: gbn("input-perc"),
        performance:gbn("input-perf"),
        persuasion: gbn("input-pers"),
        religion: gbn("input-rel"),
        sleiofhand: gbn("input-soh"),
        stealth: gbn("input-steal"),
        survival:gbn("input-surv"),
        //attacks and spellcasting
        attsandspell:gattacks(9),
        //features and traits
        featandtraits: gbcac("trait-",18),
        //Inventory and equipment
        iC: gbn("inv-div-c"),
        iS: gbn("inv-div-s"),
        iE: gbn("inv-div-e"),
        iG: gbn("inv-div-g"),
        iP: gbn("inv-div-p"),
        iextra:gbcac("inv-",13)
    },
    function(data, status){
        console.log(data);
    });
}