<?php

 session_start();
// Values received via ajax
$title = $_POST['titulo'];
$date = $_POST['start_date'];
$edate = $_POST['end_date'];
$start = $_POST['start_hour'];
$end = $_POST['end_hour'];
if($_POST['allDay']==true){
  $allDay = 1;
  $start = '05:00';
  $end = '23:30';
  $edate = $date;
}else{
  $allDay = 0;
}
  // connection to the database
  try {
  $bdd = new PDO('mysql:host=localhost;dbname=agenda_db', 'root', '');
  } catch(Exception $e) {
   exit('Unable to connect to database.');
  }

// insert the records
if(strlen($date)!=0 && strlen($title)!=0)
{
    $sql = "INSERT INTO evento (usuarioid, titulo, start_date, end_date, start_hour, end_hour, allDay) VALUES (".$_SESSION['usuarioid'].",'".$title."','".$date."','".$edate."','".$start."','".$end."',".$allDay.")";
    $q = $bdd->prepare($sql);
    if($q->execute())
      $data['msg']="OK";
    else
      $data['msg']="ERROR";
}
else {
  $data['msg']="Datos vacios";
}
echo json_encode($data);
 ?>
