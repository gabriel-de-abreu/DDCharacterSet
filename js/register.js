function registerUser(){
    $.post("../controller/registerController.php",
    {
      login: document.getElementsByName("login")[0].value,
      email: document.getElementsByName("email")[0].value,
      password: document.getElementsByName("password")[0].value
    },function(data,status){
        document.getElementById("result").innerHTML = data;
        $('#ex').modal();
        if(data == "Usuário criado com sucesso"){
            $('#ex').on($.modal.BEFORE_CLOSE, function(event, modal) {
                window.location.href = "../view/login.html";
            });
        }
    });
}
