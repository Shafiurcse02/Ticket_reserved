<?php
session_start();
$ID = $_SESSION['user_id'];
$type = $_SESSION['type'];
if ($type != 'admin') {
    $_SESSION['type'] = NULL;
    header("Location: http://localhost/Ticket_reserved/index.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="Stylesheet" href="css/Main_css.css" type="text/css"/>
        <link rel="Stylesheet" href="css/ad_user.css" type="text/css"/>
        <title>Admin Page </title>
    </head>
    <body>

        <!-- Heaer For Ticket reserved-->
        <?php
        if (isset($_SESSION['type'])) {
            if (!empty($_SESSION['type']) && $_SESSION['type'] != NULL) {

                if ($_SESSION['type'] == 'user') {
                    header("Location:localhost/Ticket_reserved/user_document_page.php");
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

                    <form action="admin__bus_insert.php" method="POST">
                        <table id="">
                            <tr>
                                <td colspan="3" id="admin_hd_1">Ticket Reservation System</td>
                            </tr>
                            <tr>
                                <td colspan="3" id="admin_hd_2">Bus Insertion</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">

                                    <?php
                                    /* Inser bus  */
                                    if ( isset($_SESSION['user_id'])) {
//                                        echo  $_SESSION['user_id']. ' Ss';
}
                                    if (isset($_POST['admin_bus_no']) && isset($_POST['admin_bus_source']) && isset($_POST['admin_bus_dest']) && isset($_POST['admin_bus_seatNo']) && isset($_POST['admin_bus_type']) && isset($_POST['admin_bus_time']) &&
                                            isset($_POST['admin_bus_rate'])) {
                                        $admin_bus_no = $_POST['admin_bus_no'];
                                        $admin_bus_source = $_POST['admin_bus_source'];
                                        $admin_bus_dest = $_POST['admin_bus_dest'];
                                        $admin_bus_seatNo = $_POST['admin_bus_seatNo'];
                                        $admin_bus_type = $_POST['admin_bus_type'];
                                        $admin_bus_time = $_POST['admin_bus_time'];
                                        $admin_bus_rate = $_POST['admin_bus_rate'];
                                        if (!empty($admin_bus_no) && !empty($admin_bus_source) && !empty($admin_bus_dest) && !empty($admin_bus_seatNo) &&
                                                !empty($admin_bus_type) && !empty($admin_bus_time) && !empty($admin_bus_rate)) {
                                            $query = mysql_query("SELECT * FROM `bus` WHERE `bus_no`='$admin_bus_no'");
                                            if ($query) {
                                                while ($row = mysql_fetch_array($query)) {
                                                    if ($row['bus_no'] == $admin_bus_no) {
                                                        $_SESSION['double_bus'] = 'yes';
//                                                        unset($_SESSION['double_bus']);
                                                        ob_clean();
                                                        header("Location:http://localhost/Ticket_reserved/admin__bus_insert.php");
                                                        exit();
                                                    }$_SESSION['double_bus'] = 'no';
                                                }
                                            }
                                            $_SESSION['double_bus'] = 'no';
                                            $admin_room_insert_quiry_bus = mysql_query("INSERT INTO `bus_ticket`.`bus` "
                                                    . "(`bus_no`, `source`, `destination`, `total_seat`, `type`, `price`, `time`) "
                                                    . "VALUES  ('$admin_bus_no','$admin_bus_source','$admin_bus_dest','$admin_bus_seatNo','$admin_bus_type','$admin_bus_rate','$admin_bus_time')");

                                            if ($admin_room_insert_quiry_bus)
                                                echo '<p id="status_bus">' . 'Insert the Bus No :<p/><p id="bus_view">' . $admin_bus_no . '<p/><br/>';
                                            else {
                                                echo 'Sorry to insertion room' . mysql_error();
                                            }
                                        }
                                    } else {
                                        if (isset($_SESSION['double_bus'])) {
                                            if (($_SESSION['double_bus']) != 'no') {
                                                echo '<p id="status_bus">' . 'bus already has been inserted' . '<p/>';
                                            }
                                        }
                                    }
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><img src="" width="60" height="16">Bus No</td>
                                <td><input type="text" name="admin_bus_no" maxlength="9" /></td>
                            </tr><tr>
                                <td>&nbsp;</td>
                                <td><img src="" width="60" height="16">Source</td>
                                <td><input type="text" name="admin_bus_source" maxlength="9" /></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><img src="" width="60" height="16">Destination</td>
                                <td><input type="text" name="admin_bus_dest" maxlength="9" /></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><img src="" width="60" height="16">total seat</td>
                                <td><input type="text" name="admin_bus_seatNo" maxlength="3" /></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td> <img src="" width="100" height="16">Type</td>
                                <td>
                                    <select name="admin_bus_type">
                                        <option value="AC">AC</option>
                                        <option value="Non_AC">Non AC</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><img src="" width="60" height="16">time</td>
                                <td><input type="text" name="admin_bus_time" maxlength="3" /></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><img src="" width="60" height="16">Price</td>
                                <td><input type="text" name="admin_bus_rate" maxlength="8" /></td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div id="ad_submit">
                                        <input type="reset" value="reset">
                                        <input type="submit" title="insert Bus" value=" Press ">

                                    </div>
                            </tr>
                        </table>
                    </form>

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
