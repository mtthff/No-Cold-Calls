<?php

    session_start();
    session_destroy();

    $db_name = 'data/nocoldcalls.sqlite';
    $DBH = new PDO("sqlite:$db_name");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($_POST['appointment_id'] == ''){
    //wenn keine appointment_id mitgegeben muss es sich um einen neuen Eintrag handeln, also INSERT ...
        $stmt = $DBH->prepare("INSERT INTO appointment (status_id, customer_id, datetime, number, comment, contributor_id, listed_date, type_id, age, tarif_id, juhe, version_id, fotocd) 
                               VALUES (:status_id, :customer_id, :datetime, :number, :comment, :contributor_id, :listed_date, :type_id, :age, :tarif_id, :juhe, :version_id, :fotocd);");
    }
    else{
    //... andernfalls UPDATE
        
        $DBH->exec('INSERT INTO appointment_backup (appointment_id, status_id, customer_id, datetime, number, comment, contributor_id, listed_date, type_id, age, tarif_id, juhe, version_id, fotocd, updater_id, update_date) 
                       SELECT id, status_id, customer_id, datetime, number, comment, contributor_id, listed_date, type_id, age, tarif_id, juhe, version_id, fotocd, '.$_POST['contributor_id'].', "'.$_POST['listed_date'].'"
                       FROM appointment WHERE id = '.$_POST['appointment_id']);
        
        $stmt = $DBH->prepare("UPDATE appointment SET
                                status_id = :status_id,
                                customer_id = :customer_id,
                                datetime = :datetime,
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
    $_SESSION = $_POST;
    
    unset($_POST['datum']);
    unset($_POST['hour']);
    unset($_POST['minute']);
    unset($_POST['time']);
    unset($_POST['customer']);
    unset($_POST['contact']);
    unset($_POST['phone']);
    unset($_POST['email']);
    if($_POST['appointment_id'] == '') unset($_POST['appointment_id']);
       
    $stmt->execute($_POST);


?>


<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <title>No Cold Calls</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Matthias Hoffmann">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/datepicker.css" rel="stylesheet">
    <link href="css/timepicker.min.css" rel="stylesheet">
    <link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
  	
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="brand" href="index.php">No Cold Call</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="index.php">Übersicht</a></li>
              <li><a href="customer.php">Kundenverwaltung</a></li>
              <li><a href="#">Admin</a></li>
              <li><a href="#">Backup</a></li>
              <li><a href="about.php">About</a></li>			  
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

        <!-- Example row of columns -->
      <div class="row">
          <div class="span4">
              
          <?php
   
    /*
    [appointment_id] => 2
    [type_id] => 1
    [listed_date] => 2013-05-24
    [datum] => 18.09.2013
    [hour] => 10
    [minute] => 15
    [time] => 10:15
    [customer_id] => 2
    [customer] => Kinderhaus
    [contact] => Hr. Butz
    [phone] => 
    [email] => 
    [age] => 8. Klasse
    [number] => 33
    [juhe] => 1
    [tarif_id] => 2
    [version_id] => 2
    [fotocd] => 1
    [comment] => -
    [status_id] => 1
    [contributor_id] => 2
    [datetime] => 2013-09-18 10:15
     */
    ?>
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>key</th>
                      <th>value</th>
                  </tr>
              </thead>
              <tbody style="font-size: .9em">
                  
              <?php
                  foreach ($_SESSION as $key => $value) {
                      echo "<tr>";
                      echo "<td>".$key."</td>";
                      echo "<td>".$value."</td>";
                      echo "</tr>";
                  }
              ?>
              </tbody>
          </table>
          </div>
      <hr>

      <footer>
        <p>
            
        </p>
      </footer>

    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-2.0.0.min.js"></script>
    <script src="js/jquery.tablesorter.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/bootstrap-timepicker.min.js"></script>
    <script src="js/form-appointment.js"></script>
    <script src="js/jquery-ui.autocomplete.min.js"></script>

  </body>
</html>
