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
        <link rel="Stylesheet" href="css/reg.css" type="text/css"/>
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

            if (document.form1.pass.value == "")
            {
            alert("Please Enter Your Password");
                    document.form1.pass.focus();
                    return false;
            }
            if (document.form1.cpass.value == "")
            {
            alert("Please Enter Confirm Password");
                    document.form1.cpass.focus();
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
        if (isset($_SESSION['type'])) {
            if (!empty($_SESSION['type']) && $_SESSION['type'] != NULL) {

                if ($_SESSION['type'] == 'user') {
                    include './includes/user_header.php';
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
        <?php
        extract($_POST);
        include("./includes/connection.php");
        if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['gender']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['cpass'])) {

            $username = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $address = $_POST['address'];
            $password = $_POST['pass'];
            $confirm = $_POST['cpass'];

            if (!empty($username) && !empty($phone) && !empty($gender) && !empty($email) && !empty($password) && !empty($confirm)) {

                if ($password == $confirm) {
                    if (!empty($_SESSION['type'])) {
                        if ($_SESSION['type'] == 'admin') {
                            $query = "insert into registration(`name`,`mail`, `pass`, `gender`,`phone`,`address`,`type`) "
                                    . "values('$username','$email','" . md5($password) . "','$gender','$phone','$address','admin')";
                        }
                    } else {
                        $query = "insert into registration(`name`,`mail`, `pass`, `gender`,`phone`,`address`,`type`) "
                                . "values('$username','$email','" . md5($password) . "','$gender','$phone','$address','user')";
                    }
                    if (mysql_query($query)) {
                        echo 'Thank you for registering';
                        if (!empty($_SESSION['type'])) {
                            if ($_SESSION['type'] == 'admin') {
                                header("Location:http://localhost/Ticket_reserved/admin__bus_insert.php");
                            }
                        } else {
                            header("Location:http://localhost/Ticket_reserved/user_login.php");
                        }
                    } else {
                        echo mysql_error();
                    }
                }
            }
        }
        ?>

        <!-- Main body For Ticket reserved-->
        <div id="mainBody">
            <div id="admin">
                <div id="ad_login">
                    <div id="stylized" class="myform">
                        <form name="form1" method="post" action="registration.php" onSubmit="return check();">
                            <center><div class="" align="center" style="color:#33F; min-height:20px; font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">
                                    <br>
                                    <?php
                                    if (!empty($_SESSION['type'])) {
                                        if ($_SESSION['type'] == 'admin') {
                                            echo 'Add Administrator';
                                        }
                                    } else {
                                        echo 'USER REGISTRATION';
                                    }
                                    ?>
                                </div>
                            </center>
                            <br>
                            <label> Name
                            </label>
                            <input type="text" name="name"  id="name" maxlength="35" placeholder="Enter name"/><br>
                            <label> Email ID
                            </label>
                            <input type="text" name="email"  id="name" maxlength="30"placeholder="Enter Email ID"/><br>
                            <label> Password
                            </label>
                            <input type="password" name="pass"  id="name" maxlength="18"placeholder="Enter password" /><br>
                            <label>Re-enter Password
                            </label>
                            <input type="password" name="cpass"  id="name" maxlength="18" placeholder="Enter Re-password" /><br>
                            <label>Gender
                            </label>
                            <select name="gender" id="name">
                                <option>Male</option>
                                <option>Female</option>
                            </select><br>

                            <label>Address
                            </label>
                            <input type="text" name="address"  id="name"placeholder="Enter address" /><br>
                            <label>Mobile No
                            </label>
                            <input type="text" name="phone"  id="name" maxlength="14" placeholder="Enter phone"/><br>
                            <div> <button type="reset" style="margin-left: 39%;">Reset</button>
                                <button type="submit">Confirm</button></div>
<br>
                   </form> </div>  
                </div><br><br>
            </div>

        </div>

        <!-- Footer For Ticket reserved-->
        <?php
        include './includes/footer.php';
        ?>
    </body>
</html>