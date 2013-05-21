<?php
//print_r($_POST);
//exit;

/*
 * Array
(
    [customer_id] => 1
    [text] => Jugendhaus - Fr. Müller
)

 */


try{
    $db_name = 'data/nocoldcalls.sqlite';
    $DBH = new PDO("sqlite:$db_name");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);// ::TODO:: change it befor productive

    $STH = $DBH->query('SELECT organisation, phone, email
                            FROM customer
                            WHERE id = '.$_POST['customer_id']);

    $STH->setFetchMode(PDO::FETCH_ASSOC);
    $row = $STH->fetch();
    
    $contact = explode(" - ", $_POST['text']);
    $row['contact'] = $contact[1];
    
    echo json_encode($row);

    
    
}
catch(PDOException $e) //Besonderheiten anzeigen
{
	print 'Exception : '.$e->getMessage();
}

?>
