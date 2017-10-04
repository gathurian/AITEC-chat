<html>
<head>
  <title>PHP-Beispiel zu DB: Anzeige in einer Tabelle (show_table.php)</title>
</head>
<body bgcolor="#00FFFF">
<table bgcolor="#FFFF00" border=2 cellspace=3 cellpadding=3>
<tr><th>Personaldatei</th></tr>
<tr><th>Personalnummer</th><th>Vorname</th><th>Nachname</th>
       <th>Gehalt</th><th>Geburtsdatum</th></tr>

<?php
	$db=mysql_connect("localhost", "aitec", "dachs");
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
	     echo "<tr><td>$pn</td><td>$vn</td><td>$nn</td>
		<td>". number_format($ge,2,",",".")." EUR</td>";
	     echo "<td>$gt</td></tr>";	
	}
	mysql_close($db);?>
</table>   <hr>
  <a href="change.php">Zum Aendern eines Datensatzes</a><p>
  <a href="show.php">Zur Anzeige aller Datensaetze ohne Tabellenform</a><p>
  <a href="delete.php">Zum Loeschen eines Datensatzes</a><p>
  <a href="enter.php">Zur Eingabe eines Datensatzes</a><p>
  <a href="close.php">Datenbank "Firma" beenden</a>
<hr>
</body> 
</html>

