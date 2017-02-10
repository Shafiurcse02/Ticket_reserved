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
        <title>Registration </title>
        <script language="javascript">
            function check()
            {
            var mailp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+[a-zA-Z0-9]+{2,3}$/;
//                   
//                    var maill = document.forms["form1"]["mail"].value;
                    if (document.form1.name.value == "")
            {
            alert("Please Enter Your Name");
                    document.form1.name.focus();
                    return false;
            }

            if (document.form1.email.value == "")
            {
            alert("Please Enter valid Email Id");
                    document.form1.email.focus();
                    return false;
            }

            if (document.form1.pass.value != document.form1.cpass.value)
            {
            alert("Confirm Password does not matched");
                    document.form1.cpass.focus();
                    return false;
            }

            if (document.form1.gender.value == "")
            {
            alert("Please Select your Gender");
                    document.form1.gender.focus();
                    return false;
            }
            if (document.form1.address.value == "")
            {
            alert("Please Enter Address");
                    document.form1.address.focus();
                    return false;
            }
            if (document.form1.phone.value == "")
            {
            alert("Plese Enter Mobile Number");
                    document.form1.phone.focus();
                    return false;
            }
            return true;
            }

        </script>

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
        <?php
//        extract($_POST);
        include("./includes/connection.php");


        if (isset($_SESSION['user_id'])&&isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['gender']) && isset($_POST['email'])) {
            $username = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $address = $_POST['address'];
            $user_id=$_SESSION['user_id'];
            if (!empty($user_id) &&!empty($username) && !empty($phone) && !empty($gender) && !empty($email) && !empty($address)) {
                echo $_SESSION['user_id'];
                $q1="UPDATE `registration` SET `name`='$username',`mail`='$email',,"
                        . "`phone`='$phone',`gender`='$gender',`address`='$address' WHERE `user_id`='$user_id' AND `mail`='$email';";
                if (mysql_query($q1)) {
//                    echo 'Thank you for registering';
                    if (!empty($_SESSION['type'])) {
                        if ($_SESSION['type'] == 'admin')
                            header("Location:http://localhost/Ticket_reserved/admin__bus_insert.php");
                        if ($_SESSION['type'] == 'user') {
                            header("Location:http://localhost/Ticket_reserved/user_document_page.php");
                        }
                    }else {
                        header("Location:http://localhost/Ticket_reserved/index.php");
                    }
                } else {
                    echo mysql_error();
                }
            }
        }
        ?>

        <!-- Main body For Ticket reserved-->
        <div id="mainBody">
            <div id="admin">
                <div id="ad_login">
                    <center>
                        <div style="" id="vasplus_programming_blog_wrapper" class=" bigEntrance">

                            <center><div class="" align="center" style="width:230px;min-height:20px; font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">
                                    <img src="images/logo1.png" width="25%" height="20%"><br>update</div></center>

                            <div class="vpb_lebels_info" align="left">&nbsp;</div> <span class="errors">
                                <?php
                                if (isset($_SESSION['user_id'])) {
                                    if (!empty($_SESSION['user_id'])) {
                                        $nm = $_SESSION['user_id'];
                                        $Que = "select * from `registration` where `user_id`=$nm";
                                        $Result = mysql_query($Que);
                                        while ($row2 = mysql_fetch_array($Result)) {
                                            $n = $row2['name'];
                                            $m = $row2['mail'];
                                            $g = $row2['gender'];
                                            $add = $row2['address'];
                                            $p = $row2['phone'];
                                        }
                                    }
                                }





                                if (isset($found)) {
                                    echo "Invalid Username or Password";
                                }
                                ?>
                            </span><br clear="all"><br>

                            <form name="form1" method="post" action="user_update.php" onSubmit="return check();">
                                <div class="vpb_lebels" align="left"><p>Name:</p></div>
                                <div class="vpb_lebels_fields" align="left"><input name="name" id="name"  type="text" 
                                                                                   class="vasplus_blog_form_opt" value=<?php
                                                                                   if (isset($n)) {

                                                                                       echo $n;
                                                                                   }
                                                                                   ?>/></div><br clear="all">


                                <div class="vpb_lebels" align="left">Email ID:</div>
                                <div class="vpb_lebels_fields" align="left">
                                    <input name="email" type="text"  class="vasplus_blog_form_opt" id="mail" value=
                                    <?php
                                    if (isset($m)) {

                                        echo $m;
                                    }
                                    ?> /></div><br clear="all">

                                <div class="vpb_lebels" align="left">Gender:</div>
                                <div class="vpb_lebels_fields" align="left">
                                    <select name="gender" class="vasplus_blog_form_opt">
                                        <option class="vasplus_blog_form_opt">Male</option>
                                        <option class="vasplus_blog_form_opt">Female</option>
                                    </select>
                                </div>
                                <br clear="all">

                                <div class="vpb_lebels" align="left">Address :</div>
                                <div class="vpb_lebels_fields" align="left">
                                    <input name="address" id="address"  type="text" 
                                           class="vasplus_blog_form_opt" value=
                                           <?php
                                           if (isset($add)) {

                                               echo $add;
                                           }
                                           ?>
                                           /></div><br clear="all">


                                <div class="vpb_lebels" align="left">Mobile Number:</div>
                                <div class="vpb_lebels_fields" align="left"><input name="phone" id="phone" type="text"  class="vasplus_blog_form_opt" value=<?php
                                    if (isset($p)) {

                                        echo $p;
                                    }
                                    ?>
                                                                                   /></div><br clear="all">
                                <div class="vpb_lebels" align="left">&nbsp;</div>
                                <div style="width:300px;float:left;" align="center">
                                    <input name="submit" type="submit" class="send_btn" id="submit" value="update"><br><br>

                                </div>
                            </form>
                    </center>
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