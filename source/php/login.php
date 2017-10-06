<?php
$servername = "localhost";
$username = "aitec";
$password = "dachs";
$dbname = "firma";

ini_set('display_errors', 1);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if(!$stat = $conn->prepare("INSERT INTO personen (name, vorname, personalnummer, gehalt, geburtstag, schluessel) 
	VALUES (?,?,?,?,?,?)")){
	 echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}

if(!$stat -> bind_param("ssssss", $name, $vorname, $personalnummer, $gehalt, $geburtstag, $schluessel)){
	echo "Binding parameters failed: (" . $stat->errno . ") " . $stat->error;
}

$name = $_POST['nn'];
$vorname = $_POST['vn'];
$personalnummer = $_POST['pn'] ;
$gehalt = $_POST['ge'];
$geburtstag = $_POST['gt'];
$schluessel = $_POST['ke'];

if(!$stat->execute()){
	 echo "Execute failed: (" . $stat->errno . ") " . $stat->error;
} else {
	echo "New Record created successfully";
}

$stat->close();
$conn->close();
?> 