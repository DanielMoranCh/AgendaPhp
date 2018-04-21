<?php

// List of events
 $json = array();
 session_start();

 $requete = "SELECT id, titulo as title, TIMESTAMP(start_date, start_hour) as start, TIMESTAMP(end_date, end_hour) as end FROM evento WHERE usuarioid = ".$_SESSION['usuarioid']." ORDER BY id";

 // connection to the database
 try {
 $bdd = new PDO('mysql:host=localhost;dbname=agenda_db', 'root', '');
 } catch(Exception $e) {
  exit('Unable to connect to database.');
 }
 // Execute the query
 $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

 // sending the encoded result to success page
 echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));


 ?>
