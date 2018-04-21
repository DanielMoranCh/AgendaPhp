$(function(){

  $('#login-form').submit(function(event){

    var user = $('#login-form').find('#user').val();
    var password = $('#login-form').find('#password').val();

    event.preventDefault();
    $.ajax({
      url: '../server/check_login.php',
      dataType: "json",
      cache: false,
      data: {user: user, password: password},
      type: 'POST',
      success: function(php_response){
        if (php_response.conexion=="OK") {

          if (php_response.acceso == 'concedido') {
            window.location.href = 'main.html';
          }else {
            alert(php_response.motivo);
          }
        }else{
          alert(php_response.conexion);
        }
      },
      error: function(){
        alert("error en la comunicacion con el servidor");
      }
    });

  });

});
