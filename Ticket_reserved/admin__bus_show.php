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
                <div id="admin_bus_show_div">



                    <?php
                    extract($_POST);
                    include("./includes/connection.php");
                    $query = mysql_query("SELECT * FROM `bus`");
                    if ($query) {
                        echo '<table border="0"><tr><td colspan="2" id="admin_hd_1">Ticket Reservation System</td></tr>'
                        . '<tr><td colspan="2" id="admin_hd_2">all bus</td></tr>';
                        while ($row = mysql_fetch_array($query)) {

                            echo ' <tr>
                            <td <td colspan="2" id="show_bus_no">' . $row['bus_no'] . '</td>
                        </tr>
                        <tr>
                            <td>Rout</td>
                            <td>From ' . $row['source'] . ' to ' . $row['destination'] . '</td>
                        </tr><tr>
                            <td>Total Seat</td>
                            <td>' . $row['total_seat'] . '</td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td>' . $row['type'] . '</td>
                        </tr>
                        ';
                        }
                        echo '</table>';
                    }
                    ?> 



                    <!--                    </form>-->

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
