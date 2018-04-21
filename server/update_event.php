<?php

session_start();
// Values received via ajax
$id = $_POST['id'];
$date = $_POST['start_date'];
$edate = $_POST['end_date'];
$start = $_POST['start_hour'];
$end = $_POST['end_hour'];

// connection to the database
try {
 $bdd = new PDO('mysql:host=localhost;dbname=agenda_db', 'root', '');
 } catch(Exception $e) { 
exit('Unable to connect to database.');
}
 // update the records
 if(strlen($id)!=0)
 {
   $sql = "UPDATE evento SET start_date='".$date."' , end_date='".$edate."' , start_hour='".$start."' , end_hour='".$end."'  WHERE id=".$id;
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
