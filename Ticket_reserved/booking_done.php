<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
include './includes/connection.php';
if (isset($_SESSION['num']) && !empty($_SESSION['num']) &&
        isset($_SESSION['price']) && !empty($_SESSION['price']) &&
        isset($_SESSION['seats']) && !empty($_SESSION['seats'])) {
    $num_seat_search = $_SESSION['num'];
    $prices = $_SESSION['price'];
    $seats = $_SESSION['seats'];
} else {
    $num_seat_search = 0;
    $prices = 0;
    $seats = 0;
}
if (isset($_POST['seat_confrm'])) {
    $_SESSION['seat_confrm'] = $_POST['seat_confrm'];
}
if (!isset($_SESSION['user_id'])) {
    unset($_SESSION);
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
                            <form  method="post" action="registration.php">
                                <center><div class="" align="center" style="width:98%;min-height:20px; font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">

                                        <br>
                                        <?php
                                        extract($_POST);
                                        include("./includes/connection.php");
                                        $tno_insert = " ";
                                        $update_taka = "";
                                        $pay_method = "";
//                                      
                                        if (isset($_POST['tno']) && isset($_POST['pay_method']) && isset($_SESSION['user_id']) && isset($_SESSION['bus_id']) && $_SESSION['bus_id'] != NULL &&
                                                isset($_SESSION['date']) && isset($_SESSION['price']) && isset($_SESSION['seat_confrm'])) {
                                            $tno_insert = $_POST['tno'];
                                            $jpurnet_date = date("Y-m-d", strtotime($_SESSION['date']));
                                            $price = $_SESSION['price'];
                                            $seat = $_SESSION['seat_confrm'];
                                            $user_id = $_SESSION['user_id'];
                                            $bus_id = $_SESSION['bus_id'];
                                            $pay_meth = $_POST['pay_method'];
                                            $seat_id = "";
                                            $dstart = "";
                                            $ddest = "";
                                            $bus_no = "";
                                            if (!empty($jpurnet_date) && $jpurnet_date != NULL && $bus_id != NULL &&
                                                    !empty($bus_id) && !empty($seat) && !empty($pay_meth) && !empty($tno_insert)) {
//                      
                                                $q2 = "SELECT * FROM `payment` "
                                                        . "where  `t_no`='$tno_insert'  AND `taka`>='$prices';";

                                                $qr2 = mysql_query($q2, $connection);


                                                if ($qr2) {
                                                    if (mysql_num_rows($qr2) == 1) {
                                                        $row3 = mysql_fetch_array($qr2);
                                                        $pay_id = $row3['pay_id'];
                                                        $pay_taka = $row3['taka'];
                                                        $pay_tno = $row3['t_no'];
                                                        $pay_method = $row3['method'];
                                                        $update_taka = $pay_taka - $prices;
//                                                        echo $pay_taka . " gfgfgfgg" . $update_taka;
                                                    } else {
                                                        $_SESSION['pay_false'] = "false";
                                                        header("Location: http://localhost/Ticket_reserved/pay.php");
                                                    }

                                                    $bus_ids = "";
                                                    $que = "SELECT * FROM `bus` b,`seat` s "
                                                            . "where  b.`bus_id`='$bus_id'  AND b.`bus_id`=s.`bus_id` AND s.`seat_name`='$seat';";

                                                    $quer = mysql_query($que, $connection);
                                                    if (!$quer) {
                                                        die("Database select  fail" . mysql_error());
                                                    }
                                                    while ($row = mysql_fetch_array($quer)) {
                                                        $seat_id = $row['seat_id'];
                                                        $bus_ids = $row['bus_id'];
                                                        $dstart = $row['source'];
                                                        $ddest = $row['destination'];
                                                        $bus_no = $row['bus_no'];
                                                    }
                                                    $q = "";
                                                    $s2 = "";
                                                    $dd = date("Y-m-d");
                                                    $q_dash = "INSERT INTO `dashboard`(`user_id`, `bus_id`,`bus_no`, `source`, `destination`,`pdate`, `date`, `seat_name`,`taka`,`num`,`status`) "
                                                            . "VALUES ('$user_id','$bus_id','$bus_no','$dstart','$ddest','$dd','$jpurnet_date','$seats','$prices','$num_seat_search','Valid');";

                                                    switch ($num_seat_search) {
                                                        case 1:
                                                            $q = "INSERT INTO `reservation`( `user_id`, `bus_id`,`pay_id`,`seat_id`,`pdate`,`date`)"
                                                                    . " VALUES ('$user_id','$bus_id', '$pay_id','$seat_id','$dd',$jpurnet_date')";

                                                            break;
                                                        case 2:
                                                            $s2 = $_SESSION['seat_confrm1'];

                                                            $qu = "SELECT * FROM `bus` b,`seat` s where  b.`bus_id`='$bus_id'  AND b.`bus_id`=s.`bus_id` AND s.`seat_name`='$s2';";

                                                            $qu2 = mysql_query($qu, $connection);
                                                            while ($row6 = mysql_fetch_array($qu2)) {
                                                                $seat_id2 = $row6['seat_id'];
                                                                $bus_ids2 = $row6['bus_id'];
                                                            }
                                                            $q = "INSERT INTO `reservation`( `user_id`, `bus_id`,`pay_id`,`seat_id`,`pdate`, `date`)"
                                                                    . " VALUES ('$user_id','$bus_id', '$pay_id','$seat_id','$dd','$jpurnet_date'),"
                                                                    . "('$user_id','$bus_id', '$pay_id','$seat_id2','$dd','$jpurnet_date')";

                                                            break;
                                                        default:
                                                            break;
                                                    }
//                                                    echo 'Shafiur check ok';
                                                    $up_payment = "UPDATE `payment` SET `taka`='$update_taka'"
                                                            . "WHERE pay_id='$pay_id' AND `t_no`='$pay_tno'";
                                                    if (mysql_query($up_payment)) {
                                                        if (mysql_query($q) && mysql_query($q_dash)) {
                                                            header("Location:http://localhost/Ticket_reserved/print_ticket.php");
                                                        }
                                                    } else {
                                                        echo mysql_error();
                                                    }
                                                }
                                            } else {
//                                                header("Location:http://localhost/Ticket_reserved/index.php");
                                            }
                                        } else {
                                            $_SESSION['pay_false'] = "false";
                                            header("Location: http://localhost/Ticket_reserved/pay.php");
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
    </div>
</div>

<!-- Footer For Ticket reserved-->
<?php
include './includes/footer.php';
?>
</body>
</html>