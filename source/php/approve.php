<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Making an AJAX Web Chat With PHP, MySQL and jQuery </title>

    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/js/jScrollPane/jScrollPane.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/css/page.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/css/chat.css" />

</head>

<body>

    <div id="chatContainer">

        <div id="chatTopBar" class="rounded">
            <div id="admin">
                <form action="http://localhost/AITEC/source/ajax-chat.html">
                    <input type="submit" class="blueButton" value="Logout">
                </form>
            </div>
            <h2>Admin Panel</h2>

        </div>
        <div id="chatLineHolderAdmin">
            <?php
                $servername = "localhost";
                $username = "aitec";
                $password = "dachs";
                $dbname = "firma";

                ini_set('display_errors', 1);
                error_reporting(E_ALL ^ E_NOTICE);

                $approved = $_POST['appr'];
                $persnr = $_POST['persnr'];

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if(!$stat = $conn->prepare("UPDATE personen SET approved=? WHERE personalnummer=?")){
                        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                }

                if(!$stat -> bind_param("ds", $approved, $persnr)){
                    echo "Binding parameters failed: (" . $stat->errno . ") " . $stat->error;
                }

                if(!$stat->execute()){
                     echo "Execute failed: (" . $stat->errno . ") " . $stat->error;
                } else {
                    echo "User updated";
                }



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