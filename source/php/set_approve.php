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
            if($_SERVER[HTTP_REFERER]!= "http://localhost/AITEC/source/php/show_users.php"){
                echo "User can only be approved over the admin-panel";
                ?>
                <style type="text/css">#chatLineHolderLogin{
                display:none;
                }</style>
                <?php
                header("Refresh: 2; URL=http://localhost/AITEC/source/php/show_users.php");
            }
            $personalnummer = $_POST['persnr']; 
        ?>
        <div id="chatLineHolderLogin">
            Please set a password for the approved user
            <form action="http://localhost/AITEC/source/php/approve.php" method="post" >
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
