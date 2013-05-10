<?php
try{
    $DBH = new PDO("sqlite:nocoldcalls.sqlite");
    $DBH->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);// ::TODO:: change it befor productive

    $STH = $DBH->query('SELECT cu.id, cu.organisation, cu.street, cu.postcode, cu.city, cu.phone, cu.mobil, cu.email, strftime("%d.%m.%Y", cu.listed_since) AS since, co.name
                            FROM customer AS cu
                            LEFT JOIN contributor AS co ON (cu.contributor_id = co.id)
                            ');

    $STH->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $STH->fetch()){
        $app[]= $row;
    }
//    echo "<pre>";
//    print_r($app);
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
              <li><a href="index.php">Übersicht</a></li>
              <li class="active"><a href="customer.php">Kundenverwaltung</a></li>
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
          <h2>Kunden <a href="#" class="btn btn disabled">Neuen Kunden eingeben</a></h2>
          <table class="table table-hover table-condensed tablesorter" id="sortTable">

            <thead>
                <tr>
                    <th>Einrichtung/Schule</th>
                    <th>Straße</th>
                    <th>Posteitzahl</th>
                    <th>Ort</th>
                    <th>Telefon</th>
                    <th>Mobil</th>
                    <th>Email</th>
                    <th>gelistet seit</th>
                    <th>Stadtspiele</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody style="font-size:.9em">
<?php

    foreach ($app as $value) {
        $spec = unserialize($value['specialized_value']);
        echo '<tr id="'.$value['id'].'">';
        echo '<td>'.$value['organisation'].'</td>';
        echo '<td>'.$value['street'].'</td>';
        echo '<td>'.$value['postcode'].'</td>';
        echo '<td>'.$value['city'].'</td>';
        echo '<td>'.$value['phone'].'</td>';
        echo '<td>'.$value['mobil'].'</td>';
        echo '<td>'.$value['email'].'</td>';
        echo '<td>'.$value['since'].'</td>';
        echo '<td>'.$value[''].'</td>';
        echo '<td><i class="icon-pencil"></i></td>';
        echo '<td><i class="icon-trash"></i></td>';                    
        echo '</tr>';
}
?>
            </tbody>
          </table>    
        </div>
      </div>

      <hr>

      <footer>
        <p>Stand: </p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-2.0.0.min.js"></script>
    <script src="js/jquery.tablesorter.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/customer.js"></script>

  </body>
</html>
