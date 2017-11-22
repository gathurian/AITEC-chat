<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Making an AJAX Web Chat With PHP, MySQL and jQuery </title>

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
            <?PHP
                error_reporting(E_ALL ^ E_NOTICE);
                require('functions.php');
                require('config.php');
            
                sec_session_start();
                if($_SESSION['logon']){
            
                    $host = 'localhost';
                    $user = 'aitec';
                    $pass = 'dachs';
                    $db = 'firma';

                    $mysqli = new mysqli($host, $user, $pass, $db);

                    //show tables
                    $result = $mysqli->query("SELECT * from personen");
                    echo "<table>";
                    echo "<tr>
                            <th id='persNo'>Pers. Nr</th>
                            <th>Vorname</th>
                            <th>Nachname</th>
                            <th id='adminApproved'></th>
                            <th></th>
                        </tr>";

                    while($row = mysqli_fetch_array($result)) {
                        $name = $row['name'];
                        $vorname = $row['vorname'];
                        $personalnummer = $row['personalnummer'];
                        $approved = $row['approved'];
                        if($approved === '0'){
                            $status =
                                "<form action='http://localhost/AITEC/source/php/set_approve.php' method='post'>
                                    <input type='hidden' name='persnr' value='".$personalnummer."'>
                                    <input type='submit' class='blueButton' value='Approve'>
                                </form>";
                        }
                        else{
                            $status = 
                                "<form action='http://localhost/AITEC/source/php/disapprove.php' method='post'>
                                    <input type='hidden' name='persnr' value='".$personalnummer."'>
                                    <input type='submit' class='blueButton' value='Disapprove'>
                                </form>";

                        }

                        echo
                            "<tr>
                                <td id='persNo'>" .$personalnummer. "</td>
                                <td>" .$name. "</td>
                                <td>" .$vorname. "</td>
                                <td>" .$status. "</td>
                                <td>
                                    <form action='http://localhost/AITEC/source/php/delete.php' method='post'>
                                        <input type='hidden' name='persnr' value='".$personalnummer."'>
                                        <input type='submit' class='blueButton' value='Löschen'>
                                    </form>
                                </td>
                            </tr>";

                    } 

                    echo "</table>";
                    mysqli_close($con);
                } else {
                    echo "Sie müssen eingeloggt sein, um diese Seite sehen zu können. <br/> Bitte loggen Sie sich ein";
                    header("Refresh: 2; URL=http://localhost/AITEC/source/login_admin.html");
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