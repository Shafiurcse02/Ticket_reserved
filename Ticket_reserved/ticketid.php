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
        <?php
        extract($_POST);
        include("./includes/connection.php");
        if (isset($_POST['tcktno'])) {

            $tm = $_POST['tcktno'];

            if (!empty($tm)) {

            }
        }
        ?>

        <!-- Main body For Ticket reserved-->
        <div id="mainBody">
            <div id="admin">
                <div id="ad_login">
                    <div id="stylized" class="myform">
                        <form name="form1" method="post" action="print_ticket.php" onSubmit="return check();">
                            <center><div class="" align="center" style="color:#33F; min-height:20px; font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">
                                    <br>
                                    <?php
                                    if (!empty($_SESSION['type'])) {
                                        if ($_SESSION['type'] == 'user') {
                                            echo 'Bus Ticket';
                                        }
                                    }
                                    ?>
                                </div>
                            </center>
                            <br>
                            <label> Enter Ticket No
                            </label>
                            <input type="text" name="tcktno"  id="name" maxlength="35" placeholder="Enter name"/><br>
                            <br>

                            <div>
<!--                                <a href="tickidfor.php" style="margin-left: 35%;">Forget Ticket No</a>-->
                                <button hidden="" type="reset">Reset</button>
                                <button style="margin-left: 40%;" type="submit">Get Ticket</button></div>
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