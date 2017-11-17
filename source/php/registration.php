<html>

<head>
    <title>Benutzer-Registration</title>

    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/js/jScrollPane/jScrollPane.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/css/page.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/css/chat.css" />
</head>

<body>
    <div id="chatContainer">
        <div id="chatTopBar" class="rounded">
            <h2>Benutzer-Registration</h2>
        </div>
        <div id="chatLineHolderLogin">
            <?php
                require('config.php');
                
                $name = $_POST['nn'];
                $vorname = $_POST['vn'];
                $personalnummer = $_POST['pn'] ;
                $gehalt = $_POST['ge'];
                $geburtstag = $_POST['gt'];
                    
                
                if(!$stat = $conn->prepare("INSERT INTO personen (name, vorname, personalnummer, gehalt, geburtstag) 
                    VALUES (?,?,?,?,?)")){
                     echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                }

                if(!$stat -> bind_param("sssss", $name, $vorname, $personalnummer, $gehalt, $geburtstag)){
                    echo "Binding parameters failed: (" . $stat->errno . ") " . $stat->error;
                }

                if(!$stat->execute()){
                     echo "Execute failed: (" . $stat->errno . ") " . $stat->error;
                } else {
                    echo "$vorname \n $name \n wurde der Datenbank hinzugefügt";
            ?>
                <form action="http://localhost/AITEC/source/ajax-chat.html">
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
