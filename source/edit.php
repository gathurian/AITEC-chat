<html>

<head>
    <title>Benutzer bearbeiten</title>

    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/js/jScrollPane/jScrollPane.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/css/page.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/css/chat.css" />
</head>

<body>
    <div id="chatContainer">
        <div id="chatTopBar" class="rounded">
            <h2>Benutzer bearbeiten</h2>
        </div>
        <div id="chatLineHolderLogin">
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

                if(!$stat = $conn->prepare("UPDATE personen SET name=?, vorname=?, gehalt=?, geburtstag=? WHERE personalnummer=?")){
                     echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                }

                if(!$stat -> bind_param("sssss", $name, $vorname, $gehalt, $geburtstag, $personalnummer)){
                    echo "Binding parameters failed: (" . $stat->errno . ") " . $stat->error;
                }

                $name = $_POST['nn'];
                $vorname = $_POST['vn'];
                $personalnummer = $_POST['pn'] ;
                $gehalt = $_POST['ge'];
                $geburtstag = $_POST['gt'];

                if(!$stat->execute()){
                     echo "Execute failed: (" . $stat->errno . ") " . $stat->error;
                } else {
            ?>
                Benutzer erfolgreich bearbeitet
                <form action="http://localhost/AITEC/source/php/show_tables.php">
                    <input type="submit" class="blueButton" value="Zurück">
                </form>
                <?php
                }

                $stat->close();
                $conn->close();
            ?>
        </div>
        <div id="chatBottomBar" class="rounded">
        </div>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script src="http://localhost/AITEC/source/js/jScrollPane/jquery.mousewheel.js"></script>
    <script src="http://localhost/AITEC/source/js/jScrollPane/jScrollPane.min.js"></script>
    <script src="http://localhost/AITEC/source/js/script.js"></script>
</body>

</html>
