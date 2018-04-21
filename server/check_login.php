<?php


    require('./bdd.php');

if(isset($_POST['user']))
  $usuario = $_POST['user'];
else {
  $usuario = '';
}

if(isset($_POST['password']))
  $pass = $_POST['password'];
else
  $pass = '';

  $con = new ConectorBD('localhost','root','');

  $response['conexion'] = $con->initConexion('agenda_db');

  if ($response['conexion']=='OK') {
    $resultado_consulta = $con->consultar(['usuario'],
    ['nombre', 'id', 'pass'], 'WHERE mail="'.$usuario.'"');
    if ($resultado_consulta->num_rows != 0) {
      $fila = $resultado_consulta->fetch_assoc();
      //echo md5($pass).'_'.$fila['pass'];
      if (md5($pass)==$fila['pass']) {
        $response['acceso'] = 'concedido';
        session_start();
        $_SESSION['username']=$fila['nombre'];
        $_SESSION['usuarioid']=$fila['id'];
      }else {
        $response['motivo'] = 'password incorrecta';
        $response['acceso'] = 'rechazado';
      }
    }else{
      $response['motivo'] = 'email incorrecto';
      $response['acceso'] = 'rechazado';
    }
  }

  echo json_encode($response);

  $con->cerrarConexion();

 ?>
