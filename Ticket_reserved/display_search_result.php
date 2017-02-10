<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
include './includes/connection.php';

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
                                <center><div class="" align="center" style="width:97%;min-height:20px; font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">
                                        <img src="images/logo1.png" width="25%" height="20%">
                                        <br>
                                        <?php
                                        extract($_POST);
                                        include("./includes/connection.php");
                                        if (isset($_POST['date']) && isset($_POST['start']) && isset($_POST['destination']) && isset($_POST['time']) && isset($_POST['type']) && isset($_POST['seat'])) {

                                            $date = $_POST['date'];
                                            $start = $_POST['start'];
                                            $destination = $_POST['destination'];
                                            $time = $_POST['time'];
                                            $type = $_POST['type'];
                                            $seat = $_POST['seat'];

                                            if (!empty($date) && !empty($start) && !empty($destination) && !empty($time) && !empty($type) && !empty($seat) &&
                                                    $date != NULL && $start != NULL && $destination != NULL && $time != NULL && $type != NULL && $seat != NULL) {
                                                echo $date;
                                                $price_seat = "";
                                                $bus_ids = "";
                                                $query = "SELECT * FROM `bus` where  `source`='$start' AND `type`='$type' AND  `time`='$time' AND `destination`='$destination';";

                                                $query2 = mysql_query($query, $connection);

                                                if (!$query2) {
                                                    die("Database select  fail" . mysql_error());
                                                }
                                                $date = str_replace('/', '-', $date);
                                                $jpurnet_date = date('Y-m-d', strtotime($date));
                                                echo " <table><tr> <th colspan='3'>&nbsp;&nbsp;</th></tr>";
                                                while ($row = mysql_fetch_array($query2)) {
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
                                                    $price_seat = $row['price'];
                                                    $bus_ids = $row['bus_id'];
                                                }
                                                echo "</table>";
//                                                echo $price_seat . ' ' . $bus_ids . '<br/>';
//                                                $check_in_date = date("d-m-Y", strtotime($date01));echo $jpurnet_date . " Sjjjs";
                                                $quer = "SELECT * FROM `seat`  "
                                                        . "where `bus_id`='$bus_ids' AND `seat_id` not in "
                                                        . "(SELECT `seat_id` FROM `reservation` where `date`='$jpurnet_date' AND `bus_id`='$bus_ids');";

                                                $query4 = mysql_query($quer, $connection);

                                                if (!$query4) {
                                                    die("Database select  fail" . mysql_error());
                                                }

                                                $cv = array('');
                                                $i = 0;
                                                while ($row4 = mysql_fetch_array($query4)) {
                                                    $cv[$i] = $row4['seat_name'];
                                                    $i++;
                                                }
                                                if ($i < $seat) {
                                                    $_SESSION['to_fare'] = "Seat is not Available.";
                                                    header("Location:http://localhost/Ticket_reserved/fare_query.php");
                                                }
                                                if (isset($_SESSION['from_fare']) && !empty($_SESSION['from_fare'])) {
                                                    $frm_fare = $_SESSION['from_fare'];
                                                    if ($frm_fare == "yes") {
                                                        $_SESSION['to_fare'] = "Total seat price is " . $price_seat * $seat." Taka Only";
                                                        unset($_SESSION['from_fare']);
                                                        header("Location:http://localhost/Ticket_reserved/fare_query.php");
//                                                        
                                                    }
                                                }

                                                $_SESSION['bus_id'] = $bus_ids;
                                                $_SESSION['date'] = $jpurnet_date . '';

                                                $_SESSION['price'] = $seat * $price_seat;
                                                $_SESSION['num'] = $seat;
//}
                                                $seat_number = $seat;
                                                switch ($seat_number) {
                                                    case 1:
                                                        echo 'select Seat :<select name="seat_confrm" >';
                                                        foreach ($cv as $value) {
                                                            echo ' <option value=' . $value . '>' . $value . '</option>';
                                                        }
                                                        echo '</select>';
                                                        break;
                                                    case 2:
                                                        echo 'select Seat :<select name="seat_confrm" >';
                                                        foreach ($cv as $value) {
                                                            echo ' <option value=' . $value . '>' . $value . '</option>';
                                                        }
                                                        echo '</select>';
                                                        echo 'select Seat :<select name="seat_confrm1" >';
                                                        foreach ($cv as $value) {
                                                            echo ' <option value=' . $value . '>' . $value . '</option>';
                                                        }
                                                        echo '</select>';
                                                        break;
                                                    default:
                                                        break;
                                                }
                                            } else {
                                                if (isset($_SESSION['from_fare']) && !empty($_SESSION['from_fare'])) {
                                                    $frm_fare = $_SESSION['from_fare'];
                                                    if ($frm_fare == "yes") {
                                                        unset($_SESSION['from_fare']);
                                                        header("Location:http://localhost/Ticket_reserved/fare_query.php");
//                                                        
                                                    }
                                                } else {
                                                    header("Location:http://localhost/Ticket_reserved/index.php");
                                                }
                                            }
                                        } else {
                                            if (isset($_SESSION['from_fare']) && !empty($_SESSION['from_fare'])) {
                                                $frm_fare = $_SESSION['from_fare'];
                                                if ($frm_fare == "yes") {
                                                    unset($_SESSION['from_fare']);
                                                    header("Location:http://localhost/Ticket_reserved/fare_query.php");
//                                                        
                                                }
                                            } else {
                                                header("Location:http://localhost/Ticket_reserved/index.php");
                                            }
                                        }
                                        ?><br/><br/>
                                        <input type="submit"    value="Bookimg">
                                    </div></center>
                            </form>
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