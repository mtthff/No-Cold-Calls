<?php
    $db_name = 'data/nocoldcalls.sqlite';
    $DBH = new PDO("sqlite:$db_name");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $DBH->prepare("INSERT INTO appointment (customer_id, datetime, contact, phone, email, number, comment, contributor_id, listed_date, type_id, specialized_value) 
                           VALUES (:customer_id, :datetime, :contact, :phone, ::email, :number, :comment, :contributor_id, :listed_date, :type_id, :specialized_value);");
    
    $stmt->bindParam(':customer', $customer);
    $stmt->bindParam(':datetime', $datetime);
    $stmt->bindParam(':contact', $contact);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':number', $number);
    $stmt->bindParam(':comment', $comment);
    $stmt->bindParam(':contributor_id', $contributor_id);
    $stmt->bindParam(':listed_date', $listed_date);
    $stmt->bindParam(':type_id', $type_id);
    $stmt->bindParam(':specialized_value', $specialized_value);
    
    
    
    ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <pre>
        <?php
        if(!$_POST['juhe']) $_POST['juhe'] = 'false';
        if(!$_POST['fotocd']) $_POST['fotocd'] = 'false';
        print_r($_POST);
        exit;
        
        $customer = $_POST['customer'];
        $datetime = $_POST['datum'].$_POST['hour'];
        $contact = $_POST['contact'];//::TODO::
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $comment = $_POST['comment'];
        $contributor_id = 1;//::TODO::
        $listed_date = date("Y-m-d");
        $type_id = 1;//::TODO::        
        $specialized_value = serialize(array('Klassenstufe' => $_POST['class'],
                                             'Tarif' => $_POST['tarif'],
                                             'JuHe' => $_POST['juhe'],
                                             'Version' => $_POST['version'],
                                             'Foto-CD' => $_POST['fotocd']));
        
    
/*
    [datum] => 
    [hour] => 10
    [minute] => 15
    [customer] => Geschwister-Scholl-Gymnasium - 
    [contact] => 
    [phone] => 0711/ 994837
    [email] => gsg@gsg-stuttgart-schule.de
    [class] => 
    [number] => 
    [tarif] => 1
    [version] => 1
    [comment] => 
    [juhe] => false
    [fotocd] => false 
 */

//    $stmt->execute();
        ?>
        </pre>
    </body>
</html>
<?php

    


?>