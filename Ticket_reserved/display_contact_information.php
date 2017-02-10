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
                    $sql = "SELECT * from contact ";
                    $q = mysql_query($sql);
                    $count = mysql_num_rows($q);
                    if ($count > 0) {
                        echo '<table border="0"><tr><td colspan="2" id="admin_hd_1"></td></tr>'
                        . '<tr><td colspan="2" id="admin_hd_2"></td></tr>';
                        echo "<tr><td><h3>Id</h3></td><td><h3>Email</h3></td><td><h3>Contact no</h3></td><td><h3>Description</h3></td></tr>";
                        $i = 1;
                        while ($a = mysql_fetch_array($q)) {
                            echo "<tr>";
                            echo "<td>" . $i . "</td>";
                            echo "<td>" . $a['email'] . "</td>";
                            echo "<td>" . $a['phone'] . "</td>";

                            echo "<td>" . $a['description'] . "</td>";
                            echo "</tr>";

                            $i++;
                        }
                        echo "</table>";
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
