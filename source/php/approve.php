<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AITEC HS2017 - PHP WebChat </title>

    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/js/jScrollPane/jScrollPane.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/css/page.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/css/chat.css" />

</head>

<body>

    <div id="chatContainer">

        <div id="chatTopBar" class="rounded">
            <div id="admin">
                <form action="http://localhost/AITEC/source/php/logout.php">
                    <input type="submit" class="blueButton" value="Logout">
                </form>
            </div>
            <h2>Admin Panel</h2>

        </div>
        <div id="chatLineHolderAdmin">
            <?php
                require('config.php');

                ini_set('display_errors', 1);
                error_reporting(E_ALL ^ E_NOTICE);
            
               if($_SERVER[HTTP_REFERER]== "http://localhost/AITEC/source/php/set_approve.php"){
                    $persnr = $_POST['persnr'];
                    $pw_clear = $_POST['pw'];
                    $salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
                    $pw =  hash('sha512', $pw_clear . $salt);

                    if(!$stat = $conn->prepare("UPDATE personen SET password=?, salt=?, approved=1 WHERE personalnummer=?")){
                            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                    }

                    if(!$stat -> bind_param("sss", $pw, $salt, $persnr)){
                        echo "Binding parameters failed: (" . $stat->errno . ") " . $stat->error;
                    }

                    if(!$stat->execute()){
                         echo "Execute failed: (" . $stat->errno . ") " . $stat->error;
                    } else {
                        echo "$persnr \n kann nun chatten";
                        header("Refresh: 2; URL=http://localhost/AITEC/source/php/show_users.php");
                    }

                    $conn->close();
                } else {
                    echo "Benutzer können nur über das Admin-Panel freigeschaltet werden";
                    header("Refresh: 2; URL=http://localhost/AITEC/source/php/show_users.php");
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
