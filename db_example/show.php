<html>
<head>
<title>PHP-Beispiel zu DB: Datensatz-Anzeige ohne Tabelle (show.php)
</title>
</head>
<body bgcolor="#00FFFF">
<?php
	$db=mysql_connect("localhost","aitec", "dachs");
	mysql_select_db("firma",$db);
	$res=mysql_query("SELECT * FROM personen");
	$num=mysql_num_rows($res);

	$result = mysql_query("SELECT COUNT(*) AS anz FROM personen") 
		or die("fehler query");
	$row 	= mysql_fetch_assoc($result);

	echo "<h2>Anzahl der Datensaetze: ".$row['anz']."</h2>";
	for($i=0;$i<$num;$i++)
	{
		$nn=mysql_result($res, $i, "name");
		$vn=mysql_result($res, $i, "vorname");
		$pn=mysql_result($res, $i, "personalnummer");
		$ge=mysql_result($res, $i, "gehalt");
		$gt=mysql_result($res, $i, "geburtstag");
		echo "$vn $nn, $pn, $ge, $gt<br>";
	}
	mysql_close($db);
?>
  <hr>
  <a href="show_table.php">Zur Anzeige aller Datensaetze als Tabelle</a><p>
  <a href="delete.php">Zum Loeschen eines Datensatzes</a><p>
  <a href="enter.php">Zur Eingabe eines Datensatzes</a><p>
  <a href="change.php">Zum Aendern eines Datensatzes</a><p>
  <a href="close.php">Datenbank "Firma" beenden</a>
</body> </html>
	
