<html>
<?php
$user_browser = $_SERVER['HTTP_USER_AGENT'];
$password = "Password";
echo hash('sha512', $password . $user_browser);
echo "<br/>";
echo $_SESSION['login_string'];
?>
</html>