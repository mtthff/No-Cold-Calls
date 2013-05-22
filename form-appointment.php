<?php
session_start();

try{
    $db_name = 'data/nocoldcalls.sqlite';
    $DBH = new PDO("sqlite:$db_name");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);// ::TODO:: change it befor productive

    if ($_GET['customer_id']){
           $STH = $DBH->query('SELECT organisation AS customer, phone AS custom_phone, email as custom_email
                            FROM customer
                            WHERE id = '.$_GET['customer_id']);
    }
    else
    {
        $STH = $DBH->query('SELECT 
                                ap.status_id,
                                strftime("%d.%m.%Y", ap.datetime) AS datum,
                                strftime("%H:%M", ap.datetime) AS time,
                                cu.organisation AS customer,
                                ap.contact,
                                ap.phone AS appoint_phone,
                                ap.email AS appoint_email,
                                cu.phone AS custom_phone,
                                cu.email AS custom_email,
                                ap.number,
                                ap.comment,
                                ap.type_id,
                                ap.age,
                                ap.tarif_id,
                                ap.juhe,
                                ap.version_id,
                                ap.contributor_id,
                                co.name,
                                strftime("%d.%m.%Y", ap.listed_date) AS listed_date
                            FROM appointment AS ap
                            LEFT JOIN customer AS cu ON (ap.customer_id = cu.id)
                            LEFT JOIN contributor AS co ON (ap.contributor_id = co.id)
                            WHERE ap.id = '.(int)$_GET['appointment_id']);
    }
    
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    $row = $STH->fetch();
    if($row){
        foreach ($row as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }
    unset($row);
    
    // STATUS Optionen einlesen
    $STH = $DBH->query('SELECT id, label FROM appointment_status');
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $STH->fetch()){
        $appointment_status[]= $row;
    }
    unset($row);
    
    // TARIF Optionen einlesen
    $STH = $DBH->query('SELECT id, label FROM appointment_tarif');
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $STH->fetch()){
        $appointment_tarif[]= $row;
    }
    unset($row);
    
    // TYPE Optionen einlesen
    $STH = $DBH->query('SELECT id, label FROM appointment_type');
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $STH->fetch()){
        $appointment_type[]= $row;
    }
    unset($row);
    
    // VERSION Optionen einlesen
    $STH = $DBH->query('SELECT id, label FROM appointment_version');
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $STH->fetch()){
        $appointment_version[]= $row;
    }
    unset($row);
    
    
//    echo "<pre>";
//    print_r($appointment_status);
//    exit;
//    echo "row:<br />";
//    print_r($row);
//    echo "session:<br />";
//    print_r($_SESSION);
//    exit;
    
    /*
    [datum] => 22.05.2013
    [hour] => 10
    [minute] => 15
    [time] => 10:15
    [customer] => gsdfgdsfg
    [contact] => ewrt
    [phone] => 
    [email] => 
    [age] => 
    [number] => 
    [tarif_id] => 1
    [version_id] => 1
    [comment] => 
    [juhe] => false
    [fotocd] => false
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
          <div class="span12">
              <?php
              if (!$_GET['appointment_id']){
                  echo "<h3>Neuer Termin</h3>";                  
              }
              else{
                  echo '<h3>Termin<small> eingetragen durch '.$_SESSION['name'].' am '.$_SESSION['listed_date'].'</small></h3>';
              }
              ?>
          </div>
          <form class="form-horizontal" action="save_appointment.php" method="post">
              <input type="hidden" name="contributor_id" value="1">
              <div class="span5">

              <div class="control-group">
                <label class="control-label" for="inputDate">Datum</label>
                <div class="controls">
                    <input type="text" name="datum" class="datepicker input-small" placeholder="Datum" value="<?php echo $_SESSION['datum'] ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputStarttime">Startzeit</label>
                <div class="controls">
                    <div class="input-append bootstrap-timepicker">
                        <input type="text" name="time" class="timepicker input-small" placeholder="Startzeit" value="<?php echo $_SESSION['time'] ?>">
                        <span class="add-on"><i class="icon-time"></i></span>
                    </div>
                </div>
              </div>
                  
              <div class="control-group">
                <label class="control-label" for="inputCustomer">Einrichtung/Schule</label>
                <div class="controls">
                    <div class="input-append">
                        <input type="text" name="customer" id="inputCustomer" class="input-large" placeholder="Schule" value="<?php echo $_SESSION['customer'] ?>" required>
                        <span class="add-on"><a href="form-customer.php?ref=newAppointment"><i class="icon-plus"></i></a></span>
                    </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputContact">Leiter</label>
                <div class="controls">
                  <input type="text" name="contact" class="input-large" id="inputContact" placeholder="Leiter"  value="<?php echo $_SESSION['contact'] ?>" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputPhone">Telefon</label>
                <div class="controls">
                  <input type="text" name="phone" class="input-large" id="inputPhone" placeholder="Telefon" value="<?php echo $_SESSION['custom_phone']//::TODO:: ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputEmail">Email</label>
                <div class="controls">
                  <input type="email" name="email" class="input-large" id="inputEmail" placeholder="email" value="<?php echo $_SESSION['custom_email'] ?>">
                </div>
              </div>
        </div>
        <div class="span5">
              <div class="control-group">
                <label class="control-label" for="inputClass">Klasse/Alter</label>
                <div class="controls">
                  <input type="text" name="age" id="inputClass" placeholder="Klasse/Alter" value="<?php echo $_SESSION['age'] ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputNumber">Teilnehmerzahl</label>
                <div class="controls">
                  <input type="text" name="number" id="inputNumber" class="input-mini" value="<?php echo $_SESSION['number'] ?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputJuHe">Jugendherberge</label>
                <div class="controls">
                    <input type="checkbox" name="juhe" id="inputJuHe" value="true"<?php if($_SESSION['juhe'] == TRUE) echo ' checked';?>>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputTarif">Tarif</label>
                <div class="controls">
                    <input type="hidden" name="tarif_id" id="tarif_id" value="<?php echo $_SESSION['tarif_id'] ?>" />
                    <div class="btn-group tarif_id" data-toggle="buttons-radio">
                        <?php
                        foreach ($appointment_tarif as $value) {
                            if($value['id'] == $_SESSION['tarif_id']) $tarifClass = "btn active";
                            else $tarifClass = "btn";
                            echo '<button type="button" value="'.$value['id'].'" class="'.$tarifClass.'">'.$value['label'].'</button>';
                        }
                        ?>
                    </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputVersion">Version</label>
                <div class="controls">
                    <input type="hidden" name="version_id" id="version_id" value="" />
                    <div class="btn-group version_id" data-toggle="buttons-radio">
                        <?php
                        foreach ($appointment_version as $value) {
                            if($value['id'] == $_SESSION['version_id']) $tarifClass = "btn active";
                            else $tarifClass = "btn";
                            echo '<button type="button" value="'.$value['id'].'" class="'.$tarifClass.'">'.$value['label'].'</button>';
                        }
                        ?>
                    </div>
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
                    <textarea name="comment" class="input-xxlarge" rows="5" id="inputComment" placeholder="Bemerkung"><?php echo $_SESSION['comment'] ?></textarea>

                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="status">Status</label>
                <div class="controls">
                    <input type="hidden" name="status_id" id="status_id" value="" />
                    <div class="btn-group status_id" data-toggle="buttons-radio">
                        <?php
                        foreach ($appointment_status as $value) {
                            if($value['id'] == $_SESSION['status_id']) $tarifClass = "btn active";
                            else $tarifClass = "btn";
                            echo '<button type="button" value="'.$value['id'].'" class="'.$tarifClass.'">'.$value['label'].'</button>';
                        }
                        ?>
                    </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label"></label>
                <button type="submit" class="btn">Speichern</button>
              </div>
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
    <script src="js/jquery.tablesorter.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/bootstrap-timepicker.min.js"></script>
    <script src="js/form-appointment.js"></script>
    <script src="js/jquery-ui.autocomplete.min.js"></script>

  </body>
</html>
