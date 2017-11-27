<?php
    require('config.php');
    require('functions.php');
    
    //error-reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_NOTICE);

    $user = trim($_POST['user']);
    $passwd = trim($_POST['passwd']);

    if((!empty($user)) && (!empty($passwd))){
        if(!$stat = $conn->prepare("SELECT * FROM personen WHERE personalnummer=?")){
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        }

        if(!$stat -> bind_param("s", $user)){
            echo "Binding parameters failed: (" . $stat->errno . ") " . $stat->error;
        }

        if(!$stat->execute()){
            echo "Execute failed: (" . $stat->errno . ") " . $stat->error;
        } else {
            $result = $stat->get_result()->fetch_assoc();
            $passcode = $result[password];
            $salt = $result[salt];
            $password = hash('sha512', $passwd . $salt);
            $approved = $result[approved];

            if($password == $passcode){
                if($approved == 1){
                    sec_session_start();
                    $_SESSION['logon'] = 1;
                    echo "$user ist nun eingeloggt";
                } else {
                    echo "$user ist nicht authorisiert zu chatten";
                }
            } else {
                echo  "Ungültige Logindaten";
            }
        }
        $stat -> close();
    } else {
    echo "Bitte geben Sie einen gültigen Benutzernamen und ein gültiges Passwort ein";
    }
    $conn->close();
?>
