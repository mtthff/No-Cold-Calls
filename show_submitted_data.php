<?php
    $DBH = new PDO("sqlite:database.db");  
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $DBH->prepare("INSERT INTO appointment (customer_id, datetime, contact, phone, mobil, email, number, comment, contributor_id, listed_date, type_id, specialized_value) 
                           VALUES (:customer_id, :datetime, :contact, :phone, :mobil, :email, :number, :comment, :contributor_id, :listed_date, :type_id, :specialized_value);");
    
    $stmt->bindParam(':customer', $customer);
    $stmt->bindParam(':datetime', $datetime);
    $stmt->bindParam(':contact', $contact);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':phone', $mobil);
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
        
        $customer;//::TODO::
        $datetime = $_POST['datum'].$_POST['hour'];
        $contact;//::TODO::
        $phone = $_POST['phone'];
        $mobil = $_POST['mobil'];
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
(
    [datum] => 15.05.2013
    [hour] => 10
    [minute] => 15
    [organisation] => Schule
    [customer] => Fr. Schmitt
    [phone] => 0711/ 373878
    [mobil] => 1072/83473
    [class] => 11. Klasse
    [number] => 32
    [tarif] => 1
    [version] => 1
    [comment] => bla
    [juhe] => false
    [fotocd] => false
)
  
 */

//    $stmt->execute();
        ?>
        </pre>
    </body>
</html>
<?php

    


?>