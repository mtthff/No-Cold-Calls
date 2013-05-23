<?php
//echo "<pre>";
//print_r($_POST);
//exit;

//    [referrer] => newCustomer
//    [organisation] => asdf
//    [contact] => asdf
//    [street] => 
//    [postcode] => 
//    [city] => 
//    [phone] => 
//    [email] => 
//    [contributor_id] => 2


try{
    $db_name = 'data/nocoldcalls.sqlite';
    $DBH = new PDO("sqlite:$db_name");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $DBH->prepare("INSERT INTO customer (organisation, contact, street, postcode, city, phone, email, listed_since, contributor_id) 
                                        VALUES (:organisation, :contact, :street, :postcode, :city, :phone, :email, :listed_since, :contributor_id);");


    $stmt->bindParam(':organisation', $organisation);
    $stmt->bindParam(':contact', $contact);
    $stmt->bindParam(':street', $street);
    $stmt->bindParam(':postcode', $postcode);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':listed_since', $listed_since);
    $stmt->bindParam(':contributor_id', $contributor_id);
    
    $referrer = $_POST['referrer'];
    unset($_POST['referrer']);
    $_POST['listed_since'] = date("Y-m-d");
    
    $stmt->execute($_POST);
    $last_id = $DBH->lastInsertId(); 

    switch ($referrer) {
        case 'newAppointment':
            header("Location: form-appointment.php?customer_id=".$last_id);
            break;
        case 'newCustomer':
            header("Location: customer.php");            
            break;
        default :
            echo "Fehler";
    }

}
catch(PDOException $e) //Besonderheiten anzeigen
{
	print 'Exception : '.$e->getMessage();
}
    ?>