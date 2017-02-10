<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
include './includes/connection.php';
if (isset($_SESSION['num']) && !empty($_SESSION['num'])) {
    $num_seat_search = $_SESSION['num'];
    if ($num_seat_search == 1 && isset($_POST['seat_confrm'])) {
        $_SESSION['seat_confrm'] = $_POST['seat_confrm'];
    } elseif ($num_seat_search == 2) {
        if (isset($_POST['seat_confrm']) && isset($_POST['seat_confrm1'])) {
            $_SESSION['seat_confrm'] = $_POST['seat_confrm'];
            $_SESSION['seat_confrm1'] = $_POST['seat_confrm1'];
            if ($_SESSION['seat_confrm'] == $_SESSION['seat_confrm1']) {
                $_SESSION['ceck_d'] = "yes";
                header("Location:http://localhost/Ticket_reserved/display_search_result.php");
            }
        } else {
            header("Location:http://localhost/Ticket_reserved/index.php");
        }
    }
} else {
    $num_seat_search = 0;
}
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
        <script type="text/javascript" src="js/datepicker.js"></script>
        <link href="css/datepicker.css" rel="stylesheet" type="text/css" />
        <link rel="Stylesheet" href="css/Main_css.css" type="text/css"/>
        <title>Bus</title>
        <script>

            function get_result()
            {
                document.getElementById("output_fare").innerHTML = "hghghgh";


            }
            function busFrom() {
                var i_date = document.forms["fare_form"]["journey_date"].value;
                if (i_date < > null)
                {
                    document.getElementById("from").innerHTML = " <select class='fare_input' id='qselecT2' name='from' onclick='busFrom()'" >
                            "<option value='0'>===NONE===</option>"
                    "<option value='1'>1</option>"
                    "</select>";
                }

            }



        </script>
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

        <div id="mainBody">
            <div id="fareLeft">
                <!--<div id="Search_div">Online Search</div>-->
                <div id="search_content">
                    <form action="http://localhost/Ticket_reserved/booking_done.php" method="POST" name="fare_form" accept-charset='UTF-8'>
                        <fieldset>
                            <legend>&nbsp;Payment &nbsp;</legend>
                            <table id="">
                                <tr><td>&nbsp;</td>
                                    <td colspan="4">
                                        <?php
                                        if (isset($_SESSION['pay_false'])) {
                                            if ($_SESSION['pay_false'] == 'false') {
                                                echo 'Please Inserted correct transaction ID';
                                                $_SESSION['pay_false'] = NULL;
                                            }
                                        }
                                        ?>


                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div>
                                            Select Method</div></td>
                                    <td>:</td>
                                    <td>
                                        <div>
                                            <select class="fare_input"  name="pay_method" id="qselecT1">
                                                <option value="null">===SELECT method===</option>
                                                <option value="bcash">B-cash</option>
                                                <option value="card">Visha Card</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div>
                                            Enter T-no</div></td>
                                    <td>:</td>
                                    <td>
                                        <div>
                                            <input type="text" name="tno"
                                                   tabindex="7" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div align="center"> 
                              <!--<input type="submit" name="show_fare" value="Show Fare" id="button1" tabindex="4" />-->
                                <input type="submit" name="Confirm" value="Confirm"
                                       tabindex="7"  />
                            </div>
                        </fieldset>
                    </form>

                </div>



            </div>
            <div id="fare_right">
                <fieldset>
                    <legend>Searching Result</legend>
                    <center>
                        <div class="" align="center" style="width:100%;min-height:20px; font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">
                            <br>
                            <?php
//                            extract($_POST);
                            include("./includes/connection.php");
                            $seat = "";
                            $seat1 = "";
                            if (isset($_SESSION['bus_id']) && $_SESSION['bus_id'] != NULL && isset($_SESSION['date']) && isset($_SESSION['price']) && isset($_SESSION['seat_confrm'])) {
                                $bus_id = $_SESSION['bus_id'];
                                $jpurnet_date = date("Y-m-d", strtotime($_SESSION['date']));
                                $price = $_SESSION['price'];
                                if ($num_seat_search == 1) {
                                    $seat = $_SESSION['seat_confrm'];
                                } elseif ($num_seat_search == 2) {
                                    $seat = $_SESSION['seat_confrm'];
                                    $seat1 = $_SESSION['seat_confrm1'];
                                }

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
                                        if ($num_seat_search == 1) {
                                            $seat = $_SESSION['seat_confrm'];
                                            echo "<tr><td>&nbsp;</td><td>Seat No </td><td>:&nbsp;</td> <td>"
                                            . $seat . "</td></tr>";
                                            $_SESSION['seats'] = $seat;
                                        } elseif ($num_seat_search == 2) {
                                            $seat = $_SESSION['seat_confrm'];
                                            $seat1 = $_SESSION['seat_confrm1'];
                                            echo "<tr><td>&nbsp;</td><td>Seat No </td><td>:&nbsp;</td> <td>"
                                            . $seat . "," . $seat1 . "</td></tr>";
                                            $_SESSION['seats'] = $seat . "," . $seat1;
                                        }

                                        if ($num_seat_search == 1) {
                                            echo "<tr><td>&nbsp;</td><td>per Seat price  </td><td>:&nbsp;</td> <td>"
                                            . $row['price'] . "</td></tr>";
                                        } elseif ($num_seat_search == 2) {
                                            echo "<tr><td>&nbsp;</td><td>per Seat price  </td><td>:&nbsp;</td> <td>"
                                            . $row['price'] . "</td></tr>";
                                            echo "<tr><td>&nbsp;</td><td>total Seat price  </td><td>:&nbsp;</td> <td>"
                                            . 2 * $row['price'] . "</td></tr>";
                                            $_SESSION['price'] = 2 * $row['price'];
                                        }

                                        echo "<tr><td>&nbsp;</td><td> </td><td>&nbsp;</td> <td>
                                         </td></tr>";
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
                </fieldset>
            </div>
        </div>

        <!-- Footer For Ticket reserved-->
        <?php
        include './includes/footer.php';
        ?>
    </body>
</html>
