<?php

try{
    mkdir('../data/', 0755);
    $db_name = '../data/nocoldcalls.sqlite';
    $DBH = new PDO("sqlite:$db_name");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);	
    echo "Database - $db_name<br /><br />";
	
    //Table CUSTOMER
    $DBH->exec("
        CREATE TABLE IF NOT EXISTS customer (
            id INTEGER PRIMARY KEY,
            organisation TEXT,
            contact TEXT,
            street TEXT,
            postcode INTEGER,
            city TEXT,
            phone TEXT,
            email TEXT,
            listed_since NUMERIC,
            contributor_id INTEGER
        );
    ");
    echo "Table <i>customer</i> created. <br />";
	
   //Table APPOINTMENT
    $DBH->exec("
        CREATE TABLE IF NOT EXISTS appointment (
            id INTEGER PRIMARY KEY,
            status_id INTEGER,
            customer_id INTEGER,
            datetime NUMERIC,
            number INTEGER,
            comment TEXT,
            contributor_id INTEGER,
            listed_date NUMERIC,
            type_id INTEGER,
            age TEXT,
            tarif_id INTEGER,
            juhe NUMERIC,
            version_id INTEGER,
            fotocd NUMERIC
            );        
    ");
    echo "Table <i>appointment</i> created. <br />";
    
    //Table APPOINTMENT_BACKUP
    $DBH->exec("
        CREATE TABLE IF NOT EXISTS appointment_backup (
            id INTEGER PRIMARY KEY,
            appointment_id INTEGER,
            status_id INTEGER,
            customer_id INTEGER,
            datetime NUMERIC,
            number INTEGER,
            comment TEXT,
            type_id INTEGER,
            age TEXT,
            tarif_id INTEGER,
            juhe NUMERIC,
            version_id INTEGER,
            fotocd NUMERIC,            
            contributor_id INTEGER,
            listed_date NUMERIC,
            updater_id INTEGER,
            update_date NUMERIC
            );        
    ");
    echo "Table <i>appointment_backup</i> created. <br />";
    
   //Table APPOINTMENT_TYPE
    $DBH->exec("
        CREATE TABLE IF NOT EXISTS appointment_type (
          id INTEGER PRIMARY KEY,
          label TEXT
          );
    ");
    echo "Table <i>appointment_type</i> created. <br />";    
    
   //Table APPOINTMENT_STATUS
    $DBH->exec("
        CREATE TABLE IF NOT EXISTS appointment_status (
          id INTEGER PRIMARY KEY,
          label TEXT
          );
    ");
    echo "Table <i>appointment_status</i> created. <br />";
    
   
   //Table APPOINTMENT_TARIF
    $DBH->exec("
        CREATE TABLE IF NOT EXISTS appointment_tarif (
          id INTEGER PRIMARY KEY,
          label TEXT
          );
    ");
    echo "Table <i>appointment_tarif</i> created. <br />";
    
   //Table APPOINTMENT_VERSION
    $DBH->exec("
        CREATE TABLE IF NOT EXISTS appointment_version (
          id INTEGER PRIMARY KEY,
          label TEXT
          );
    ");
    echo "Table <i>appointment_version</i> created. <br />";
    
   //Table CONTRIBUTOR
    $DBH->exec("
        CREATE TABLE IF NOT EXISTS contributor (
          id INTEGER PRIMARY KEY,
          name TEXT
          );
    ");
    echo "Table <i>contributor</i> created. <br />";    
    
    //close the database connection
    $DBH = NULL;
    
    echo "<br />Creation of database and tables finished.<br />";
    echo "Want to fill the tables with some default content?&nbsp;";
    echo "<a href='pdo_fill_db.php'>yes (All content in your database will be delteted!)</a>&nbsp;<a href='index.php'>no</a>";
    
}catch(PDOException $e){
    print 'Exception : '.$e->getMessage();
}
