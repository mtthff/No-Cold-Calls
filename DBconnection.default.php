<?php

// Datenbankverbindung

$host = "localhost"; 	// Adresse des Datenbankservers,  meist localhost
$user = ""; 		// Ihr MySQL Benutzername
$pass = ""; 		// Ihr MySQL Passwort
$dbase = ""; 		// Name der Datenbank

$connection = mysql_connect($host ,  $user , $pass) 
    OR die ("No connection to database.");
$db = mysql_select_db($dbase ,  $connection) 
    OR die ("Can't select the database."); 

?>
