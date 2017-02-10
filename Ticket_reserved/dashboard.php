<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
include './includes/connection.php';
//if (!isset($_SESSION['user_login']) && !empty($_SESSION['user_login']) && $_SESSION['user_login'] != 'yes') {
//    header("Location:http://localhost/Ticket_reserved/registration.php");
//}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="Stylesheet" href="css/Main_css.css" type="text/css"/>
        <link rel="Stylesheet" href="css/ad_user.css" type="text/css"/>
        <link rel="Stylesheet" href="css/quiz.css" type="text/css"/>
        <title>Searching Result </title>


    </head>
    <body>

        <!-- Heaer For Ticket reserved-->
        <?php
        if (!empty($_SESSION['type'])) {
            if ($_SESSION['type'] == 'user') {
                include './includes/user_header.php';
            } if ($_SESSION['type'] == 'admin') {
                include './includes/admin_header.php';
            }
        } else {
            include './includes/Main_header.php';
        }
        ?>


        <!-- Main body For Ticket reserved-->
        <div id="mainBody">
            <div id="admin">
                <div id="ad_booking">
                    <center>
                        <div style="" id="dash_wrapper" class=" bigEntrance">
                            <!--<form  method="post" action="http://localhost/Ticket_reserved/booking.php">-->
                            <center><div class="" align="center" style="width:97%;min-height:20px; font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">
                                    <img src="images/logo1.png" width="10%" height="8%">
                                    <br>
                                    <?php
                                    extract($_POST);
                                    include("./includes/connection.php");
                                    if (isset($_SESSION['user_id'])) {

                                        $id = $_SESSION['user_id'];

//                                            echo $start.'a '. $destination.' b'.$type.'jc'.$seat.' d'.$time;
                                        if (!empty($id)) {
                                            $query = "SELECT * FROM `dashboard`  "
                                                    . "where  `user_id`='$id';";
                                            $query2 = mysql_query($query, $connection);

                                            if (!$query2) {
                                                die("Database select  fail" . mysql_error());
                                            }
                                            $n = 1;
                                            echo " <table border='2'><tr> <th>No</th><th>Bus id</th>"
                                            . "<th>From</th><th>To</th><th>Purching Date</th>"
                                            . "<th>Journey Date</th><th>Seat Name</th> "
                                            . "<th>Status</th></tr>";
                                            while ($row = mysql_fetch_array($query2)) {
                                                echo "<tr id='dash_tuple'><td>"
                                                . $n . "</td>";
                                                echo "<td>"
                                                . $row['bus_no'] . "</td>";
                                                echo "<td>"
                                                . $row['source'] . "</td>";
                                                echo "<td>"
                                                . $row['destination'] . "</td>";
                                                echo "<td>"
                                                . $row['pdate'] . "</td>";
                                                echo "<td>"
                                                . $row['date'] . "</td>";

                                                echo "<td>"
                                                . $row['seat_name'] . "</td>";
                                                echo "<td>"
                                                . $row['status'] . "</td></tr>";
                                                $n++;
                                            }
                                            echo "</table>";
                                        }
                                    }
                                    ?>
                                </div></center>
                            <!--</form>-->
                        </div>
                    </center>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Footer For Ticket reserved-->
<?php
include './includes/footer.php';
?>
</body>
</html>