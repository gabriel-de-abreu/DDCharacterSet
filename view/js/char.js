function gbn (name){
    return document.getElementsByName(name)[0].value;
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
        vision: gbn("vision")
    },
    function(data, status){
        alert(data);
    });
}