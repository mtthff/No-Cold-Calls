<?php


try{
    $db_name = 'nocoldcalls.sqlite';

// open the database - if database exists, then opens the existing one, else opens a new one.
	
    $DBH = new PDO("sqlite:$db_name");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Database - $db_name<br /><br />";
	
    $result = $DBH->exec(   "INSERT INTO customer (organisation, street, postcode, city, phone, mobil, email) 
                                           VALUES ('Jugendhaus', 'Filderbahnplatz', '70619', 'Stuttgart', '0711/123456', '0170/02010000', 'bla@tipsntrips.de');
                            INSERT INTO customer (organisation, street, postcode, city, phone, mobil, email) 
                                           VALUES ('Kinderhaus', 'Langestr', '70378', 'Stuttgart', '0711/654321', '0170/2233222', 'kh@web.de');

                            INSERT INTO appointment (customer-id, datetime, contact, phone, mobil, email, number, contributor-id, listed-date, type-id, specialized-value) 
                                             VALUES ('1', '2013-07-12 00:10:15', 'Fr. Mueller', '', '', '', '31', '1', '2013-05-07', '1', '');
 
                            INSERT INTO specialized (name, type-id) VALUES ('Alter', '1');
                            INSERT INTO specialized (name, type-id) VALUES ('Klassenstufe', '1');
                            INSERT INTO specialized (name, type-id) VALUES ('Tarif', '1');
                            INSERT INTO specialized (name, type-id) VALUES ('JuHe', '1');
                            INSERT INTO specialized (name, type-id) VALUES ('Version', '1');
                            INSERT INTO specialized (name, type-id) VALUES ('Foto-CD', '1');

                            INSERT INTO type (name) VALUES ('Stadtspiel');

                            INSERT INTO contributor (name) VALUES ('Matthias');
                            INSERT INTO contributor (name) VALUES ('Tom');
                            INSERT INTO contributor (name) VALUES ('Sibylle');
    ");

    //close the database connection
    $DBH = NULL;
    
    echo $result. "rows inserted.";
    echo "To the <a href='index.php'>Startpage</a>.";
    
}catch(PDOException $e){
    print 'Exception : '.$e->getMessage();
}
