<?php
    $DBH = new PDO("sqlite:nocoldcalls.sqlite");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);// ::TODO:: change it befor productive

    $result = $DBH->query('SELECT strftime("%d.%m.%y", a.datetime) as day,
                                strftime("%H:%M", a.datetime) as time,
                                cu.organisation,
                                a.contact,
                                a.phone,
                                a.mobil,
                                a.specialized_value,
                                co.name,
                                strftime("%d.%m.%y",a.listed_date) as listed_date
                            FROM appointment a
                            LEFT JOIN customer cu ON (a.customer_id = cu.id)
                            LEFT JOIN contributor co ON (a.contributor_id = co.id)
                        ');
    echo "<pre>";
    print_r($result);
    exit;
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
              <li><a href="#">Kundenverwaltung</a></li>
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
          <h2>Übersicht <a href="#" class="btn btn disabled">Neuen Termin eingeben</a></h2>
          <table class="table table-hover table-condensed tablesorter" id="sortTable">

            <thead>
                <tr>
                    <th>Termin</th>
                    <th>Beginn</th>
                    <th>Einrichtung/Schule</th>
                    <th>Leiter</th>
                    <th>Telefon</th>
                    <th>Alter/Klassenstufe</th>
                    <th>Teilnehmerzahl</th>
                    <th>Tarif</th>
                    <th>JuHe</th>
                    <th>Version</th>
                    <th>Foto-CD</th>
                    <th>Bemerkung</th>                    
                    <th>eingetragen durch</th>
                    <th>eingetragen am</th>
                    <th></th>
                    <th></th>                    
                </tr>
            </thead>
            <tbody style="font-size:.9em">
                <tr>
                    <td>24.07.13</td>
                    <td>10:15</td>
                    <td>Waldschule Degerloch</td>
                    <td>Fr.Müller</td>
                    <td>0172-11111111</td>
                    <td>7. Klasse</td>
                    <td>23</td>
                    <td>Premium Ö</td>
                    <td></td>
                    <td>dt.</td>
                    <td><i class="icon-ok"></td>
                    <td>-</td>
                    <td>mh</td>
                    <td>18.05.13</td>
                    <td><i class="icon-pencil"></i></td>
                    <td><i class="icon-trash"></i></td>                    
                </tr>
                <tr class="info">
                    <td>26.07.13</td>
                    <td>10:15</td>
                    <td>Waldschule Degerloch</td>
                    <td>Fr.nüller</td>
                    <td>0172-11111111</td>
                    <td>8. Klasse</td>
                    <td>23</td>
                    <td>Premium Ö</td>
                    <td></td>
                    <td>dt.</td>
                    <td><i class="icon-ok"></td>
                    <td>-</td>
                    <td>mh</td>
                    <td>18.05.13</td>
                    <td><i class="icon-pencil"></i></td>
                    <td><i class="icon-trash"></i></td>                    
                </tr>
                <tr>
                    <td>24.08.13</td>
                    <td>10:15</td>
                    <td>Waldschule Degerloch</td>
                    <td>Fr.püller</td>
                    <td>0172-11111111</td>
                    <td>9. Klasse</td>
                    <td>23</td>
                    <td>Premium Ö</td>
                    <td></td>
                    <td>dt.</td>
                    <td><i class="icon-ok"></td>
                    <td>-</td>
                    <td>mh</td>
                    <td>18.05.13</td>
                    <td><i class="icon-pencil"></i></td>
                    <td><i class="icon-trash"></i></td>                    
                </tr>                
            </tbody>
          </table>    
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
