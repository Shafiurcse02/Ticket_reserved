<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<script type="text/javascript">


    function makeTwoChars(inp) {
        return String(inp).length < 2 ? "0" + inp : inp;
    }

    function initialiseInputs() {
        // Clear any old values from the inputs (that might be cached by the browser after a page reload)
        document.getElementById("sd").value = "";
        document.getElementById("ed").value = "";

        // Add the onchange event handler to the start date input
        datePickerController.addEvent(document.getElementById("sd"), "change", setReservationDates);
    }

    var initAttempts = 0;

    function setReservationDates(e) {
        // Internet Explorer will not have created the datePickers yet so we poll the datePickerController Object using a setTimeout
        // until they become available (a maximum of ten times in case something has gone horribly wrong)

        try {
            var sd = datePickerController.getDatePicker("sd");
            var ed = datePickerController.getDatePicker("ed");
        } catch (err) {
            if (initAttempts++ < 10)
                setTimeout("setReservationDates()", 50);
            return;
        }

        // Check the value of the input is a date of the correct format
        var dt = datePickerController.dateFormat(this.value, sd.format.charAt(0) == "m");

        // If the input's value cannot be parsed as a valid date then return
        if (dt == 0)
            return;

        // At this stage we have a valid YYYYMMDD date

        // Grab the value set within the endDate input and parse it using the dateFormat method
        // N.B: The second parameter to the dateFormat function, if TRUE, tells the function to favour the m-d-y date format
        var edv = datePickerController.dateFormat(document.getElementById("ed").value, ed.format.charAt(0) == "m");

        // Set the low range of the second datePicker to be the date parsed from the first
        ed.setRangeLow(dt);

        // If theres a value already present within the end date input and it's smaller than the start date
        // then clear the end date value
        if (edv < dt) {
            document.getElementById("ed").value = "";
        }
    }

    function removeInputEvents() {
        // Remove the onchange event handler set within the function initialiseInputs
        datePickerController.removeEvent(document.getElementById("sd"), "change", setReservationDates);
    }

    datePickerController.addEvent(window, 'load', initialiseInputs);
    datePickerController.addEvent(window, 'unload', removeInputEvents);

    //]]>
</script>
<?php
session_start();
$user_id = "";
if (!isset($_SESSION['user_id'])) {
    unset($_SESSION);
    header("Location:http://localhost/Ticket_reserved/registration.php");
} elseif (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="Stylesheet" href="css/Main_css.css" type="text/css"/>
        <link rel="Stylesheet" href="css/ad_user.css" type="text/css"/>
        <link href="css/datepicker.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/datepicker.js"></script>
        <link rel="Stylesheet" href="css/reg.css" type="text/css"/>
        <title>Ticket by ticket No </title>
    </head>
    <body>

        <!-- Heaer For Ticket reserved-->
        <?php
        if (isset($_SESSION['type'])) {
            if (!empty($_SESSION['type']) && $_SESSION['type'] != NULL) {

                if ($_SESSION['type'] == 'user') {
                    include './includes/user_header.php';
                } if ($_SESSION['type'] == 'admin') {
                    include './includes/admin_header.php';
                }
            }
        } else {
            $_SESSION['type'] = NULL;
            include './includes/Main_header.php';
        }
        include_once './includes/connection.php';
        ?>


        <!-- Main body For Ticket reserved-->
        <div id="mainBody">
            <div id="admin">
                <div id="ad_login">
                    <div id="stylized" class="myform">
                        <form name="form1" method="post" action="tickidfor.php" onSubmit="return check();">
                            <center><div class="" align="center" style="color:#33F; min-height:20px; font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">
                                    <br>
                                    <?php
                                    if (!empty($_SESSION['type'])) {
                                        if ($_SESSION['type'] == 'user') {
                                            echo 'Bus Ticket<br>';
                                        }
                                    }
                                    ?> </div>

                                <?php
                                extract($_POST);
                                include("./includes/connection.php");
                                if (isset($_POST['bno']) && isset($_POST['tno']) && isset($_POST['jdate'])) {

                                    $tno = $_POST['tno'];
                                    $jdt = $_POST['jdate'];
                                    $bno = $_POST['bno'];
                                    $bno1 = "";


//                                     $QueryL = "select id from `registration` r1,`reservation` r,`dashboard` d,`payment` p"
//                                                . " where r1.`user_id`='$user_id' AND r.`user_id`=r1.`user_id` AND r.`user_id`=d.`user_id` AND r.`pay_id`=p.`pay_id` AND p.`t_no`='$bid';";
////                                        
//                                    echo $user_id;
                                    if (!empty($tno) && !empty($jdt) && !empty($bno)) {
//                                       

                                        $jdt = str_replace('/', '-', $jdt);
                                        $jpurnet_date = date('Y-m-d', strtotime($jdt));

                                        $s = "select * from `bus` where `bus_no`='$bno';";
                                        $rq = mysql_query($s);
                                        if ($rq) {
                                            if (mysql_num_rows($rq) == 1) {
                                                $row = mysql_fetch_array($rq);
                                                $bno1 = $row['bus_id'];
                                            } else {
                                                $_SESSION['can_error'] = "Invalid bus No";
                                                echo $_SESSION['can_error'];
                                                $_SESSION['can_error'] = "";
//                                                header("Location:http://localhost/Ticket_reserved/tickidfor.php");
                                            }
                                        }


                                        $QueryL = "SELECT * FROM `registration` r,`reservation`  r1,`dashboard`"
                                                . "where r.user_id='$user_id' AND `id`='$tno' AND r.user_id=`dashboard`.user_id AND "
                                                . "r1.date='$jpurnet_date' AND r1.user_id=r.user_id AND r1.bus_id='$bno1' AND status='valid'"
                                                . ";";
                                        $t_id = "";
                                        $t_takaback = "";
                                        $d_id = "";
                                        $Resul = mysql_query($QueryL);
                                        if ($Resul) {
                                            while ($row1 = mysql_fetch_array($Resul)) {
                                                echo 'fgfgfgfgf';
                                                $_SESSION['t_id'] = $row1['pay_id'];
                                                $t_id = $row1['pay_id'];
                                                $t_takaback = $row1['taka'];
                                                $d_id = $row1['id'];
                                            }
                                            $d = "DELETE FROM `reservation` WHERE "
                                                    . "user_id='$user_id' AND bus_id='$bno1' AND date='$jpurnet_date';";
                                            $tns = "UPDATE `payment` SET `taka`='$t_takaback' WHERE `pay_id`='$t_id';";
                                            $das = "UPDATE `dashboard` SET `status`='Invalid' WHERE id='$d_id';";

                                            if ($d_id == $tno) {
                                                if (mysql_query($tns) && mysql_query($das) && mysql_query($d)) {
                                                    $_SESSION['cancel'] = "Ticket has been cancelled";
                                                    echo 'Ticket has been cancelled';
//                                                    header("Location:http://localhost/Ticket_reserved/dashboard.php");
                                                } else {
                                                    echo mysql_error();
                                                }
                                            }
                                        }
                                    } else {
                                        echo 'Interted Corrected Information';
                                    }
                                }
                                ?>

                            </center>
                            <br>
                            <label> Enter Ticket No
                            </label>
                            <input type="text" name="tno"  id="name" maxlength="35" placeholder="Ticket  no"/><br>
                            <br><label> Journey Date
                            </label>
                            <input type="date" class="w8em format-d-m-y highlight-days-67 range-low-today" name="jdate" id="sd" placeholder="journey Date" maxlength="10" readonly="readonly" />
                            <br>
                            <label> Enter bus No
                            </label>
                            <input type="text" name="bno"  id="name" maxlength="35" placeholder="Bus no"/><br>
                            <br>
                            <div></a> <button hidden="" type="reset">Reset</button>
                                <button style="margin-left: 40%;"type="submit">Get Ticket No</button></div>
                            <br>
                        </form></div>  
                </div><br><br>
            </div>

        </div>

        <!-- Footer For Ticket reserved-->
        <?php
        include './includes/footer.php';
        ?>
    </body>
</html>