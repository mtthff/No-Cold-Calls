<?php 

require_once 'DBconnection.php';

mysql_query("
    INSERT INTO customer (id, organisation, street, postcode, city, phone, mobil, email) VALUES ('', 'Jugendhaus', 'Filderbahnplatz', '70619', 'Stuttgart', '0711/123456', '0170/02010000', 'bla@tipsntrips.de');
    INSERT INTO customer (id, organisation, street, postcode, city, phone, mobil, email) VALUES ('', 'Kinderhaus', 'Langestr', '70378', 'Stuttgart', '0711/654321', '0170/2233222', 'kh@web.de');
    
    INSERT INTO appointment (id, customer-id, datetime, contact, phone, mobil, email, number, contributor-id, listed-date, type-id, specialized-value) VALUES ('', '1', '2013-07-12 00:10:15', 'Fr. Mueller', '', '', '', '31', '1', '2013-05-07', '1', '');

    INSERT INTO specialized (id, name, type-id) VALUES ('', 'Alter', '1');
    INSERT INTO specialized (id, name, type-id) VALUES ('', 'Klassenstufe', '1');
    INSERT INTO specialized (id, name, type-id) VALUES ('', 'Tarif', '1');
    INSERT INTO specialized (id, name, type-id) VALUES ('', 'JuHe', '1');
    INSERT INTO specialized (id, name, type-id) VALUES ('', 'Version', '1');
    INSERT INTO specialized (id, name, type-id) VALUES ('', 'Foto-CD', '1');

    INSERT INTO type (id, name) VALUES ('', 'Stadtspiel');
    
    INSERT INTO contributor (id, name) VALUES ('', 'Matthias');
    INSERT INTO contributor (id, name) VALUES ('', 'Tom');
    INSERT INTO contributor (id, name) VALUES ('', 'Sibylle');
    

");

mysql_close(); // beendet die DB-Verbindung

?>