function registerUser(){
    $.post("../controller/registerController.php",
    {
      login: document.getElementsByName("login")[0].value,
      email: document.getElementsByName("email")[0].value,
      password: document.getElementsByName("password")[0].value
    },function(data,status){
        var result="";
        $('#ex').modal();
        if(~data.indexOf("1")){
            result = "Usuário criado com sucesso!";
            $('#ex').on($.modal.BEFORE_CLOSE, function(event, modal) {
                window.location.href = "../view/login.html";
            });
        }else{
            console.log("entrou no else");
            if(~data.indexOf("2")){
                result+="Nome de usuário já está sendo utilizado!<br>";
            }
            if(~data.indexOf("3")){
                result+="Email já está sendo utilizado!<br>";
            }
            if(~data.indexOf("0")){
                result+="Falha na criação do usuário!<br>";
            }
        }

        document.getElementById("result").innerHTML = result;
    });
}
