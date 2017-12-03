var sendOption = 0;
checkSession();
$(document).ready(function () {
    setGenStats();
    setFormAction();
    sbn("player_name",getCookie("userLogin"));
    if (getCookie("mustLoad") == "true") {
        sendOption=1;
        getData(getCookie("nameChar"));
        setDeleteButton();
    } else {
        $("#DeleteButton").hide();
        $("#save-char-a").text("Create");

    }
});
function alterNav(nameChar){
    sendOption=1;
    setCookie("nameChar",nameChar);
    setCookie("mustLoad","true");
    $("#DeleteButton").show();
    $("#save-char-a").text("Save");
    setDeleteButton();
    getData(nameChar);
}
function setFormAction(){
    $("#save-char-a").click(function(){
        $("#form-button").click();
    });
}
function setGenStats() {
    $("#gen-stats").click(function () {
        $.post("../controller/statsController.php", function (data, status) {
            var res = JSON.parse(data);
            for (i in res) {
                sbn(i, res[i]);
            }
        })
    });
}

function getStat() {
    $.post("../controller/statsController.php", function (data, status) {
        var res = JSON.parse(data);
        for (i in res) {
            sbn(i, res[i]);
        }
    });
}
function setDeleteButton() {
    $("#DeleteButton").click(function () {
        $("#name").html(getCookie("nameChar"));
        $("#del-modal").modal({
            showClose: false
        });
    });
    $("#yes-del").click(function(){
        $.post("../controller/charactercontroller.php", {
            controllertag: 2,
            charName: getCookie("nameChar")
        }, function (data, status) {
            window.location.href = "../view/main.html";
        });
    });
    $("#no-del").click(function(){
        $.modal.close();
    });
    
}

function gbn(name) {
    return document.getElementsByName(name)[0].value;
}
function sbn(name, value) {
    document.getElementsByName(name)[0].value = value;
}
function gbcac(classname, size) {
    var message = "";
    for (i = 1; i <= size; i++) {
        message += (gbn(classname + i) + "|sep|");
    }
    return message;
}

function gattacks(size) {
    var line = "";
    for (i = 1; i < size; i++) {
        line += gbn("equip-name-" + i) + "|sepC|" + gbn("equip-atk-" + i)
            + "|sepC|" + gbn("equip-dam-" + i) + "|sepC|" + gbn("equip-range-" + i) +
            "|sepC|" + gbn("equip-ammo-" + i) + "|sepC|" + gbn("equip-used-" + i) + "|sepL|";
    }
    //console.log(line);
    return line;
}
function Send() {
    $.post("../controller/charactercontroller.php",
        {
            //Dados do personagem
            controllertag: sendOption,
            charName:getCookie("nameChar"),
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
            svstrength: gbn("str-sav"),
            svconstitution: gbn("con-sav"),
            svintelligence: gbn("int-sav"),
            svwisdom: gbn("wis-sav"),
            svcharisma: gbn("char-sav"),
            svdexterity: gbn("dex-sav"),
            //Other panes
            passiveperception: gbn("passive-perc"),
            initiative: gbn("initiative"),
            speed: gbn("speed"),
            vision: gbn("vision"),
            armorclass: gbn("armor_class"),
            maxhp: gbn("max_hp"),
            temphp: gbn("temp_hp"),
            currenthp: gbn("current_hp"),
            //Next
            profandlang: gbcac("other_", 10),
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
            performance: gbn("input-perf"),
            persuasion: gbn("input-pers"),
            religion: gbn("input-rel"),
            sleiofhand: gbn("input-soh"),
            stealth: gbn("input-steal"),
            survival: gbn("input-surv"),
            //attacks and spellcasting
            attsandspell: gattacks(10),
            //features and traits
            featandtraits: gbcac("trait-", 18),
            //Inventory and equipment
            iC: gbn("inv-div-c"),
            iS: gbn("inv-div-s"),
            iE: gbn("inv-div-e"),
            iG: gbn("inv-div-g"),
            iP: gbn("inv-div-p"),
            iextra: gbcac("inv-", 13)
        },
        function (data, status) {
            console.log(data);
            document.getElementById("result").innerHTML = data;
            $('#ex').modal();
            if(data.search("Personagem inserido com sucesso!")!=-1){
                alterNav(gbn("char_name"));
            }
        });
}
function getData(nameChar) {
    $.post("../controller/charactercontroller.php",
        {
            //Dados do personagem
            controllertag: 3,
            charName: nameChar
        },
        function (data, status) {
            //console.log(data);
            var objChar = JSON.parse(data);
            //console.log(objChar);
            sbn("char_name", objChar.name);
            sbn("char_level", objChar.level);
            sbn("race_class", objChar.RaceClass);
            sbn("exp", objChar.xppoints);
            sbn("background", objChar.background);
            sbn("alignment", objChar.alignment);
            sbn("player_name", objChar.playername);
            sbn("adventure-ground", objChar.adventuringgrd);
            sbn("str", objChar.strength);
            sbn("dex", objChar.dexterity);
            sbn("con", objChar.constitution);
            sbn("int", objChar.intelligence);
            sbn("wis", objChar.wisdom);
            sbn("char", objChar.charisma);
            sbn("inspi", objChar.inspiration);
            sbn("profbonus", objChar.proefiencybonus);
            sbn("str-sav", objChar.svstrength);
            sbn("dex-sav", objChar.svdexterity);
            sbn("con-sav", objChar.svconstitution);
            sbn("int-sav", objChar.svintelligence);
            sbn("wis-sav", objChar.svwisdom);
            sbn("char-sav", objChar.svcharisma);
            sbn("armor_class", objChar.armorclass);
            sbn("max_hp", objChar.maxhp);
            sbn("temp_hp", objChar.temphp);
            sbn("current_hp", objChar.currenthp);
            sbn("passive-perc", objChar.passiveperception);
            sbn("initiative", objChar.initiative);
            sbn("speed", objChar.speed);
            sbn("vision", objChar.vision);
            for (var it = 0; it < 10; it++) {
                sbn("other_" + (it + 1), objChar.profandlang[it]);
            }
            sbn("input-acro", objChar.acrobatics);
            sbn("input-ah", objChar.animalhand);
            sbn("input-ath", objChar.athletics);
            sbn("input-arca", objChar.arcana);
            sbn("input-dec", objChar.deception);
            sbn("input-his", objChar.history);
            sbn("input-ins", objChar.inspiration);
            sbn("input-intim", objChar.intimidation);
            sbn("input-inves", objChar.investigation);
            sbn("input-med", objChar.medicine);
            sbn("input-nat", objChar.nature);
            sbn("input-perc", objChar.perception);
            sbn("input-perf", objChar.performance);
            sbn("input-pers", objChar.persuasion);
            sbn("input-rel", objChar.religion);
            sbn("input-soh", objChar.sleiofhand);
            sbn("input-steal", objChar.stealth);
            sbn("input-surv", objChar.survival);
            for (var it = 0; it < 10; it++) {
                if (objChar.attsandspell[it] != null) {
                    sbn("equip-name-" + (it + 1), objChar.attsandspell[it].name);
                    sbn("equip-atk-" + (it + 1), objChar.attsandspell[it].attack);
                    sbn("equip-dam-" + (it + 1), objChar.attsandspell[it].damage);
                    sbn("equip-range-" + (it + 1), objChar.attsandspell[it].range);
                    sbn("equip-ammo-" + (it + 1), objChar.attsandspell[it].ammo);
                    sbn("equip-used-" + (it + 1), objChar.attsandspell[it].used);
                }
            }
            for (var it = 0; it < 18; it++) {
                sbn("trait-" + (it + 1), objChar.featandtraits[it]);
            }
            sbn("inv-div-c", objChar.iC);
            sbn("inv-div-s", objChar.iS);
            sbn("inv-div-e", objChar.iE);
            sbn("inv-div-g", objChar.iG);
            sbn("inv-div-p", objChar.iP);
            for (var it = 0; it < 13; it++) {
                sbn("inv-" + (it + 1), objChar.iextra[it]);
            }
        });
}