$(document).ready(function () {
    $.post("../controller/mainController.php", {
        tag: 0
    }, function (data, status) {
        document.getElementById("mainTable").innerHTML = data;
        $("button").click(function (event) {
            var fullid = event.target.id;
            var id = "";
            if (fullid.search("alter") != -1) {
                id = fullid.replace("alter", "");
                gotoChar(id);
            }
            else if (fullid.search("remov") !=-1) {
                id = fullid.replace("remov", "");
            }
            else if(fullid.search("createChar")!=-1){
                gotoCreateChar();
            }
            else if(fullid.search("logoff")!=-1){
                logoff();
            }

        });
    });

});

function gotoCreateChar(){
    window.location.href = "../view/character.html";
    setCookie("mustLoad","false",5);
}

function gotoChar(nameChar) {
    setCookie("mustLoad","true",5);
    setCookie("nameChar",nameChar,5);
    window.location.href = "../view/character.html";
}

function logoff(){
    setCookie("mustLoad","false",5);
    setCookie("nameChar","",5);
    $.post("../controller/loginController.php", {
        tag: 1
    }, function (data, status) {        

    });
    window.location.href = "../view/index.html";
}