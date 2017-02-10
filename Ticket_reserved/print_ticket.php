<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="Stylesheet" href="css/Main_css.css" type="text/css"/>
        <link rel="Stylesheet" href="css/ad_user.css" type="text/css"/>
        <link rel="Stylesheet" href="css/reg.css" type="text/css"/>


        <script src="printing/jquery-1.9.0.js" type="text/JavaScript"
        language="javascript"></script>
        <script src="printing/jquery.PrintArea.js" type="text/JavaScript"
        language="javascript"></script>

        <link type="text/css" rel="stylesheet" href="printing/PrintArea.css" />


        <title>Registration </title>

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
                    <div >
                        <fieldset id="stylized" class="myform">
                            <legend id="legend">&nbsp;Bus TICKET&nbsp;
                            </legend>
                            <div class="PrintArea p1">

<!--                                <p>
                                    <span>About Purchase Info</span> :
                                </P>-->
                                <?php
                                include("./includes/connection.php");
                                $qu = "";
                                if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
                                    $user_id = $_SESSION['user_id'];
                                    if (isset($_POST['tcktno']) && !empty($_POST['tcktno'])) {
                                        $uu = $_POST['tcktno'];
                                        $qu = "SELECT * FROM `registration` r,`dashboard` d,`bus` b "
                                                . "where  r.`user_id`='$user_id'  AND r.`user_id`=d.`user_id` AND b.`bus_id`=d.`bus_id` AND d.`id`='$uu' AND d.status='valid';";
                                    } else {
                                        $qu = "SELECT * FROM `registration` r,`dashboard` d,`bus` b "
                                                . "where  r.`user_id`='$user_id'  AND r.`user_id`=d.`user_id` AND b.`bus_id`=d.`bus_id` AND d.status='valid';";
                                    }

                                    $query = mysql_query($qu, $connection);

                                    if (!$query) {
                                        die("Database select  fail" . mysql_error());
                                    }while ($row = mysql_fetch_array($query)) {
                                        echo '<label>Ticket NO </label><p id="name"> ' . $row['id'] . "</P>";
                                        echo '<label>Name </label><p id="name"> ' . $row['name'] . "</P>";
                                        echo '<label>Email ID</label><p> ' . $row['mail'] . "</P>";
                                        echo '<label>Email ID</label><p> ' . $row['mail'] . "</P>";
                                        echo '<label>Phone Number</label><p> ' . $row['phone'] . "</P>";
                                        echo '<label>Source </label><p> ' . $row['source'] . "</P>";
                                        echo '<label>Destination </label><p> ' . $row['destination'] . "</P>";
                                        echo '<label>Staring Time </label><p> ' . $row['time'] . "</P>";
                                        echo '<label>Ac/None AC </label><p> ' . $row['type'] . "</P>";
                                        echo '<label>Journey Date </label><p> ' . $row['date'] . "</P>";
                                        echo '<label>per Seat price </label><p> ' . $row['price'] . "</P>";
                                        echo '<label>Number of Seats </label><p> ' . $row['num'] . "</P>";
                                        if (isset($_SESSION['seats']) && !empty($_SESSION['seats'])) {
                                            echo '<label>Seats No </label><p> ' . $_SESSION['seats'] . "</P>";
                                        }

                                        echo '<label>Total Seat price </label><p> ' . $row['taka'] . "</P><br>";
                                    }
                                }
                                ?><div class="button b1">Print</div>
                            </div>


                            <script>
                                $(document).ready(function() {
                                    $("div.b1").click(function() {

                                        var mode = $("input[name='mode']:checked").val();
                                        var close = mode == "popup" && $("input#closePop").is(":checked")

                                        var options = {mode: mode, popClose: close};

                                        $("div.PrintArea.p1").printArea(options);
                                    });

                                    $("input[name='mode']").click(function() {
                                        if ($(this).val() == "iframe")
                                            $("#closePop").attr("checked", false);
                                    });
                                });

                            </script>
                        </fieldset>

                    </div><br>
                </div>
            </div>
        </div>

        <!-- Footer For Ticket reserved-->
        <?php
        include './includes/footer.php';
        ?>
    </body>
</html>