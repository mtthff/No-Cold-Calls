<?php
//try{
//    $DBH = new PDO("sqlite:nocoldcalls.sqlite");
//    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);// ::TODO:: change it befor productive
//
//    $STH = $DBH->query('SELECT a.id,
//                            strftime("%d.%m.%Y", a.datetime) AS day,
//                            strftime("%H:%M", a.datetime) AS time,
//                            cu.organisation,
//                            a.contact,
//                            a.phone AS appoint_phone,
//                            a.mobil AS appoint_mobil,
//                            cu.phone AS custom_phone,
//                            cu.mobil AS custom_mobil,
//                            a.number,
//                            a.comment,
//                            a.specialized_value,
//                            co.name,
//                            strftime("%d.%m.%Y", a.listed_date) AS listed_date
//                        FROM appointment AS a
//                        LEFT JOIN customer AS cu ON (a.customer_id = cu.id)
//                        LEFT JOIN contributor AS co ON (a.contributor_id = co.id)
//                        ORDER BY day ASC');
//
//    $STH->setFetchMode(PDO::FETCH_ASSOC);
//    while($row = $STH->fetch()){
//        $app[]= $row;
//    }
////    echo "<pre>";
////    print_r($app);
////    exit;
//    
//    
//}
//catch(PDOException $e) //Besonderheiten anzeigen
//{
//	print 'Exception : '.$e->getMessage();
//}

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
          <form class="form-horizontal">
          <div class="span6">

              <div class="control-group">
                <label class="control-label" for="inputDate">Datum</label>
                <div class="controls">
                  <input type="text" id="inputDate" placeholder="Datum">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputStarttime">Startzeit</label>
                <div class="controls">
                  <input type="text" id="inputStarttime" placeholder="Startzeit">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputOrganisation">Einrichtung/Schule</label>
                <div class="controls">
                  <input type="text" id="inputOrganisation" placeholder="Organisation">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputCustomer">Leiter</label>
                <div class="controls">
                  <input type="text" id="inputCustomer" placeholder="Leiter">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputPhone">Telefon</label>
                <div class="controls">
                  <input type="text" id="inputPhone" placeholder="Telefon">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputMobil">Mobil</label>
                <div class="controls">
                  <input type="text" id="inputMobil" placeholder="Mobil">
                </div>
              </div>
        </div>
        <div class="span6">
              <div class="control-group">
                <label class="control-label" for="inputClass">Klass/Alter</label>
                <div class="controls">
                  <input type="text" id="inputClass" placeholder="Klasse/Alter">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputNumber">Teilnehmerzahl</label>
                <div class="controls">
                  <input type="text" id="inputNumber" placeholder="Teilnehmerzahl">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputTarif">Tarif</label>
                <div class="controls">
                  <input type="text" id="inputTarif" placeholder="Tarif">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputJuHe">Jugenherberge</label>
                <div class="controls">
                  <input type="text" id="inputJuHe" placeholder="Jugendherberge">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputVersion">Version</label>
                <div class="controls">
                  <input type="text" id="inputVersion" placeholder="Version">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputFotoCD">Foto-CD</label>
                <div class="controls">
                  <input type="text" id="inputFotoCD" placeholder="Foto-CD">
                </div>
              </div>
        </div>
          <div class="span12">
              <div class="control-group">
                <label class="control-label" for="inputComment">Bemerkung</label>
                <div class="controls">
                  <input type="text" id="inputComment" placeholder="Bemerkung">
                </div>
              </div>
            
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
    <script src="js/index.js"></script>

  </body>
</html>
