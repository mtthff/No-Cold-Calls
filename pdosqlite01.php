<?php
/*

Sqlite is a popular flatfile database, that is, it stores the whole database on a single
file. PDO, the php class that provides vendor neutral interface to many databases, 
supports sqlite as well. So in this example we are going to work with an sqlite database 
using PDO.

For this example to work, the PDO extension for sqlite should be installed. Check
phpinfo for more information

The example shown here has been taken from :
http://henryranch.net/software/ease-into-sqlite-3-with-php-and-pdo/

How to run :
Before running this program enter a random name for the database in the variable $db_name

*/

try
{
	$db_name = 'nocoldcalls.sqlite';
	
	/*
		open the database - if database exists, then opens the existing one, else opens a new one.
	*/
    $db = new PDO("sqlite:$db_name");
	
	echo "Database - $db_name<br /><br />";
	
    //create a table in the database
    $db->exec("CREATE TABLE Dogs (Id INTEGER PRIMARY KEY, Breed TEXT, Name TEXT, Age INTEGER)");    
	
    /*
INSERT some data into the table. The exec function of PDO class is used to insert
data. The exec function returns the number of rows inserted.
	*/
    $db->exec("INSERT INTO Dogs (Breed, Name, Age) VALUES ('Labrador', 'Tank', 2);".
			  "INSERT INTO Dogs (Breed, Name, Age) VALUES ('Husky', 'Glacier', 7); " .
			  "INSERT INTO Dogs (Breed, Name, Age) VALUES ('Golden-Doodle', 'Ellie', 4);");
	
    
	//now output the data to a simple html table... SELECT
	echo "Contents of table Dogs";
    echo "<table border=1>";
    echo "<tr><td>Id</td><td>Breed</td><td>Name</td><td>Age</td></tr>";
    
	/*
SELECT entries from table Dogs. The query function is used to select entries from the
table. It returns the result set as a PDOStatement object.
*/
	$result = $db->query('SELECT * FROM Dogs');
    
	/*
The resultset is an array of all rows, and each row is an associative array of all values
*/
	foreach($result as $row)
    {
		echo "<tr><td>".$row['Id']."</td>";
		echo "<td>".$row['Breed']."</td>";
		echo "<td>".$row['Name']."</td>";
		echo "<td>".$row['Age']."</td></tr>";
    }
	echo "</table>";
	  
	//close the database connection
	$db = NULL;
}

catch(PDOException $e) //Besonderheiten anzeigen
{
	print 'Exception : '.$e->getMessage();
}
