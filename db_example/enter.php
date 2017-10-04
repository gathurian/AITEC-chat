<?php
  $Abschicken = $_GET["Abschicken"];
  echo "Abschicken: $Abschicken\n";
  if ($Abschicken=="senden") {	
    $db=mysql_connect("localhost", "aitec", "dachs");
    mysql_select_db("firma",$db);
	$eintrag="INSERT INTO personen ";
	   $eintrag .= " (personalnummer,name,vorname,gehalt,geburtstag) ";
	   $eintrag .= " values('".$_GET['pn']."','".$_GET['nn']."','".$_GET['vn']."',
		'".$_GET['ge']."','".$_GET['gt']."')"  or  die("fehler query");
	mysql_query($eintrag);
	$num = mysql_affected_rows();
 	if($num>0) $Ausgabe= "Es wurde 1 Datensatz hinzugefuegt";
	else {
	  echo "<h2>Es ist ein Fehler aufgetreten, ";
	  echo "es wurde kein Datensatz hinzugefuegt.</h2>";
	}
	mysql_close($db);
  }	
?>
<html>
<head>
  <title>PHP-Beispiel zu DB: Eingabe von Datensaetzen (enter.php)</title>
</head>
<body bgcolor="#bbbbbb">
<h2>Eingabe von Datensaetzen in die MySQL-Datei "Firma"</h2><hr>
<form action="" method="get">
	<input name="pn" size=5>Personalnummer<p>
	<input name="vn" size=20>Vorname<p>
	<input name="nn" size=20>Nachname<p>
	<input name="gt" size=20>Geburtstag (jjjj-mm-tt)<p>
	<input name="ge" size=10>Gehalt in EURO<p>
	<input type="submit" name="Abschicken" value="senden">
</form>
<?php         echo $Ausgabe; 
?>
  <hr>
  <a href="show.php">Zur Anzeige aller Datensaetze ohne Tabelle</a><p>
  <a href="show_table.php">Zur Anzeige aller Datensaetze in Tabellenform</a><p>
  <a href="change.php">Zum Aendern eines Datensatzes</a><p>
  <a href="close.php">Datenbank "Firma" beenden</a>
</body> 
</html>
