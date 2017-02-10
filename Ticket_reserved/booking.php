<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
include './includes/connection.php';
if (isset($_POST['seat_confrm'])) {
    $_SESSION['seat_confrm'] = $_POST['seat_confrm'];
}
if (!isset($_SESSION['user_id'])) {
    $_SESSION['running'] = "yes";
    header("Location:http://localhost/Ticket_reserved/registration.php");
}
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
                        <div style="" id="vasplus_programming_blog_wrapper" class=" bigEntrance">
                            <form  method="post" action="http://localhost/Ticket_reserved/pay.php">
                                <center>
                                    <div class="" align="center" style="width:98%;min-height:20px; font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">
                                        <img src="images/logo1.png" width="25%" height="20%">
                                        <br>
                                        <?php
                                        extract($_POST);
                                        include("./includes/connection.php");

                                        if (isset($_SESSION['bus_id']) && $_SESSION['bus_id'] != NULL && isset($_SESSION['date']) && isset($_SESSION['price']) && isset($_POST['seat_confrm'])) {
                                            $bus_id = $_SESSION['bus_id'];
                                            $jpurnet_date = date("Y-m-d", strtotime($_SESSION['date']));
                                            $price = $_SESSION['price'];
                                            $seat = $_POST['seat_confrm'];
//                                            $date = str_replace('/', '-', $date);
//                                                $jpurnet_date = date('Y-m-d', strtotime($date));
//                                            echo " " . $bus_id . " " . $price . " " . $seat . " ";

                                            if (!empty($jpurnet_date) && $jpurnet_date != NULL && $bus_id != NULL && !empty($bus_id) && !empty($seat)) {
//                                                echo $row['destination'] . " " . $row['sourcess'] . '<br/>';
                                                $price_seat = "";
                                                $bus_ids = "";
                                                $que = "SELECT * FROM `bus` b,`seat` s "
                                                        . "where  b.`bus_id`='$bus_id'  AND b.`bus_id`=s.`bus_id` AND s.`seat_name`='$seat';";

                                                $quer = mysql_query($que, $connection);

                                                if (!$quer) {
                                                    die("Database select  fail" . mysql_error());
                                                }

                                                echo " <table><tr> <th colspan='3'>&nbsp;&nbsp;</th></tr>";
                                                while ($row = mysql_fetch_array($quer)) {
                                                    echo "<tr><td>&nbsp;</td><td>From </td><td>:&nbsp;</td> <td>"
                                                    . $row['source'] . "</td></tr>";


                                                    echo "<tr><td>&nbsp;</td><td>To </td><td>:&nbsp;</td> <td>"
                                                    . $row['destination'] . "</td></tr>";
                                                    echo "<tr><td>&nbsp;</td><td>Date </td><td>:&nbsp;</td> <td>"
                                                    . $jpurnet_date . "</td></tr>";

                                                    echo "<tr><td>&nbsp;</td><td>Time </td><td>:&nbsp;</td> <td>"
                                                    . $row['time'] . "</td></tr>";
                                                    echo "<tr><td>&nbsp;</td><td>Type </td><td>:&nbsp;</td> <td>"
                                                    . $row['type'] . "</td></tr>";
                                                    echo "<tr><td>&nbsp;</td><td>per Seat price  </td><td>:&nbsp;</td> <td>"
                                                    . $row['price'] . "</td></tr>";
                                                    echo "<tr><td>&nbsp;</td><td>Seat No </td><td>:&nbsp;</td> <td>"
                                                    . $row['seat_name'] . "</td></tr>";
                                                    echo "<tr><td>&nbsp;</td><td>&nbsp; </td><td>&nbsp;</td> <td>"
                                                    . "<input  type='submit'  class='ad_submit_book'  value='submit'>" . "</td></tr>";
//                                                    echo "<input  type='submit'  class='ad_submit_book'  value='submit'>";                                                   $price_seat = $row[';
                                                    $bus_ids = $row['bus_id'];
                                                }
                                                echo '</table>';
                                            } else {
                                                header("Location:http://localhost/Ticket_reserved/index.php");
                                            }
                                        }
                                        ?>
                                    </div>
                                </center>
                            </form>
                        </div>
                    </center>
                </div>
            </div>
        </div>

        <!-- Footer For Ticket reserved-->
        <?php
        include './includes/footer.php';
        ?>
    </body>
</html>