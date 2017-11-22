<?php
                ini_set('display_errors', 1);
                error_reporting(E_ALL ^ E_NOTICE);
require("config.php");
$user = "admin";
if(!$stat = $conn->prepare("SELECT * FROM admin WHERE username=?")){
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}

if(!$stat -> bind_param("s", $user)){
    echo "Binding parameters failed: (" . $stat->errno . ") " . $stat->error;
}

if(!$stat->execute()){
    echo "Execute failed: (" . $stat->errno . ") " . $stat->error;
} else {
    //$stat -> store_result();
    //$stat -> bind_result($id, $username, $passcode, $salt);
    $result = $stat->get_result()->fetch_assoc();
    $passcode = $result[passcode];
    echo $passcode;
}

/*$result = $conn->query("SELECT * FROM admin WHERE username='admin'");
  while($row = mysqli_fetch_array($result)) {
    $id = $row['id'];
    $username = $row['username'];
    $passcode = $row['passcode'];
    $salt = $row['salt'];
  }
echo $id;
echo "<br/>";
echo $username;
echo "<br/>";
echo $passcode;
echo "<br/>";
echo $salt;*/
?>