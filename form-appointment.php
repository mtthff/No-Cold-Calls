<?php
//echo $_GET['appointment_id'];
try{
    $DBH = new PDO("sqlite:nocoldcalls.sqlite");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);// ::TODO:: change it befor productive

    $STH = $DBH->query('SELECT 
                            strftime("%d.%m.%Y", ap.datetime) AS day,
                            strftime("%H:%M", ap.datetime) AS time,
                            cu.organisation,
                            ap.contact,
                            ap.phone AS appoint_phone,
                            ap.mobil AS appoint_mobil,
                            ap.email AS appoint_email,
                            cu.phone AS custom_phone,
                            cu.mobil AS custom_mobil,
                            cu.email AS custom_email,
                            ap.number,
                            ap.comment,
                            ap.type_id,
                            ap.age,
                            ap.tarif_id,
                            ap.juhe,
                            ap.version_id,
                            co.name,
                            strftime("%d.%m.%Y", ap.listed_date) AS listed_date
                        FROM appointment AS ap
                        LEFT JOIN customer AS cu ON (ap.customer_id = cu.id)
                        LEFT JOIN contributor AS co ON (ap.contributor_id = co.id)
                        WHERE ap.id = '.(int)$_GET['appointment_id']);

    $STH->setFetchMode(PDO::FETCH_ASSOC);
    $row = $STH->fetch();
            
//    echo "<pre>";
//    print_r($row);
//    exit;
    
    /*
     *     [day] => 18.09.2013
    [time] => 10:15
    [organisation] => Kinderhaus
    [contact] => Fr. Lockum
    [appoint_phone] => 
    [appoint_mobil] => 
    [custom_phone] => 0711/654321
    [custom_mobil] => 0170/2233222
    [number] => 33
    [comment] => -
    [type_id] => 1
    [age] => 8. Klasse
    [tarif_id] => 2
    [juhe] => 1
    [version_id] => 2
    [name] => Tom
    [listed_date] => 06.05.2013
     */
    
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
          <form class="form-horizontal" action="save_appointment.php" method="post">
              <div class="span5">

              <div class="control-group">
                <label class="control-label" for="inputDate">Datum</label>
                <div class="controls">
                    <input type="text" name="datum" class="datepicker input-small" placeholder="Datum" value="<?php echo $row['day'] ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputStarttime">Startzeit</label>
                <div class="controls">
                    <div class="input-append bootstrap-timepicker">
                        <input type="text" class="timepicker input-small" placeholder="Startzeit" value="<?php echo $row['time'] ?>">
                        <span class="add-on"><i class="icon-time"></i></span>
                    </div>
                </div>
              </div>
                  
              <div class="control-group">
                <label class="control-label" for="inputCustomer">Einrichtung/Schule</label>
                <div class="controls">
                    <div class="input-append">
                        <input type="text" name="customer" id="inputCustomer" class="input-large" placeholder="Schule" value="<?php echo $row['organisation'] ?>">
                        <span class="add-on"><a href="form-customer.php"><i class="icon-plus"></i></a></span>
                    </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputContact">Leiter</label>
                <div class="controls">
                  <input type="text" name="contact" class="input-large" id="inputContact" placeholder="Leiter"  value="<?php echo $row['contact'] ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputPhone">Telefon</label>
                <div class="controls">
                  <input type="text" name="phone" class="input-large" id="inputPhone" placeholder="Telefon" value="<?php echo $row['custom_phone']//::TODO:: ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputMobil">Mobil</label>
                <div class="controls">
                  <input type="text" name="mobil" class="input-large" id="inputMobil" placeholder="Mobil" value="<?php echo $row['custom_mobil']// ::TODO:: ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputEmail">Email</label>
                <div class="controls">
                  <input type="email" name="email" class="input-large" id="inputEmail" placeholder="email" value="<?php echo $row['custom_email'] ?>">
                </div>
              </div>
        </div>
        <div class="span5">
              <div class="control-group">
                <label class="control-label" for="inputClass">Klasse/Alter</label>
                <div class="controls">
                  <input type="text" name="class" id="inputClass" placeholder="Klasse/Alter" value="<?php echo $row['age'] ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputNumber">Teilnehmerzahl</label>
                <div class="controls">
                  <input type="text" name="number" id="inputNumber" class="input-mini" value="<?php echo $row['number'] ?>">
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
                    <textarea name="comment" class="input-xxlarge" rows="5" id="inputComment" placeholder="Bemerkung"><?php echo $row['comment'] ?></textarea>

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
    <script src="js/jquery-ui.autocomplete.min.js"></script>

  </body>
</html>
