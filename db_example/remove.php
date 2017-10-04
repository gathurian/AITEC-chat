<html>
<body bgcolor="#abcd78"> 

<?php
	echo "Auswahl: $auswahl<br>";
	echo "Datei $db<br>";
	echo "Vorname: '".$_POST['neuvn']." '<br>";
	echo "personalnummer oripn ".$_POST['oripn']."<br>";

	$db=mysql_connect("localhost","aitec","dachs");
	mysql_select_db("firma",$db);

	echo "Datei $db<br>";

	$sqlab="DELETE FROM personen WHERE ";
		$sqlab .="personalnummer = '".$_POST['oripn']."'";

	mysql_query($sqlab);
$num=mysql_affected_rows();

	if ($num>0) echo "Der Datensatz wurde geloescht<p>";
	else echo "Der Datensatz wurde nicht geloescht<p>";

	mysql_close($db);

?>

   <a href="delete.php">Zum Loeschen eines weiteren Datensatzes</a><p>
   <a href="enter.php">Zur Eingabe eines Datensatzes</a><p>
   <a href="show.php">Zur Anzeige aller Datensaetze ohne Tabelle</a><p>
   <a href="show_table.php">Zur Anzeige aller Datensaetze in Tabellenform</a><p>
   <a href="change.php">Zum Aendern eines Datensatzes</a><p>
   <a href="close.php">Datenbank "Firma" beenden</a>

</body>
</html>
