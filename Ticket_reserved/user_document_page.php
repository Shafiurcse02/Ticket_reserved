<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
@session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="Stylesheet" href="css/Main_css.css" type="text/css"/>
        <link rel="Stylesheet" href="css/ad_user.css" type="text/css"/>
        <link rel="Stylesheet" href="css/quiz.css" type="text/css"/>
        <title>user Document page </title>


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
//                    echo ' <h3>Yes ,success login </h3>';
                    if (isset($_SESSION['user_id'])) {
                        $id = $_SESSION['user_id'];
                        if (!empty($id)) {
//                            echo " SSS   ".$id;
                            $query = "SELECT * FROM `registration` where `user_id`='$id'";
                            $query1 = mysql_query($query);

                            if (!$query1) {
                                die("Database select fail" . mysql_error());
                            }
                            while ($row = mysql_fetch_array($query1)) {
                                echo '<table>
                        <tr>
                            <td>name </td>
                            <td>' . $row['name'] . '</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>' . $row['mail'] . '</td>
                        </tr>
                    </table>';
                            }
                        }
//                        echo $_SESSION['user_login'] . '  ' . $_SESSION['user_name'] . ' ' . $_SESSION['user_mail'];
                    }
                    ?> 
                    <a href="user_update.php">Edite</a> <a href="ticketid.php">tttt</a>
                    <a href="http://localhost/Ticket_reserved/tickidfor.php">Ticket Cancel</a>
                    <div>

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