<?php

session_start();
// Values received via ajax
$id = $_POST['id'];
// connection to the database
try {
 $bdd = new PDO('mysql:host=localhost;dbname=agenda_db', 'root', '');
 } catch(Exception $e) {
exit('Unable to connect to database.');
}

  // delete the records
if(strlen($id)!=0)
{
    $sql = "DELETE FROM evento WHERE id=".$id;
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
