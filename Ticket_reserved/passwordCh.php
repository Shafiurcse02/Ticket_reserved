<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    unset($_SESSION);
    header("Location:http://localhost/Ticket_reserved/registration.php");
}
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
                    if (isset($_POST['old_pwd']) && isset($_POST['new_pwd']) && isset($_POST['con_pwd']) && isset($_SESSION['user_id'])) {
                        $old_pwd = $_POST['old_pwd'];
                        $new_pwd = $_POST['new_pwd'];
                        $con_pwd = $_POST['con_pwd'];
                        $id = $_SESSION['user_id'];

                        if (!empty($old_pwd) && !empty($new_pwd) && !empty($id) && !empty($con_pwd) && $new_pwd == $con_pwd) {
                            //Query for log in
                            $QueryLogIn = "select * from `registration` where `user_id`='$id' AND `pass`='" . md5($old_pwd) . "'";
                            $Result = mysql_query($QueryLogIn);
                            if ($Result) {
                                if (mysql_num_rows($Result) == 1) {
                                    if ($new_pwd == $con_pwd) {
                                        $up_p = "UPDATE `registration` SET `pass`='" . md5($new_pwd) . "'"
                                                . "WHERE `user_id`='$id'";
                                        if (mysql_query($up_p)) {
                                            $_SESSION['passupdate'] = 'Password is updated';
                                        }
                                    } else {
                                        $_SESSION['passupdate'] = 'Password is not matched';
                                    }
                                }
                            } else {
                                echo mysql_error();
                            }
                        } 
                    } else {
                        $_SESSION['passupdate'] = 'Please insert correct password';
                    }
                    ?>
                    <form  action="passwordCh.php" method="post">

                        <p class="design">&nbsp;</p>
                        <table>
                            <tr>
                                <th colspan="5" id="ad_th">Ticket Reservation System</th>
                            </tr>
                            <tr>

                                <td colspan="5">
                                    <?php
                                    if (isset($_SESSION['passupdate'])) {
                                        if (!empty($_SESSION['passupdate'])) {
                                            echo $_SESSION['passupdate'];
                                            $_SESSION['passupdate'] = "";
                                        }
                                    } else {

                                        echo '&nbsp;';
                                    }
                                    ?>

                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td>Old Password</td>
                                <td><p>:</p></td>
                                <td>&nbsp;</td>
                                <td>
                                    <input type="password" name="old_pwd" title="APassword" class="search_tex" 
                                           placeholder="Oldpassword"  maxlength="15"/>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td>New Password</td>
                                <td><p>:</p></td>
                                <td>&nbsp;</td>
                                <td>
                                    <input type="password" name="new_pwd" title="APassword"  class="search_tex" 
                                           placeholder="New password" maxlength="15"/>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td>Confirm  Password</td>
                                <td><p>:</p></td>
                                <td>&nbsp;</td>
                                <td>
                                    <input type="password" name="con_pwd" title="APassword"  class="search_tex" 
                                           placeholder="Confirm password"  maxlength="15"/>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="2" id="ad_sub" >
                                    <input type="submit"  name="admin_submit" value="submit" class="ad_submit" /> 
                                <td colspan="2" id="ad_sub" >
                                    <input type="reset"   value="Reset" class="ad_submit" /></td>
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
