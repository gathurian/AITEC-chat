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
            <h2>User approval</h2>
        </div>
        <?php
            require('functions.php');
            require('config.php');
            
            sec_session_start();
            if($_SESSION['logon'] != 1){   
                echo "Please login as admin to approve users";
                ?>
                <style type="text/css">#chatLineHolderLogin{
                display:none;
                }</style>
                <?php
                header("Refresh: 2; URL=../login_admin.html");
            }
            $personalnummer = $_POST['persnr']; 
        ?>
        <div id="chatLineHolderLogin">
            Please set a password for the approved user
            <form action="" method="post" >
                <input name="persnr" value="<?php echo htmlspecialchars($personalnummer); ?>" readonly>
                <br/>
                <input name="pw" type="password" id="pw" oninput="check(this)"> Passwort
                 <script language='javascript' type='text/javascript'>
                    function check(input) {
                        if (input.value == 'Passwort') {
                            input.setCustomValidity('Password cannot be "Passwort"');
                        } else {
                            // input is valid -- reset the error message
                            input.setCustomValidity('');
                        }
                    }
                </script>
                <br/>
                <input name="pw_conf" type="password" id="pw_conf" oninput="checkMatch(this)"> Passwort bestätigen
                <script language='javascript' type='text/javascript'>
                    function checkMatch(input) {
                        if (input.value != document.getElementById('pw').value) {
                            input.setCustomValidity('Passwords do not match.');
                        } else {
                            // input is valid -- reset the error message
                            input.setCustomValidity('');
                        }
                    }
                </script>
                <br/>
                <input type="submit" name="Abschicken" value="Approve" class="blueButton">
            </form>
            
            <?php
                require('config.php');

                ini_set('display_errors', 1);
                error_reporting(E_ALL ^ E_NOTICE);
            
               if(isset($_POST['Abschicken'])){
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
                        echo "$persnr \n is now authorized to chat";
                        header("Refresh: 2; URL=show_users.php");
                    }

                    $conn->close();
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
