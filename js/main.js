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
            else if (fullid.search(fullid, "remov") != 1) {
                id = fullid.replace("remov", "");
            }

        });
    });

});

function gotoChar(nameChar) {
    setCookie("mustLoad","true",5);
    setCookie("nameChar",nameChar,5);
    window.location.href = "../view/character.html";
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}