<?php

try {  
  $DBH = new PDO("sqlite:database.db");  
  $DBH->exec("
		CREATE TABLE IF NOT EXISTS user (
			id INT(255) NOT NULL auto_increment,
			name VARCHAR(255) NULL DEFAULT NULL,
			klasse VARCHAR(255) NULL DEFAULT NULL,
		  PRIMARY KEY (id)
		);
  ");
  
  //Query vorbereiten und mit Platzhaltern versehen
  $STH = $DBH->prepare("INSERT INTO user (name, klasse) value (:name, :klasse)"); 
  $STH->bindParam(':name', $name); 
  $STH->bindParam(':klasse', $klasse);
  
  //Platzhalter mit Daten versehen und 
  $data = array( 'name' => 'Heinzl', 'klasse' => '1a');

  //Query ausführen
  $STH->execute($data);

  $DBH = null; 
} 
catch(PDOException $e) {  
  echo $message->getMessage();  
} 

?>