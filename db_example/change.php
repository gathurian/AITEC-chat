<html>
<head>
  <title>PHP-Beispiel zu DB: Aendern eines Datensatzes (change.php)</title>
</head>
<body bgcolor="#44ddff">
<h3>Aendern eines Datensatzes <br>aus der MySQL-Datei "Firma", 
	Tabelle "Personen"</h3>
<hr>
<form>
<table bgcolor="#FFFF00" border=2 cellspace=3 cellpadding=3>
<tr><th>Personaldatei</th></tr>
<tr><th>Auswahl</th><th>Personalnummer</th><th>Vorname</th><th>Nachname</th>
	<th>Gehalt</th><th>Geburtsdatum</th></tr>
<?php
	$db=mysql_connect("localhost", "aitec", "dachs");
	mysql_select_db("firma",$db);

	$res=mysql_query("SELECT * FROM personen") or die("fehler query");
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
     <input   type="submit"   value="Datensatz anzeigen">
</form>
<?php
	$auswahl = $_GET['auswahl'];
	if ($auswahl != "")
	{
		$db=mysql_connect("localhost", "aitec", "dachs");
		mysql_select_db("firma",$db);

		$sqlab="select * from personen where";
		$sqlab .= " personalnummer='".$auswahl."'";
	
		$res=mysql_query($sqlab);
			
		$altnn=mysql_result($res, 0, "name");
		$altvn=mysql_result($res, 0, "vorname");
		$altge=mysql_result($res, 0, "gehalt");
		$altgt=mysql_result($res, 0, "geburtstag");

		echo "Fuehren Sie die Aenderungen durch,<br>";
		echo "betaetigen Sie anschliessend den Button<p>";
	echo "<form action='change_it.php' method='get'>";
	echo "<input name='neunn' value='$altnn'> Nachname<p>";
	echo "<input name='neuvn' value='$altvn'> Vorname<p>";
	echo "<input name='neupn' value='$auswahl'> Personalnummer<p>";
	echo "<input name='neuge' value='$altge'> Gehalt<p>";
	echo "<input name='neugt' value='$altgt'> Geburtstag<p>";
	echo "<input type='hidden' name='oripn' value='$auswahl'>";
	echo "<input type='submit' value='Aenderungen in DB speichern'><p>";
	echo "</form>";		
	mysql_close($db);
   }
   else echo "Es wurde kein Datensatz ausgewaehlt<p>";
?> <hr>		
<a href="show.php">Zur Anzeige aller Datensaetze ohne Tabellenform</a><p>
<a href="show_table.php">Zur Anzeige aller Datensaetze als Tabelle</a><p>
<a href="delete.php">Zum Loeschen eines Datensatzes</a><p>
<a href="entere.php">Zur Eingabe eines Datensatzes</a><p>
<a href="close.php">Datenbank "Firma" beenden</a>
<hr>  
</body>
</html>

