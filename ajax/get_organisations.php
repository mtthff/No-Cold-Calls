<?php
//print_r($_POST);
//exit;

/*
 * 
            var availableTags = [
			"ActionScript",
			"AppleScript",
			"Asp",
			"Scheme"
		];

 */


try{
    $db_name = '../data/nocoldcalls.sqlite';
    $DBH = new PDO("sqlite:$db_name");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);// ::TODO:: change it befor productive

    $STH = $DBH->query('SELECT id, organisation, contact
                            FROM customer 
                            WHERE organisation LIKE "%'.$_GET['term'].'%"        
                            ORDER BY organisation ASC');
        

    $STH->setFetchMode(PDO::FETCH_ASSOC);
    
    $organisation = array();
    while($row = $STH->fetch()){
        $arr['id'] = $row['id'];
        $arr['value'] = $row['organisation'].' - '.$row['contact'];
        array_push($organisation,$arr);
    }
  
    echo json_encode($organisation);

    
    
}
catch(PDOException $e) //Besonderheiten anzeigen
{
	print 'Exception : '.$e->getMessage();
}

?>
