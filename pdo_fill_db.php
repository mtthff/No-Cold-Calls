<?php


try{
    $db_name = 'nocoldcalls.sqlite';

// open the database - if database exists, then opens the existing one, else opens a new one.
	
    $DBH = new PDO("sqlite:$db_name");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
    echo "Database - $db_name<br /><br />";

    $DBH->exec("DELETE FROM customer");
    $DBH->exec("INSERT INTO customer (organisation, street, postcode, city, phone, mobil, email) 
                           VALUES ('Jugendhaus', 'Filderbahnplatz', '70619', 'Stuttgart', '0711/123456', '0170/02010000', 'bla@tipsntrips.de');");
    $DBH->exec("INSERT INTO customer (organisation, street, postcode, city, phone, mobil, email) 
                               VALUES ('Kinderhaus', 'Langestr', '70378', 'Stuttgart', '0711/654321', '0170/2233222', 'kh@web.de');");
    
    $spec = array('Klassenstufe' => '10b','Tarif' => 'Klassik Oe','JuHe' => 'j','Version' => 'englisch','Foto-CD' => 'j');
    $DBH->exec("DELETE FROM appointment");
    $DBH->exec("INSERT INTO appointment (customer_id, datetime, contact, phone, mobil, email, number, comment, contributor_id, listed_date, type_id, specialized_value) 
                               VALUES ('1', '2013-07-12 10:15:00', 'Fr. Müller', '', '', '', '31', '-', '1', '2013-05-07', '1', '".serialize($spec)."');");
    $DBH->exec("INSERT INTO appointment (customer_id, datetime, contact, phone, mobil, email, number, comment, contributor_id, listed_date, type_id, specialized_value) 
                               VALUES ('2', '2013-07-17 15:00:00', 'Fr. Maier',  '', '', '', '23', '-', '2', '2013-04-07', '1', '".serialize($spec)."');");
    $DBH->exec("INSERT INTO appointment (customer_id, datetime, contact, phone, mobil, email, number, comment, contributor_id, listed_date, type_id, specialized_value) 
                               VALUES ('1', '2013-08-17 10:15:00', 'Fr. Schmitt','', '', '', '13', '-', '1', '2013-03-07', '1', '".serialize($spec)."');");

    $DBH->exec("DELETE FROM specialized");
    $DBH->exec("INSERT INTO specialized (name, type_id) VALUES ('Alter', '1');
                            INSERT INTO specialized (name, type_id) VALUES ('Klassenstufe', '1');
                            INSERT INTO specialized (name, type_id) VALUES ('Tarif', '1');
                            INSERT INTO specialized (name, type_id) VALUES ('JuHe', '1');
                            INSERT INTO specialized (name, type_id) VALUES ('Version', '1');
                            INSERT INTO specialized (name, type_id) VALUES ('Foto-CD', '1');");

    $DBH->exec("DELETE FROM type");
    $DBH->exec("INSERT INTO type (name) VALUES ('Stadtspiel');");

    $DBH->exec("DELETE FROM contributor");
    $DBH->exec("INSERT INTO contributor (name) VALUES ('Matthias');
                            INSERT INTO contributor (name) VALUES ('Tom');
                            INSERT INTO contributor (name) VALUES ('Sibylle');");

    //close the database connection
    $DBH = NULL;
    
    echo "Rows inserted.";
    echo "To the <a href='index.php'>Startpage</a>.";
    
}catch(PDOException $e){
    print 'Exception : '.$e->getMessage();
}
