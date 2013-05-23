<?php

try{
    $db_name = '../data/nocoldcalls.sqlite';
    $DBH = new PDO("sqlite:$db_name");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
    echo "Database - $db_name<br /><br />";
    
    /*------------------------------------------------*/    

    $DBH->exec("DELETE FROM appointment");
    $stmt = $DBH->prepare("INSERT INTO appointment (status_id, customer_id, datetime, number, comment, contributor_id, listed_date, type_id, age, tarif_id, juhe, version_id, fotocd) 
                           VALUES (:status_id, :customer_id, :datetime, :number, :comment, :contributor_id, :listed_date, :type_id, :age, :tarif_id, :juhe, :version_id, :fotocd);");
    $stmt->bindParam(':status_id', $status_id);
    $stmt->bindParam(':customer_id', $customer_id);
    $stmt->bindParam(':datetime', $datetime);
    $stmt->bindParam(':number', $number);
    $stmt->bindParam(':comment', $comment);
    $stmt->bindParam(':contributor_id', $contributor_id);
    $stmt->bindParam(':listed_date', $listed_date);
    $stmt->bindParam(':type_id', $type_id);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':tarif_id', $tarif_id);
    $stmt->bindParam(':juhe', $juhe);
    $stmt->bindParam(':version_id', $version_id);
    $stmt->bindParam(':fotocd ', $fotocd);
    
    $today = date('Y-m-d');
    $data = array( 'status_id' => '2', 'customer_id' => '1', 'datetime' => $today.' 10:15:00', 'number' => '31','comment' => '-','contributor_id' => '1','listed_date' => '2013-05-07','type_id' => '1','age' => '10. Klasse','tarif_id' => '1','juhe' => '','version_id' => '1','fotocd' => '1');
    $stmt->execute($data);
    $data = array(  'status_id' => '1', 'customer_id' => '2', 'datetime' => '2013-09-18 10:15:00','number' => '33','comment' => '-','contributor_id' => '2','listed_date' => '2013-05-06','type_id' => '1','age' => '8. Klasse','tarif_id' => '2','juhe' => '1','version_id' => '2','fotocd' => '1');
    $stmt->execute($data);
    $data = array(  'status_id' => '2', 'customer_id' => '3', 'datetime' => '2013-08-12 10:15:00','number' => '24','comment' => '-','contributor_id' => '3','listed_date' => '2013-03-07','type_id' => '1','age' => '5. Klasse','tarif_id' => '1','juhe' => '','version_id' => '1','fotocd' => '');
    $stmt->execute($data);
    $data = array(  'status_id' => '2', 'customer_id' => '4', 'datetime' => '2013-04-01 15:00:00','number' => '12','comment' => '-','contributor_id' => '1','listed_date' => '2013-05-17','type_id' => '1','age' => '17-19 Jahre','tarif_id' => '2','juhe' => '1','version_id' => '2','fotocd' => '1');
    $stmt->execute($data);
    $data = array(  'status_id' => '3', 'customer_id' => '2', 'datetime' => '2013-11-03 10:15:00','number' => '18','comment' => '-','contributor_id' => '2','listed_date' => '2013-02-10','type_id' => '1','age' => '10. Klasse','tarif_id' => '1','juhe' => '','version_id' => '3','fotocd' => '1');
    $stmt->execute($data);
    $data = array(  'status_id' => '2','customer_id' => '1', 'datetime' => '2013-08-20 10:15:00','number' => '12','comment' => '-','contributor_id' => '1','listed_date' => '2013-04-17','type_id' => '1','age' => '12-14 Jahre','tarif_id' => '1','juhe' => '','version_id' => '4','fotocd' => '');
    $stmt->execute($data);



    /*------------------------------------------------*/    
   

    $DBH->exec("DELETE FROM customer");
    $DBH->exec("INSERT INTO customer (organisation, contact, street, postcode, city, phone, email, listed_since, contributor_id) 
                           VALUES ('Jugendhaus', 'Fr. Lockum','Filderbahnplatz', '70619', 'Stuttgart', '0711/02010000', 'bla@tipsntrips.de', '2013-02-01', '1');");
    $DBH->exec("INSERT INTO customer (organisation, contact, street, postcode, city, phone, email, listed_since, contributor_id) 
                           VALUES ('Kinderhaus', 'Hr. Butz', 'Langestr', '70378', 'Stuttgart', '0711/2233222', 'kh@web.de', '2013-02-01', '1');");
    $DBH->exec("INSERT INTO customer (organisation, contact, street, postcode, city, phone, email, listed_since, contributor_id) 
                           VALUES ('Eschbachgymnasium', 'Fr. Brendgen', 'Hauptstr. 3', '63545', 'Eschbach', '08711/6343321', 'eschbach@eschbach-e.de', '2013-01-23', '1');");
    $DBH->exec("INSERT INTO customer (organisation, contact, street, postcode, city, phone, email, listed_since, contributor_id) 
                           VALUES ('Schlossrealschule', 'Fr. Müller-Preisenhammer', 'Breitscheidstr. 23', '70178', 'Stuttgart', '0711/2165344', 'poststelle-323@stuttg.de', '2013-02-01', '1');");

    /*------------------------------------------------*/    
    
    $DBH->exec("DELETE FROM appointment_status");
    $DBH->exec("INSERT INTO appointment_status (label) VALUES ('angefragt');
                INSERT INTO appointment_status (label) VALUES ('gebucht');
                INSERT INTO appointment_status (label) VALUES ('abgesagt');
    ");

    /*------------------------------------------------*/    
    $DBH->exec("DELETE FROM appointment_tarif");
    $DBH->exec("INSERT INTO appointment_tarif (label) VALUES ('Klassik Ö');
                INSERT INTO appointment_tarif (label) VALUES ('Premium Ö');
                INSERT INTO appointment_tarif (label) VALUES ('Klassik P');
                INSERT INTO appointment_tarif (label) VALUES ('Premium P');
    ");

    /*------------------------------------------------*/    
    $DBH->exec("DELETE FROM appointment_version");
    $DBH->exec("INSERT INTO appointment_version (label) VALUES ('Deutsch');
                INSERT INTO appointment_version (label) VALUES ('Englisch');
                INSERT INTO appointment_version (label) VALUES ('Französisch');
                INSERT INTO appointment_version (label) VALUES ('Polnisch');
                INSERT INTO appointment_version (label) VALUES ('Russisch');
    ");

    /*------------------------------------------------*/    
    
    $DBH->exec("DELETE FROM appointment_type");
    $DBH->exec("INSERT INTO appointment_type (label) VALUES ('Stadtspiel');");

    /*------------------------------------------------*/    
    
    $DBH->exec("DELETE FROM contributor");
    $DBH->exec("INSERT INTO contributor (name) VALUES ('Matthias Hoffmann');
                INSERT INTO contributor (name) VALUES ('Tom Kipp');
                INSERT INTO contributor (name) VALUES ('Sibylle Patriarca');
                INSERT INTO contributor (name) VALUES ('Isabel Sieloff');");

    //close the database connection
    $DBH = NULL;
    
    echo "Rows inserted.";
    echo "To the <a href='../index.php'>Startpage</a>.";
    
}catch(PDOException $e){
    print 'Exception : '.$e->getMessage();
}
