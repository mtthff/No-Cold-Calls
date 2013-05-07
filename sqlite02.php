<?php
/**
 * Simple example of extending the SQLite3 class and changing the __construct
 * parameters, then using the open method to initialize the DB.
 */
class MyDB extends SQLite3{
    function __construct(){
        $this->open('mysqlitedb.db');
    }
}

$db = new MyDB();

$db->exec('
      CREATE TABLE IF NOT EXISTS customer (
            [id] INTEGER PRIMARY KEY AUTOINCREMENT,
            organisation VARCHAR(255) NULL DEFAULT NULL,
            street VARCHAR(255) NULL DEFAULT NULL,
            postcode INT(5) NULL DEFAULT NULL,
            city VARCHAR(255) NULL DEFAULT NULL,
            phone VARCHAR(255) NULL DEFAULT NULL,
            mobil VARCHAR(255) NULL DEFAULT NULL,
            email VARCHAR(255) NULL DEFAULT NULL
          
        );

') or die($db->lastErrorMsg());

$db->exec("INSERT INTO customer (organisation, street, postcode, city, phone, mobil, email) VALUES ('Jugendhaus', 'Filderbahnplatz', '70619', 'Stuttgart', '0711/123456', '0170/02010000', 'bla@tipsntrips.de');") or die("erster insert:".$db->lastErrorMsg());

$db->exec("INSERT INTO customer (organisation, street, postcode, city, phone, mobil, email) VALUES ('Kinderhaus', 'Langestr', '70378', 'Stuttgart', '0711/654321', '0170/2233222', 'kh@web.de');") or die("zweiter insert:".$db->lastErrorMsg());


$result = $db->query('SELECT * FROM customer');
echo "<pre>";
print_r($result->fetchArray());
?>