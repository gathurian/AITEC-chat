<html>
<head>
<title>PHP-Beispiel zu DB: Loeschen eines Datensatzes (delete.php)
</title>
</head>
<body bgcolor="#DDDDFF">
<h3>Loeschen eines Datensatzes <br>
aus der MySQL-Datei "Firma", Tabelle "Personen"</h3>
<hr>
<form>
<table bgcolor="#FFFF00" border=2 cellspace=3 cellpadding=3>
   <tr><th>Personaldatei</th></tr>
   <tr><th>Auswahl</th><th>Personalnummer</th><th>Vorname</th>
          <th>Nachname</th><th>Gehalt</th><th>Geburtsdatum</th></tr>
<?php
	$db=mysql_connect("localhost", "aitec", "dachs");
	mysql_select_db("firma",$db);
	$res=mysql_query("SELECT * FROM personen");
	$num=mysql_num_rows($res);
	for($i=0;$i<$num;$i++)
	{
		$nn=mysql_result($res, $i, "name");
		$vn=mysql_result($res, $i, "vorname");
		$pn=mysql_result($res, $i, "personalnummer");
		$ge=mysql_result($res, $i, "gehalt");
		$gt=mysql_result($res, $i, "geburtstag");
	 	echo "<tr><td><input type='radio' name='auswahl' value='$pn'>";
		echo "<td>$pn</td><td>$vn</td><td>$nn</td>
                         	          <td>". number_format($ge,2,",",".")." EUR</td>";
		echo "<td>$gt</td></tr>";	
	}
	mysql_close($db);
?>

</table><p>
<input type="submit" value="Datensatz anzeigen">
</form>
<?php
	echo "Auswahl: ".$_GET['auswahl']."<br>";
	$auswahl = $_GET['auswahl'];
	if ($auswahl != "")
	{
		$db=mysql_connect("localhost", "aitec", "dachs");
		mysql_select_db("firma",$db);
		$sqlab="SELECT * FROM personen WHERE";
		$sqlab .= " personalnummer='".$auswahl."'";	
		$res=mysql_query($sqlab);
		$altnn=mysql_result($res, 0, "name");
		$altvn=mysql_result($res, 0, "vorname");
		$altge=mysql_result($res, 0, "gehalt");
		$altgt=mysql_result($res, 0, "geburtstag");

		echo "Wenn Sie diesen Datensatz loeschen wollen,<br>";
		echo "betaetigen Sie anschlieﬂend den Button<p>";

		echo "<form action='remove.php' method='post'>";
	echo "<input name='neunn' value='$altnn'> Nachname<p>";
	echo "<input name='neuvn' value='$altvn'> Vorname<p>";
	echo "<input name='neupn' value='$auswahl'> Personalnummer<p>";
	echo "<input name='neuge' value='$altge'> Gehalt<p>";
	echo "<input name='neugt' value='$altgt'> Geburtstag<p>";
	echo "<input type='hidden' name='oripn' value='$auswahl'>";
	echo "<input type='submit' value='Loeschen in DB speichern'><p>";
	echo "</form>";		
     mysql_close($db);
     }
     else 	echo "Es wurde kein Datensatz ausgew‰hlt<p>";
?>  <hr>
<a href="show.php">Zur Anzeige aller Datensaetze ohne Tabelle</a><p>
<a href="show_table.php">Zur Anzeige aller Datensaetze in Tabellenform</a><p>
<a href="change.php">Zum Aendern eines Datensatzes</a><p>
<a href="enter.php">Zur Eingabe eines Datensatzes</a><p>
<a href="close.php">Datenbank "Firma" beenden</a>
<hr>
</body>  
</html>

