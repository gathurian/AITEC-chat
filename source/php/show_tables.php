<?PHP
    $host = 'localhost';
    $user = 'aitec';
    $pass = 'dachs';
    $db = 'firma';

    $mysqli = new mysqli($host, $user, $pass, $db);

    //show tables
    $result = $mysqli->query("SELECT * from personen");
    echo "<table>";
    echo "<tr><th>Name</th><th>Vorname</th><th>Personalnummer</th></tr>";

    while($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
        $vorname = $row['vorname'];
        $personalnummer = $row['personalnummer'];
        echo "<tr><td style='width: 20px;'>".$name."</td><td style='width: 20px;'>".$vorname."</td><td>".$personalnummer."</td></tr>";
    } 

    echo "</table>";
    mysqli_close($con);
    ?>