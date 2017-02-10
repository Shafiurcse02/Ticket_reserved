<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
@session_start();
include './includes/connection.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="Stylesheet" href="css/Main_css.css" type="text/css"/>
        <link rel="Stylesheet" href="css/ad_user.css" type="text/css"/>
        <title>Contact </title>
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
            <div id="contact_body">

                <p class="design">&nbsp;</p>
                <div align="center" >
                    <form  action="contact.php" method="post">

                        <p class="design">&nbsp;</p>
                        <table>
                            <tr>
                                <th colspan="5" id="reg_blank1">&nbsp;</th>
                            </tr>
                            <tr>
                                <th colspan="5" id="ad_th">Ticket Reservation System</th>
                            </tr>
                            <tr>
                                <th colspan="5" id="ad_th1">" Contact Information "</th>
                            </tr>
<!--                             <tr>

                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td> &nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>-->
                            <tr>
                                <th colspan="5" id="confirmation_mess">
                                    <?php
                                    if (isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['description'])) {
                                        $email = $_POST['email'];
                                        $phone = $_POST['phone'];
                                        $description = $_POST['description'];
                                        if (!empty($phone) && !empty($email) && !empty($description)) {
                                            $sql = "INSERT INTO `contact`(`email`, `phone`, `description`) "
                                                    . "VALUES('$email','$phone','$description');";

                                            $test = mysql_query($sql) or die(mysql_error());
                                            if ($test) {
                                                echo "<h4>Successfully Delivered</h4>";
                                            } else {
                                                echo "<h4>Something went wrong</h4>";
                                            }
                                        }
                                    }
                                    ?>
                                </th>
                            </tr>

                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td>Email</td>
                                <td><p>:</p></td>
                                <td>&nbsp;</td>
                                <td><input type="text" name="email" value="" class="search_tex"
                                           onclick="if (value == '') {
                                                       value = '';
                                                   }" maxlength="23"/></td>

                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td>Contact No</td>
                                <td><p>:</p></td>
                                <td>&nbsp;</td>
                                <td>
                                    <input type="text" name="phone" title="APassword" value="" class="search_tex" 
                                           onclick="if (value == '') {
                                                       value = '';
                                                   }"  maxlength="15"/>
                                </td>
                            </tr>

                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                                <td>Description</td>
                                <td><p>:</p></td>
                                <td>&nbsp;</td>
                                <td>
                                    <input type="text" name="description" title="APassword" value="" class="search_tex" 
                                           onclick="if (value == '') {
                                                       value = '';
                                                   }"  maxlength="140"/>
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
                                    <input type="submit"  name="submit" value="submit" class="ad_submit" />
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
