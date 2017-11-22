<html>

<head>
    <title>Benutzer-Freischaltung</title>

    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/js/jScrollPane/jScrollPane.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/css/page.css" />
    <link rel="stylesheet" type="text/css" href="http://localhost/AITEC/source/css/chat.css" />
</head>

<body>
    <div id="chatContainer">
        <div id="chatTopBar" class="rounded">
            <h2>Benutzer-Freischaltung</h2>
        </div>
        <?php
            echo $_SESSION['logon'];
            if($_SESSION['logon']){
                echo "Sie müssen eingeloggt sein, um diese Seite sehen zu können. <br/> Bitte loggen Sie sich ein";
                ?>
                <style type="text/css">#chatLineHolderLogin{
                display:none;
                }</style>
                <?php
                header("Refresh: 2; URL=http://localhost/AITEC/source/login_admin.html");
            }
            $personalnummer = $_POST['persnr'] ;
        ?>
        <div id="chatLineHolderLogin">
            <?php
            echo $_SESSION['logon'];
            ?>
            Bitte setzen Sie ein Passwort für den freizuschaltenden Benutzer
            <form action="http://localhost/AITEC/source/php/approve.php" method="post" >
                <input name="persnr" value="<?php echo htmlspecialchars($personalnummer); ?>" readonly>
                <br/>
                <input name="pw" type="password" id="pw"> Passwort
                <br/>
                <input name="pw_conf" type="password" id="pw_conf" oninput="check(this)"> Passwort bestätigen
                <script language='javascript' type='text/javascript'>
                    function check(input) {
                        if (input.value != document.getElementById('pw').value) {
                            input.setCustomValidity('Passwörter stimmen nicht überein.');
                        } else {
                            // input is valid -- reset the error message
                            input.setCustomValidity('');
                        }
                    }
                </script>
                <br/>
                <input type="submit" name="Abschicken" value="Freischalten" class="blueButton">
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