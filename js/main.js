$(document).ready(function () {
    $.post("../controller/mainController.php", {
        tag:0
    }, function (data, status) {
        document.getElementById("mainTable").innerHTML=data;
        
        $("button").click(function(event){
            var fullid=event.target.id;
            var id="";
            if(fullid.search("alter")!=-1){
                id=fullid.replace("alter","");
            }
            else if(fullid.search(fullid,"remov")!=1){
                id=fullid.replace("remov","");
            }
            alert(id);
        });
    });

});

function gotoChar(nameChar){
    $.post("../controller/mainController.php", {
        tag:0
    }, function (data, status) {
        
    });
}
