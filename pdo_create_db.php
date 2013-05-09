<?php


try{
    $db_name = 'nocoldcalls.sqlite';

// open the database - if database exists, then opens the existing one, else opens a new one.
	
    $db = new PDO("sqlite:$db_name");
	
    echo "Database - $db_name<br /><br />";
	
    //create a table in the database
/*
 * 		CREATE TABLE IF NOT EXISTS user (
			id INTEGER PRIMARY KEY,
			name VARCHAR(255),
			klasse VARCHAR(255));
 */    
    //Table CUSTOMER
    $db->exec("
        CREATE TABLE IF NOT EXISTS customer (
            id INTEGER PRIMARY KEY,
            organisation VARCHAR(255),
            street VARCHAR(255),
            postcode INT(5),
            city VARCHAR(255),
            phone VARCHAR(255),
            mobil VARCHAR(255),
            email VARCHAR(255));
    ");
    echo "Table <i>customer</i> created. <br />";
	
   //Table APPOINTMENT
    $db->exec("
        CREATE TABLE IF NOT EXISTS appointment (
            id INTEGER PRIMARY KEY,
            customer-id INT(255),
            datetime DATETIME,
            contact VARCHAR(255),
            phone VARCHAR(255),
            mobil VARCHAR(255),
            email VARCHAR(255),
            number INT(24) NULL,
            listed-id INT(255),
            listed-date DATE,
            type-id INT(255),
            specialized-value MEDIUMTEXT);        
    ");
    echo "Table <i>appointment</i> created. <br />";
    
   //Table SPECIALIZED
    $db->exec("
        CREATE TABLE IF NOT EXISTS specialized (
          id INTEGER PRIMARY KEY,
          name VARCHAR(255),
          type-id INT(255));
    ");
    echo "Table <i>specialized</i> created. <br />";
    
   //Table TYPE
    $db->exec("
        CREATE TABLE IF NOT EXISTS type (
          id INTEGER PRIMARY KEY,
          name VARCHAR(255));
    ");
    echo "Table <i>type</i> created. <br />";    
    
   //Table CONTRIBUTOR
    $db->exec("
        CREATE TABLE IF NOT EXISTS contributor (
          id INTEGER PRIMARY KEY,
          name VARCHAR(255));
    ");
    echo "Table <i>contributor</i> created. <br />";    
    
    //close the database connection
    $db = NULL;
    
    echo "<br />Creation of database and tables finished.<br />";
    echo "Want to fill the tables with some default content?&nbsp;";
    echo "<a href='pdo_fill_db.php'>yes</a>&nbsp;<a href='index.php'>no</a>";
    
}catch(PDOException $e){
    print 'Exception : '.$e->getMessage();
}
