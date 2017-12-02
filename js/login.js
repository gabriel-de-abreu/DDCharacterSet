function verifyLogin(){
    $.post("../controller/loginController.php",{
        tag :0,
        login: document.getElementsByName("login")[0].value,
        password: document.getElementsByName("pass")[0].value
    }, function (data, status) {
        if(~data.indexOf("1")){
            window.location.href = "../view/main.html";
        }else{
            $('#ex').modal();
            if(~data.indexOf("0")){
                result="Usuário não encontrado!<br>";
            }else{
                result="Senha incorreta!<br>";
            }
            document.getElementById("result").innerHTML = result;
        }

    });
}