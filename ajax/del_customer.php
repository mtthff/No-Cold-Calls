<?php
//print_r($_POST);
//exit;

/*
 * Array
(
    [customer_id] => 1
)

 */


try{
    $db_name = '../data/nocoldcalls.sqlite';
    $DBH = new PDO("sqlite:$db_name");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);// ::TODO:: change it befor productive

    $DBH->exec('DELETE FROM customer WHERE id = '.(int)$_POST['customer_id']);
       
}
catch(PDOException $e) //Besonderheiten anzeigen
{
	print 'Exception : '.$e->getMessage();
}

?>
