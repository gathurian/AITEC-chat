<html>
<head>
<title>PHP-Beispiel zu DB: Beenden der DB (close.php)</title>
</head>
<body bgcolor="#eeeeff">
<h2>Jetzt ist die DB "Firma" geschlossen! <br>Tschuess!</h2>

<?php
	$db=mysql_connect("localhost", "aitec", "dachs");
	mysql_select_db("firma",$db);
	mysql_close($db);

?>
</body>
</html>
