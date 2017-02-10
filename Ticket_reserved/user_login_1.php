<?php
session_start();
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
        include './includes/Main_header.php';
        include("database.php");
        extract($_POST);
        extract($_GET);
        extract($_SESSION);

        if (isset($submit)) {
            $rs = mysql_query("select * registration where email='$email' and pass='$pass'");
            if (mysql_num_rows($rs) < 1) {
                $found = "N";
            } else {
                $_SESSION[email] = $email;
            }
        }
        if (isset($_SESSION[email])) {
            echo "<h4 class='style8' align=center class='hatch'>Welcome to PUC 2 Online Mock Tests</h4>";
            ?>
            <table border=1 align=center class="fadeIn"><tr background="image/b2.jpg" class=style2>
                <tr>
                    <td width=300 align=center><p class="style7"><img src="image/HLPBUTT2.JPG" halign="center"><a href="sublist.php"><br>Mock Tests</a></p>
                    <td width=300 align=center><p class="style7"><img src="image/DEGREE.JPG" halign="center"><a href="result.php"><br>Result</a></p>
                </tr>
                <tr>
                    <td width=300 align=center><p class="style7"><img src="image/students.png" halign="center"><a href="#"><br>Profile</a></p>
                    <td width=300 align=center><p class="style7"><img src="image/logout.png" halign="center"><a href="signout.php"><br><?php echo $login ?> Logout</a></p>
                </tr>
            </table>


            <div  style="position:absolute;width:100%;bottom:0px;height:15;">
                <?php include './includes/footer.php';
                ?>
            </div>
            <?php
            exit;
        }
        ?>

        <!-- Main body For Ticket reserved-->
        <div id="mainBody">
            <div id="admin">
                <div id="ad_login">

                    <center>
                        <div style="" id="vasplus_programming_blog_wrapper" class=" bigEntrance">

                            <center><div class="" align="center" style="width:230px;min-height:20px; font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;"><img src="image/students.png"><br>CUSTOMER LOGIN</div></center>
                            <div class="vpb_lebels_info" align="left">&nbsp;</div> <span class="errors">
                                <?php
                                if (isset($found)) {
                                    echo "Invalid Username or Password";
                                }
                                ?>
                            </span><br clear="all"><br>

                            <form name="form1" method="post" action="" onSubmit="">
                                <div class="vpb_lebels" align="left">Email Id:</div>
                                <div class="vpb_lebels_fields" align="left"><input name="email" type="text"  class="vasplus_blog_form_opt" placeholder="Enter Your Email Id"/></div><br clear="all">

                                <div class="vpb_lebels" align="left">Password:</div>
                                <div class="vpb_lebels_fields" align="left"><input name="pass" type="password"  class="vasplus_blog_form_opt" placeholder="Enter Your Password"/></div><br clear="all">


                                <div class="vpb_lebels" align="left">&nbsp;</div>
                                <div style="width:300px;float:left;" align="center">
                                    <input name="submit" type="submit" class="send_btn" id="submit" value="LOG IN"><br><br>
                                    <div align="center"><span class="style4">Not Register? <a href="http://localhost/Ticket_reserved/registration.php">Sign Up</a></span></div></div><br clear="all">

                            </form>
                    </center>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $('#vasplus_programming_blog_wrapper1').click(function () {
        $(this).addClass("expandOpen");
    });
</script>

<!-- Footer For Ticket reserved-->
<?php
include './includes/footer.php';
?>
</body>
</html>