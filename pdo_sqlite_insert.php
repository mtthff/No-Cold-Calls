<?php

try {  
  $DBH = new PDO("sqlite:database.db");  
  $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $DBH->exec("
		CREATE TABLE IF NOT EXISTS user (
			id INTEGER PRIMARY KEY,
			name VARCHAR(255),
			klasse VARCHAR(255));
	");
  
  //Platzhalter mit Daten versehen und 
  $data = array( 'name' => 'Heinzl', 'klasse' => '1a');

  
  //Query vorbereiten und mit Platzhaltern versehen
  
    $STH = $DBH->prepare("INSERT INTO user (name, klasse) VALUES (:name, :klasse)");
    $STH->bindValue(':name', $name, PDO::PARAM_STR);
    $STH->bindValue(':klasse', $klasse, PDO::PARAM_STR);

    $STH->execute($data);
//$affected_rows = $stmt->rowCount();
  

  $DBH = null; 
} 
catch(PDOException $e) {  
  echo $message->getMessage();  
} 

?>