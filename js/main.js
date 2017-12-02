function loadPage() {
    $.post("../controller/maincontroller.php", {
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
            else if (fullid.search("remov") != -1) {
                id = fullid.replace("remov", "");
                $("#name").html(id);
                $("#ex").modal({
                    showClose: false
                });
            }
            else if (fullid.search("createChar") != -1) {
                gotoCreateChar();
            }
            else if (fullid.search("logoff") != -1) {
                logoff();
            }else if(~fullid.search("yes")){
                deleteChar($("#name").html());
                $.modal.close();
            }else if(~fullid.search("no")){
                $.modal.close();
            }
        });
    });
}
$(document).ready(function () {
    loadPage();
    setDelete();

});
function setDelete(){
    $("#delete-user").click(function(){
        deleteUser();
    });
}
function deleteChar(nameChar) {
    $.post("../controller/maincontroller.php", {
        tag: 1,
        charName: nameChar
    }, function (data, status) {
        console.log(data);
        loadPage();
    });
}

function gotoCreateChar() {
    window.location.href = "../view/character.html";
    setCookie("mustLoad", "false", 5);
}

function gotoChar(nameChar) {
    setCookie("mustLoad", "true", 5);
    setCookie("nameChar", nameChar, 5);
    window.location.href = "../view/character.html";
}

function logoff() {
    setCookie("mustLoad", "false", 5);
    setCookie("nameChar", "", 5);
    $.post("../controller/loginController.php", {
        tag: 1
    }, function (data, status) {

    });
    window.location.href = "../view/index.html";
}
function deleteUser(){
    $.post("../controller/maincontroller.php", {
        tag: 2
    }, function (data, status) {
        alert(data);
    });
    window.location.href = "../view/index.html";  
}