<?php

///no-cold-calls/form-customer.php


try{
    $db_name = 'data/nocoldcalls.sqlite';
    $DBH = new PDO("sqlite:$db_name");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);// ::TODO:: change it befor productive

    // Contributoren einlesen
    $STH = $DBH->query('SELECT id, name FROM contributor');
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $STH->fetch()){
        $contributor[]= $row;
    }
    unset($row);

//    $STH = $DBH->query('SELECT cu.id, cu.organisation, cu.contact
//                            FROM customer as cu
//                            ORDER BY organisation ASC');
//
//    $STH->setFetchMode(PDO::FETCH_ASSOC);
//    while($row = $STH->fetch()){
//        $customer[]= $row;
//    }
////    echo "<pre>";
////    print_r($customer);
////    exit;

}
catch(PDOException $e){ //Besonderheiten anzeigen
	print 'Exception : '.$e->getMessage();
}

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

          <a class="brand" href="index.php">No Cold Calls</a>
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
          <div class="span12">
            <h3>Neuer Kunde</h3>
          </div>
          <form class="form-horizontal" action="save_customer.php" method="post">
              <input type="hidden" name="referrer" value="<? echo $_GET['ref']; ?>">
              <div class="span7">

              <div class="control-group">
                <label class="control-label" for="inputOrganisation">Einrichtung/Schule</label>
                <div class="controls">
                    <div class="input-append">
                        <input type="text" name="organisation" id="inputOrganisation" class="input-large" placeholder="Schule" required>
                    </div>
                </div>
              </div>
                  
              <div class="control-group">
                <label class="control-label" for="inputContact">Leiter</label>
                <div class="controls">
                  <input type="text" name="contact" class="input-large" id="inputContact" placeholder="Leiter" required>
                </div>
              </div>
                  
              <div class="control-group">
                <label class="control-label" for="inputStreet">Straße</label>
                <div class="controls">
                  <input type="text" name="street" class="input-large" id="inputStreet" placeholder="Straße">
                </div>
              </div>
                  
              <div class="control-group">
                <label class="control-label" for="inputPostcode">PLZ/ Ort</label>
                <div class="controls">
                  <input type="text" name="postcode" class="input-small" id="inputPostcode" placeholder="PLZ">
                  <input type="text" name="city" class="input-large" id="inputCity" placeholder="Ort">
                </div>
              </div>
                  
              <div class="control-group">
                <label class="control-label" for="inputPhone">Telefon</label>
                <div class="controls">
                  <input type="text" name="phone" class="input-medium" id="inputPhone" placeholder="Phone">
                </div>
              </div>
                                   
              <div class="control-group">
                <label class="control-label" for="inputEmail">Email</label>
                <div class="controls">
                  <input type="email" name="email" class="input-medium" id="inputEmail" placeholder="Email">
                </div>
              </div>
                  
              <div class="control-group">
                <label class="control-label" for="contributor_id">Bearbeitet von</label>
                <div class="controls">
                    <input type="hidden" name="contributor_id" id="contributor_id" value="" />
                    <div class="btn-group contributor_id" data-toggle="buttons-radio">
                        <?php
                        foreach ($contributor as $value) {
                            if($value['id'] == $_SESSION['contributor_id']) $tarifClass = "btn active";
                            else $tarifClass = "btn";
                            echo '<button type="button" value="'.$value['id'].'" class="'.$tarifClass.'">'.$value['name'].'</button>';
                        }
                        ?>
                    </div>
                </div>
              </div>                  
                  
              <button type="submit" class="btn">Speichern</button>
        </div>
            </form>
            
        </div>
      </div>

      <hr>

      <footer>
        <p>Stand: 30.04.2013</p>
      </footer>

    <!--</div>  /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-2.0.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/form-customer.js"></script>

  </body>
</html>
