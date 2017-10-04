<html>
<head>
<title>PHP-Beispiel zu DB: aendern eines Datensatzes (change_it.php)
</title>
</head>
<body bgcolor="#abcdef"> 
<?php
  	echo "Datei $db<br>";
 	echo "Neuer Vorname: '".$_GET['neuvn']."'<br>";
  	echo "personalnummer oripn ".$_GET['oripn']."<br>";

	$db=mysql_connect("localhost", "aitec", "dachs");	
	mysql_select_db("firma",$db);

 	 echo "Datei $db<br>";

	$sqlab="UPDATE personen SET name = '".$_GET['neunn']."',";
	   $sqlab .="vorname = '".$_GET['neuvn']."',";
	   $sqlab .="personalnummer = '".$_GET['neupn']."',";
	   $sqlab .="gehalt = '".$_GET['neuge']."',";
	   $sqlab .="geburtstag = '".$_GET['neugt']."'";
	   $sqlab .=" WHERE personalnummer='".$_GET['oripn']."'";
	mysql_query($sqlab )  or  die("Fehler Query");
	$num=mysql_affected_rows();

	if ($num>0) echo "Der Datensatz wurde geaendert<p>";
	else echo "Der Datensatz wurde nicht geaendert<p>";

	mysql_close($db);
?>

   <a href="show.php">Zur Anzeige aller Datensaetze ohne Tabelle</a><p>
   <a href="show_table.php">Zur Anzeige aller Datensaetze in Tabellenform</a><p>
   <a href="change.php">Zum Aendern eines Datensatzes</a><p>
   <a href="enter.php">Zur Eingabe eines Datensatzes</a><p>
   <a href="close.php">Datenbank "Firma" beenden</a>
<hr>
</body>
</html>
