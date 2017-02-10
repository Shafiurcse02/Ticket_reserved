<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
include './includes/connection.php';
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
        include './includes/Main_header.php';
        ?>

        <!-- Main body For Ticket reserved-->
        <div id="mainBody">
            <div id="admin">
                <div id="ad_login">
                    <?php
                    if (isset($_POST['admin_name']) && isset($_POST['admin_pwd'])) {
                        $username = $_POST['admin_name'];
                        $password = $_POST['admin_pwd'];
                        if (!empty($username) && !empty($password)) {
                            //Query for log in
                            $QueryLogIn = "select * from `registration` where `mail`='$username' AND `pass`='".md5($password)."'";
                            $Result = mysql_query($QueryLogIn);
                            if ($Result) {
                                if (mysql_num_rows($Result) == 1) {
                                    $row = mysql_fetch_array($Result);
                                    $user_id = $row['user_id'];
                                    $type = $row['type'];
                                    echo $type;
                                    if ($type == 'admin') {
                                        extract($row);
                                        $_SESSION['user_id'] = $user_id;
                                        $_SESSION['type'] = $type;
                                        ob_clean();
                                        header("Location:http://localhost/Ticket_reserved/admin__bus_insert.php");
                                    } else {
                                        extract($row);
                                        $_SESSION['user_id'] = $user_id;
                                        $_SESSION['type'] = NULL;
                                        ob_clean();
                                        header("Location:http://localhost/Ticket_reserved/user_login.php");
                                    }
                                }
                            } else {
                                echo mysql_error();
                            }
                        }
                    }
                    ?>
                    <form  action="admin_login.php" method="post">

                        <p class="design">&nbsp;</p>
                        <table>
                            <tr>
                                <th colspan="5" id="reg_blank1">&nbsp;</th>
                            </tr>
                            <tr>
                                <th colspan="5" id="ad_th">Ticket Reservation System</th>
                            </tr>
                            <tr>
                                <th colspan="5" id="ad_th1">" Administrator Panel "</th>

                            </tr>
                            <tr>

                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td> &nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td>Admin Name</td>
                                <td><p>:</p></td>
                                <td>&nbsp;</td>
                                <td><input type="text" name="admin_name" value="Username" class="search_tex"
                                           onclick="if (value == 'Username') {
                                                       value = '';
                                                   }" maxlength="23"/></td>

                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td>Admin Password</td>
                                <td><p>:</p></td>
                                <td>&nbsp;</td>
                                <td>
                                    <input type="password" name="admin_pwd" title="APassword" value="Password" class="search_tex" 
                                           onclick="if (value == 'Password') {
                                                       value = '';
                                                   }"  maxlength="15"/>
                                </td>
                            </tr>
<!--                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>-->
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td colspan="4" id="ad_sub" >
                                    <input type="submit"  name="admin_submit" value="submit" class="ad_submit" />
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </form>
                </div>

            </div>
        </div>

        <!-- Footer For Ticket reserved-->
        <?php
        include './includes/footer.php';
        ?>
    </body>
</html>
