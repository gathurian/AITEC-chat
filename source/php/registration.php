<html>

<head>
    <title>AITEC HS2017 - PHP WebChat</title>

    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/js/jScrollPane/jScrollPane.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/css/page.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/css/chat.css" />
</head>

<body>
    <div id="chatContainer">
        <div id="chatTopBar" class="rounded">
            <h2>Benutzer-Registration</h2>
        </div>
        <div id="admin">
            <form action="http://localhost/AITEC/source/ajax-chat.html">
                <input type="submit" class="blueButton" value="Back">
            </form>
        </div>
        <div id="chatLineHolderLogin">
            <?php
                require('config.php');
                
                $name = $_POST['nn'];
                $vorname = $_POST['vn'];
                $personalnummer = $_POST['pn'] ;
                $gehalt = $_POST['ge'];
                $geburtstag = $_POST['gt'];
                    
                if(ctype_alpha($name) && ctype_alpha($vorname)){
                    if(ctype_alnum($personalnummer)){
                        if(ctype_digit($gehalt)){
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
                                echo "$vorname \n $name \n has been added to the database";
                        ?>
                            <form action="http://localhost/AITEC/source/ajax-chat.html">
                                <input type="submit" class="blueButton" value="Back">
                            </form>
                            <?php
                            }

                            $stat->close();
                            $conn->close();
                        } else {
                            echo "Das Gehalt darf nur aus Ziffern (0-9) bestehen";
                            header("Refresh; 2: URL=http://localhost/AITEC/source/registration.html");
                        }
                    } else {
                        echo "Die Personalnummer darf nur aus alphanumerischen Charaktern (a-z/A-Z/0-9) bestehen";
                        header("Refresh; 2: URL=http://localhost/AITEC/source/registration.html");
                    }
                } else {
                    echo "Der Name darf nur aus alphabetischen Charaktern (a-z/A-Z) bestehen";
                    header("Refresh: 2; URL=http://localhost/AITEC/source/registration.html");

                }
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
