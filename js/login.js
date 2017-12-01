function verifyLogin(){
    console.log("bug");
    $.post("../controller/loginController.php",{
        login: document.getElementsByName("login")[0].value,
        password: document.getElementsByName("pass")[0].value
    }, function (data, status) {
        console.log(data);
    });
}