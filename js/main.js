$(document).ready(function () {
    $.post("../controller/mainController.php", {
        tag:0
    }, function (data, status) {
        document.getElementById("mainTable").innerHTML=data;
        $("button").click(function(event){
            alert(event.target.id);
        });
    });

});

