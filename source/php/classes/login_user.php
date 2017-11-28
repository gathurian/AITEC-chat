<?php

    
    //error-reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_NOTICE);

    $user = trim($_POST['user']);
    $passwd = trim($_POST['passwd']);

function userLogin($user, $passwd){   
    require('config.php');
    
    $status = false;
    
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
                    $status = true;
                } else {
                    $status = false;
                }
            } else {
                $status = false;
            }
        }
        $stat -> close();
    } else {
        $status = false;
    }
    $conn->close();
    return $status;
}
?>
