
<?php
include 'includes/connection.php';
unset($_SESSION);
@session_start();
?>
<?php
if (isset($_POST['user_mail']) && isset($_POST['user_pwd'])) {
    $username = $_POST['user_mail'];
    $password = $_POST['user_pwd'];
    if (!empty($username) && !empty($password)) {
        //Query for log in
        $QueryLogIn = "select * from `registration` where `mail`='$username' AND `pass`='" . md5($password) . "';";
        $Result = mysql_query($QueryLogIn);
        if ($Result) {
            if (mysql_num_rows($Result) == 1) {
                $row = mysql_fetch_array($Result);
                $user_id = $row['user_id'];
                $type = $row['type'];
                echo $type;
                if ($type == 'user') {
                    extract($row);
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['type'] = $type;
                    ob_clean();
                    if (isset($_SESSION['seat_confrm'])) {
                        if (!empty($_SESSION['seat_confrm'])) {
                            header("Location: http://localhost/Ticket_reserved/pay.php");
                        }
                    } else {
                        header("Location: http://localhost/Ticket_reserved/user_document_page.php");
                    }
                } else {
                    echo 'hhh';
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
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="Stylesheet" href="css/Main_css.css" type="text/css"/>
        <link rel="Stylesheet" href="css/ad_user.css" type="text/css"/>
        <link rel="Stylesheet" href="css/quiz.css" type="text/css"/>
        <title>Log In</title>
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

                    <center>
                        <div style="" id="vasplus_programming_blog_wrapper" class=" bigEntrance">

                            <center><div class="" align="center" style="width:230px;min-height:20px; font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;"><img src="images/logo1.png" width="25%" height="20%"><br>CUSTOMER LOGIN</div></center>
                            <div class="vpb_lebels_info" align="left">&nbsp;</div> <span class="errors">
                                <?php
                                if (isset($_SESSION["regis_yes"])) {
                                    echo 'Thanks';
                                }
                                if (isset($found)) {
                                    echo "Invalid Username or Password";
                                }
                                ?>
                            </span><br clear="all"><br>

                            <form name="form1" method="post" action="http://localhost/Ticket_reserved/user_login.php" onSubmit="">
                                <div class="vpb_lebels" align="left">Email Id:</div>
                                <div class="vpb_lebels_fields" align="left"><input name="user_mail" type="text"  class="vasplus_blog_form_opt" placeholder="Enter Your Email Id"/></div><br clear="all">

                                <div class="vpb_lebels" align="left">Password:</div>
                                <div class="vpb_lebels_fields" align="left"><input name="user_pwd" type="password"  class="vasplus_blog_form_opt" placeholder="Enter Your Password"/></div><br clear="all">

                                <div style="width:200px;float:left;margin-left: 25%;margin-top: 5px;" align="center">
                                    <input name="submit" type="submit" class="ad_submit" id="submit" value="LOG IN"><br><br>
                                    <div align="left"><span class="style4">Not Register? <a href="http://localhost/Ticket_reserved/registration.php">Sign Up</a></span></div></div><br clear="all">

                            </form>
                    </center>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $('#vasplus_programming_blog_wrapper1').click(function() {
        $(this).addClass("expandOpen");
    });
</script>

<!-- Footer For Ticket reserved-->
<?php
include './includes/footer.php';
?>
</body>
</html>