<?php
$servername = "localhost";
$username = "aitec";
$password = "dachs";
$dbname = "firma";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO personen (name, vorname, personalnummer, gehalt, geburtstag, schluessel)
VALUES ('Muster', 'Peter', 'ma002', '654534', '1999-11-05', 'ma002')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>