<html>

<head>
    <title>AITEC HS2017 - PHP WebChat</title>

    <link rel="stylesheet" type="text/css" href="js/jScrollPane/jScrollPane.css" />
    <link rel="stylesheet" type="text/css" href="css/page.css" />
    <link rel="stylesheet" type="text/css" href="css/chat.css" />
</head>

<body>
    <div id="chatContainer">
        <div id="chatTopBar" class="rounded">
            <div id="admin">
                <form action="ajax-chat.html">
                    <input type="submit" class="blueButton" value="Back">
                </form>
            </div>
            <h2>Benutzer-Registration</h2>
        </div>
        <div id="chatLineHolderLogin">
            <form action="" method="post">
                <input name="pn" size=5 required>Personal number/Username
                <br/>
                <input name="vn" size=20 required>Firstname
                <br/>
                <input name="nn" size=20 required>Lastname
                <br/>
                <input name="gt" size=20 required>Birthday (YYYY-MM-DD)
                <br/>
                <input name="ge" size=10 required>Salary in CHF
                <br/>
                <b>Information:</b> Your account has to be approved by an admin before you can start chatting.
                <br/>
                <input type="submit" name="Abschicken" value="Register" class="blueButton">
            </form>

            <?php
                require('php/config.php');
                
                $error = "";
                $name = htmlspecialchars($_POST['nn']);
                $vorname = htmlspecialchars($_POST['vn']);
                $personalnummer = htmlspecialchars($_POST['pn']);
                $gehalt = htmlspecialchars($_POST['ge']);
                $geburtstag = htmlspecialchars($_POST['gt']);
                    
                if(isset($_POST['Abschicken'])){
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
                                $error =  "$vorname \n $name \n has been added to the database";
                                header("Refresh: 2; URL=ajax-chat.html");
                            }

                            $stat->close();
                            $conn->close();
                        } else {
                            $error = "Invalid input. Your salary must consist of numbers from 0 - 9";
                            header("Refresh; 2: URL=registration.php");
                        }
                    } else {
                        $error = "Invalid Input. Your personal number must consist of alphanumeric characters (aA - zZ & 0 - 9)";
                        header("Refresh; 2: URL=registration.php");
                    }
                } else {
                    $error = "Invalid Input. Your name must consist of alphabetical characters (aA - zZ)";
                    header("Refresh: 2; URL=registration.php");

                }
                }
            ?>
        </div>
        <div id="chatBottomBar" class="rounded">
            <div id="error">
                <?php
                echo $error;
            ?>
            </div>
        </div>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script src="js/jScrollPane/jquery.mousewheel.js"></script>
    <script src="js/jScrollPane/jScrollPane.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
