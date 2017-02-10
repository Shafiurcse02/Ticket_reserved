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
        <title>Admin Page </title>
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
                <div id="ad_login">
                    <?php
                    extract($_POST);
                    include("./includes/connection.php");
                    $sql = "SELECT * from bus ";
                    $q = mysql_query($sql);
                    $count = mysql_num_rows($q);
                    if ($count > 0) {
                        echo '<table border="0"><tr><td colspan="2" id="admin_hd_1"></td></tr>'
                        . '<tr><td colspan="2" id="admin_hd_2"></td></tr>';
                        echo "<tr><td><h3>Source</h3></td><td><h3>Destination</h3></td></tr>";

                        while ($a = mysql_fetch_array($q)) {
                            echo "<tr>";

                            echo "<td>" . $a['source'] . "</td>";
                            echo "<td>" . $a['destination'] . "</td>";


                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                    ?> 

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
