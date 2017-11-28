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
            <h2>Login</h2>
        </div>
        <div id="chatLineHolderLogin">
            <form action="" method="post">
                <input name="user" size=20>Username
                <br/>
                <input type="password" name="passwd" size=20>Password
                <br/>
                <input type="submit" name="Abschicken" value="Login" class="blueButton">
            </form>

            <?php
                require('php/config.php');
                require('php/functions.php');
                
                ini_set('display_errors', 1);
                error_reporting(E_ALL ^ E_NOTICE);
                
                $error = "";
                $user = trim($_POST['user']);
                $passwd = trim($_POST['passwd']);

                if(isset($_POST['Abschicken'])){
                    if((!empty($user)) && (!empty($passwd))){
                    if(!$stat = $conn->prepare("SELECT * FROM admin WHERE username=?")){
                        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                    }

                    if(!$stat -> bind_param("s", $user)){
                        echo "Binding parameters failed: (" . $stat->errno . ") " . $stat->error;
                    }

                    if(!$stat->execute()){
                        echo "Execute failed: (" . $stat->errno . ") " . $stat->error;
                    } else {
                        $result = $stat->get_result()->fetch_assoc();
                        $passcode = $result[passcode];
                        $salt = $result[salt];
                        $password = hash('sha512', $passwd . $salt);
                        if($password == $passcode){
                            sec_session_start();
                            $_SESSION['logon'] = 1;
                            header("Refresh: 1; URL=php/show_users.php");
                            exit;
                        } else {
                            $error = "Wrong login data";
                            header("Refresh: 2; URL=login_admin.php");
                        }
                    }
                    $stat -> close();
                } else {
                    $error = "Please enter a valid username and password";
                    header("Refresh: 1; URL=login_admin.php");
                }
                }

                $conn->close();
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
