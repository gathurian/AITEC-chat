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
            <div id="admin">
                <form action="http://localhost/AITEC/source/ajax-chat.html">
                    <input type="submit" class="blueButton" value="Back">
                </form>
            </div>
            <h2>User registration</h2>
        </div>
        <div id="chatLineHolderLogin">
            <?php
                require('config.php');
                
                $name = htmlspecialchars($_POST['nn']);
                $vorname = htmlspecialchars($_POST['vn']);
                $personalnummer = htmlspecialchars($_POST['pn']);
                $gehalt = htmlspecialchars($_POST['ge']);
                $geburtstag = htmlspecialchars($_POST['gt']);
                    
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
                            echo "Invalid input. Your salary must consist of numbers from 0 - 9";
                            header("Refresh; 2: URL=http://localhost/AITEC/source/registration.html");
                        }
                    } else {
                        echo "Invalid Input. Your personal number must consist of alphanumeric characters (aA - zZ & 0 - 9)";
                        header("Refresh; 2: URL=http://localhost/AITEC/source/registration.html");
                    }
                } else {
                    echo "Invalid Input. Your name must consist of alphabetical characters (aA - zZ)";
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
