function gbn (name){
    return document.getElementsByName(name)[0].value;
}
function gbcac(classname){
    var message="";
    var inputs= document.getElementsByClassName(classname);
    for(i=0;i<inputs.length;i++){
        message+=(inputs[i].value +"|sep|");
    }
    return message;
}
function Send(){
    $.post("../controller/charactercontroller.php",
    {
        //Dados do personagem
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
        //Other panes
        passiveperception: gbn("passive-perc"),
        initiative: gbn("initiative"),
        speed: gbn("speed"),
        vision: gbn("vision"),
        //Next
        profandlang: gbcac("other-prof"),
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
        survival:gbn("input-surv")
    },
    function(data, status){
        alert(data);
    });
}