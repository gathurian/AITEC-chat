<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AITEC HS2017 - PHP WebChat</title>

    <link rel="stylesheet" type="text/css" href="../js/jScrollPane/jScrollPane.css" />
    <link rel="stylesheet" type="text/css" href="../css/page.css" />
    <link rel="stylesheet" type="text/css" href="../css/chat.css" />

</head>

<body>

    <div id="chatContainer">

        <div id="chatTopBar" class="rounded">
            <div id="admin">
                <form action="logout.php">
                    <input type="submit" class="blueButton" value="Logout">
                </form>
            </div>
            <h2>Admin Panel</h2>

        </div>
        <div id="chatLineHolderAdmin">
            <?php
                require('functions.php');
                require('config.php');
            
                sec_session_start();
                if($_SESSION['logon'] == 1){
                     $persnr = $_POST['persnr'];
                    if(!$stat = $conn->prepare("DELETE FROM personen WHERE personalnummer=?")){
                            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                    }

                    if(!$stat -> bind_param("s", $persnr)){
                        echo "Binding parameters failed: (" . $stat->errno . ") " . $stat->error;
                    }

                    if(!$stat->execute()){
                         echo "Execute failed: (" . $stat->errno . ") " . $stat->error;
                    } else {
                        echo "User deleted";
                    }

                    $conn->close();
                } else {
                    echo "Please login to delete users";
                    header("Refresh: 2; URL=../login_admin.html");
                }
            ?>
            
            <form action="show_users.php">
                    <input type="submit" class="blueButton" value="Zurück">
            </form>
            </div>

        <div id="chatBottomBar" class="rounded">
        </div>

    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script src="../js/jScrollPane/jquery.mousewheel.js"></script>
    <script src="../js/jScrollPane/jScrollPane.min.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>