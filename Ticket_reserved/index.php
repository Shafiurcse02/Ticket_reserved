<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
unset($_SESSION['from_fare']);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/datepicker.js"></script>
        <link href="css/datepicker.css" rel="stylesheet" type="text/css" />
        <link rel="Stylesheet" href="css/Main_css.css" type="text/css"/>
        <title>Bus</title>
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
        <div id="mainBody">
            <div id="navLeft">
                <div id="Search_div">Online Search</div>
                <div id="search_content">
                    <form action="http://localhost/Ticket_reserved/display_search_result.php" method="POST" >
                        <table>
                            <?php
                            include './includes/left_search.php';
                            ?>
                        </table>
                    </form>
                </div>
            </div>
            <div id="content">
                <br/><h1>Welcome to the Online Reservation System</h1>
                <br/>
                <p>You can easily book one of the limited advance tickets on this website. By booking tickets in advance, you can avoid the queues. However, you have to choose a specific date and time of arrival.

                    We only provide a limited amount of tickets for advanced booking, as we want Wunderland to give spontaneous guests a chance to visit Wunderland, as well.

                    You can visit Wunderland anytime without reservation, of course, but if you want to avoid waiting for sure, buy your tickets now at our online-shop.</p>
                <br/>
                <br/>
                <p>We only provide a limited amount of tickets for advanced booking, as we want Wunderland to give spontaneous guests a chance to visit Wunderland, as well.

                    You can visit Wunderland anytime without reservation, of course, but if you want to avoid waiting for sure, buy your tickets now at our online-shop.

                    We only provide a limited amount of tickets for advanced booking, as we want Wunderland to give spontaneous guests a chance to visit Wunderland, as well.
                    </br></br>
                    You can visit Wunderland anytime without reservation, of course, but if you want to avoid waiting for sure, buy your tickets now at our online-shop.</p></br>
                <br/><br/><br/><br/><br/><br/>

            </div>
        </div>

        <!-- Footer For Ticket reserved-->
        <?php
        include './includes/footer.php';
        ?>
    </body>
</html>
