<?php
try{
    $DBH = new PDO("sqlite:nocoldcalls.sqlite");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);// ::TODO:: change it befor productive

    $STH = $DBH->query('SELECT cu.id, cu.organisation, ap.contact
                            FROM customer as cu
                            LEFT JOIN appointment as ap ON (cu.id = ap.customer_id)
                            ORDER BY organisation ASC');

    $STH->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $STH->fetch()){
        $customer[]= $row;
    }
//    echo "<pre>";
//    print_r($customer);
//    exit;
    
    
}
catch(PDOException $e) //Besonderheiten anzeigen
{
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
    <link href="css/datepicker.css" rel="stylesheet">
    <link href="css/timepicker.min.css" rel="stylesheet">
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

          <a class="brand" href="index.html">No Cold Call</a>
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
            <h3>Neuer Termin</h3>
          </div>
          <form class="form-horizontal" action="show_submitted_data.php" method="post">
              <div class="span5">

              <div class="control-group">
                <label class="control-label" for="inputDate">Datum</label>
                <div class="controls">
                    <input type="text" name="datum" class="datepicker input-small" placeholder="Datum">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputStarttime">Startzeit</label>
                <div class="controls">
                    <div class="input-append bootstrap-timepicker">
                        <input type="text" class="timepicker input-small" placeholder="Startzeit">
                        <span class="add-on"><i class="icon-time"></i></span>
                    </div>
                </div>
              </div>
                  
              <div class="control-group">
                <label class="control-label" for="inputCustomer">Einrichtung/Schule</label>
                <div class="controls">
                    <div class="input-append">
                        <select name="customer" id="inputCustomer" >
                            <option>Bitte wählen</option>
                            <?php
                                foreach ($customer as $value) {
                                    echo '<option value="'.$value['id'].'">'.$value['organisation'].' - '.$value['contact'].'</option>';
                                }
                            ?>
                        </select>
                        <span class="add-on"><a href="form-organisation.php"><i class="icon-plus"></i></a></span>
                    </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputContact">Leiter</label>
                <div class="controls">
                  <input type="text" name="contact" class="input-large" id="inputContact" placeholder="Leiter">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputPhone">Telefon</label>
                <div class="controls">
                  <input type="text" name="phone" class="input-medium" id="inputPhone" placeholder="Telefon">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputMobil">Mobil</label>
                <div class="controls">
                  <input type="text" name="mobil" class="input-medium" id="inputMobil" placeholder="Mobil">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputEmail">Email</label>
                <div class="controls">
                  <input type="email" name="email" class="input-medium" id="inputEmail" placeholder="Mobil">
                </div>
              </div>
        </div>
        <div class="span5">
              <div class="control-group">
                <label class="control-label" for="inputClass">Klasse/Alter</label>
                <div class="controls">
                  <input type="text" name="class" id="inputClass" placeholder="Klasse/Alter">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputNumber">Teilnehmerzahl</label>
                <div class="controls">
                  <input type="text" name="number" id="inputNumber" class="input-mini">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputJuHe">Jugendherberge</label>
                <div class="controls">
                  <input type="checkbox" name="juhe" id="inputJuHe" value="true">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputTarif">Tarif</label>
                <div class="controls">
                    <select name="tarif">
                      <option selected value="1">Klassik Ö - 1 €</option>
                      <option value="2">Premium Ö - 2 €</option>
                      <option value="3">Klassik P - 3 €</option>
                      <option value="4">Premium P - 6 €</option>
                    </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputVersion">Version</label>
                <div class="controls">
                    <select name="version">
                      <option selected value="1">deutsch</option>
                      <option value="2">englisch</option>
                      <option value="3">französisch</option>
                      <option value="4">polnisch</option>
                      <option value="5">russisch</option>
                    </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputFotoCD">Foto-CD</label>
                <div class="controls">
                  <input type="checkbox" name="fotocd" id="inputFotoCD" value="true">
                </div>
              </div>
        </div>
                  <div class="span2"></div>
          <div class="span12">
              <div class="control-group">
                <label class="control-label" for="inputComment">Bemerkung</label>
                <div class="controls">
                    <textarea name="comment" class="input-xxlarge" rows="5" id="inputComment" placeholder="Bemerkung"></textarea>

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

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-2.0.0.min.js"></script>
    <script src="js/jquery.tablesorter.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/bootstrap-timepicker.min.js"></script>
    <script src="js/form-appointment.js"></script>

  </body>
</html>
