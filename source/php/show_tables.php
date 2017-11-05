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
                <form action="http://localhost/AITEC/source/ajax-chat.html">
                    <input type="submit" class="blueButton" value="Logout">
                </form>
            </div>
            <h2>Admin Panel</h2>

        </div>
        <div id="chatLineHolderAdmin">
            <?PHP
            
            //Error-Reporting for debugging
            //ini_set('display_errors', 1);
            //ini_set('display_startup_errors', 1);
            //error_reporting(E_ALL);
            
                $host = 'localhost';
                $user = 'aitec';
                $pass = 'dachs';
                $db = 'firma';

                $mysqli = new mysqli($host, $user, $pass, $db);

                //show tables
                $result = $mysqli->query("SELECT * from personen");
                echo "<table>";
                echo "<tr>
                        <th id='name'>Name</th>
                        <th>Vorname</th>
                        <th>Personalnummer</th>
                        <th id='adminApproved'>Admin-Approved</th>
                    </tr>";

                while($row = mysqli_fetch_array($result)) {
                    $name = $row['name'];
                    $vorname = $row['vorname'];
                    $personalnummer = $row['personalnummer'];
                    $approved = $row['approved'];
                    if($approved === '0'){
                        $status = "<button type='submit' name='appr'>Approve</button>";
                    } else {
                        $status = "<button type='submit' name='disappr'>Disapprove</button>";
                    }
                    
                    //todo: Actually update the "approved" flag on the DB
                    
                    echo 
                        "<tr>
                            <td id='name'>".$name."</td>
                            <td>".$vorname."</td>
                            <td>".$personalnummer."</td>
                            <td>".$status."</td>
                        </tr>";
                } 

                echo "</table>";
                mysqli_close($con);
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
