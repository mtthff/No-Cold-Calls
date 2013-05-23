<?php

    session_start();
    session_destroy();

    $db_name = 'data/nocoldcalls.sqlite';
    $DBH = new PDO("sqlite:$db_name");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($_POST['appointment_id'] == ''){
        $stmt = $DBH->prepare("INSERT INTO appointment (status_id, customer_id, datetime, contact, phone, email, number, comment, contributor_id, listed_date, type_id, age, tarif_id, juhe, version_id, fotocd) 
                               VALUES (:status_id, :customer_id, :datetime, :contact, :phone, :email, :number, :comment, :contributor_id, :listed_date, :type_id, :age, :tarif_id, :juhe, :version_id, :fotocd);");
    }
    else{
        $stmt = $DBH->prepare("UPDATE appointment SET
                                status_id = :status_id,
                                customer_id = :customer_id,
                                datetime = :datetime,
                                contact = :contact,
                                phone = :phone,
                                email = :email,
                                number = :number,
                                comment = :comment,
                                contributor_id = :contributor_id,
                                listed_date = :listed_date,
                                type_id = :type_id,
                                age = :age,
                                tarif_id = :tarif_id,
                                juhe = :juhe,
                                version_id = :version_id,
                                fotocd = :fotocd 
                               WHERE id = :appointment_id");
        
        $stmt->bindParam(':appointment_id', $appointment_id);
    }
    
    $stmt->bindParam(':status_id', $status_id);
    $stmt->bindParam(':customer_id', $customer_id);
    $stmt->bindParam(':datetime', $datetime);
    $stmt->bindParam(':contact', $contact);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
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
    
    if(!$_POST['juhe']) $_POST['juhe'] = 'false';
    if(!$_POST['fotocd']) $_POST['fotocd'] = 'false';
    $_POST['datetime'] = substr($_POST['datum'], 6, 4).'-'.substr($_POST['datum'], 3, 2).'-'.substr($_POST['datum'], 0, 2).' '.$_POST['time'];

    unset($_POST['datum']);
    unset($_POST['hour']);
    unset($_POST['minute']);
    unset($_POST['time']);
    unset($_POST['customer']);
    if($_POST['appointment_id'] == '') unset($_POST['appointment_id']);
       
    $stmt->execute($_POST);

    echo '<pre>Post:<br />';
    print_r($_POST);
//      header("Location: index.php");
?>
<a href="index.php" class="btn">zur Übersicht</a>
    
