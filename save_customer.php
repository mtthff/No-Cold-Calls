<?php
try{
    $db_name = 'data/nocoldcalls.sqlite';
    $DBH = new PDO("sqlite:$db_name");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $DBH->prepare("INSERT INTO customer (organisation, street, postcode, city, phone, email, listed_since, contributor_id) 
                                        VALUES (:organisation, :street, :postcode, :city, :phone, :email, :listed_since, :contributor_id);");


    $stmt->bindParam(':organisation', $organisation);
    $stmt->bindParam(':street', $street);
    $stmt->bindParam(':postcode', $postcode);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':listed_since', $listed_since);
    $stmt->bindParam(':contributor_id', $contributor_id);
    
//    print_r($_POST);
//    exit;

    $organisation = $_POST['organisation'];
    $street = $_POST['street'];
    $postcode = $_POST['postcode'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $listed_since = date("Y-m-d");
    $contributor_id = 1;//::TODO::
   

    $stmt->execute();

    header("Location: customer.php");
}
catch(PDOException $e) //Besonderheiten anzeigen
{
	print 'Exception : '.$e->getMessage();
}
    ?>