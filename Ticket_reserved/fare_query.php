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
        <script type="text/javascript" src="js/datepicker.js"></script>
        <link href="css/datepicker.css" rel="stylesheet" type="text/css" />
        <link rel="Stylesheet" href="css/Main_css.css" type="text/css"/>
        <title>Bus</title>
        <script>

            function get_result()
            {
                document.getElementById("output_fare").innerHTML = "hghghgh";


            }
            function busFrom() {
                var i_date = document.forms["fare_form"]["journey_date"].value;
                if (i_date < > null)
                {
                    document.getElementById("from").innerHTML = " <select class='fare_input' id='qselecT2' name='from' onclick='busFrom()'" >
                            "<option value='0'>===NONE===</option>"
                    "<option value='1'>1</option>"
                    "</select>";
                }

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

        <div id="mainBody">
            <div id="fareLeft">
                <!--<div id="Search_div">Online Search</div>-->
                <div id="search_content">
                    <form id='form_fare_query' method="POST" action="http://localhost/Ticket_reserved/display_search_result.php" name="fare_form"accept-charset='UTF-8'>
                        <fieldset>
                            <legend>&nbsp;FARE QUERY &nbsp;</legend>
                            <?php $_SESSION['from_fare'] = "yes";
                            ?>
                            <table id="">
                                <tr>
                                    <td colspan="2">
                                        <div>
                                            Journey Date</div></td>
                                    <td>:</td>
                                    <td>
                                        <div>
                                            <select class="fare_input"  name="date" id="qselecT1">
                                                <option value="null">=== JOURNEY DATE===</option>
                                                <?php
                                                for ($d = 1; $d <= 10; $d++) {
                                                    $bookingDate = mktime(0, 0, 0, date("m"), date("d") + $d, date("Y"));
                                                    ?>
                                                    <option value="<?php echo date("d-m-Y", $bookingDate); ?>">
                                                        <?php echo date("d-m-Y", $bookingDate); ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">Bus From</td>
                                    <td>:</td>

                                    <td >
                                        <div>
                                            <font> 
                                            <select class="fare_input" id="qselecT2" name="start" onclick="busFrom()">

                                                <?php
                                                include "includes/connection.php";

                                                $query = 'SELECT distinct source FROM `bus`';
                                                $query1 = mysql_query($query, $connection);

                                                if (!$query1) {
                                                    die("Database select room fail" . mysql_error());
                                                }
                                                echo ' <option value=' . Null . '>' . '===NONE===' . '</option>';
                                                while ($row = mysql_fetch_array($query1)) {
                                                    echo ' <option value=' . $row['source'] . '>' . $row['source'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            </font>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Station To</td>
                                    <td>:</td>
                                    <td >
                                        <div>
                                            <font> 
                                            <select class="fare_input" name="destination" id="qselecT3">
                                                <?php
                                                $query = 'SELECT distinct destination FROM `bus`';
                                                $query3 = mysql_query($query, $connection);

                                                if (!$query3) {
                                                    die("Database select room fail" . mysql_error());
                                                }
                                                echo ' <option value=' . Null . '>' . '===NONE===' . '</option>';
                                                while ($row = mysql_fetch_array($query3)) {
                                                    echo ' <option value=' . $row['destination'] . '>' . $row['destination'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            </font>
                                        </div>
                                    </td>
                                </tr> <tr>
                                    <td colspan="2">Bus Type</td>
                                    <td>:</td>
                                    <td >
                                        <div>
                                            <font> 
                                            <select  class="fare_input" name="type" id="qselecT4">
                                                <?php
                                                $query = 'SELECT distinct type FROM `bus`';
                                                $query4 = mysql_query($query, $connection);

                                                if (!$query4) {
                                                    die("Database select room fail" . mysql_error());
                                                }
                                                echo ' <option value=' . NULL . '>' . '===NONE===' . '</option>';
                                                while ($row = mysql_fetch_array($query4)) {
                                                    echo ' <option value=' . $row['type'] . '>' . $row['type'] . '</option>';
                                                }
                                                ?>

                                            </select>
                                            </font>
                                        </div>
                                    </td>
                                </tr>

                                <tr id="q_selectlast">
                                    <td colspan="2">Bus time</td>
                                    <td>:</td>

                                    <td>
                                        <div >
                                            <font> 
                                            <select class="fare_input" name="time" id="qselecT7">

                                                <?php
                                                $query = 'SELECT distinct time FROM `bus`';
                                                $query2 = mysql_query($query, $connection);

                                                if (!$query2) {
                                                    die("Database select room fail" . mysql_error());
                                                }
                                                echo ' <option value=' . NULL . '>' . '===NONE===' . '</option>';
                                                while ($row = mysql_fetch_array($query2)) {
                                                    echo ' <option value=' . $row['time'] . '>' . $row['time'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            </font>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="q_selectlast">
                                    <td colspan="2">Seat No</td>
                                    <td>:</td>

                                    <td>
                                        <div >
                                            <font> 
                                            <select class="fare_input" name="seat" id="qselecT7">
                                                <option value="1"> 1</option>
                                                <option value="2">2</option>

                                            </select>
                                            </font>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div align="center"> 
                              <!--<input type="submit" name="show_fare" value="Show Fare" id="button1" tabindex="4" />-->
                                <input type="submit" name="show_fare" value="Show Fare"
                                       id="button1" tabindex="7"  />
                            </div>
                        </fieldset>
                    </form>

                </div>



            </div>
            <div id="fare_right">
                <fieldset>
                    <legend>Price</legend>
                    <?php
                    if (isset($_SESSION['to_fare']) && !empty($_SESSION['to_fare'])) {
                        echo " <br/><p id='fare_r1'>" . $_SESSION['to_fare'] . '</p><br/>';
                        unset($_SESSION['to_fare']);
                        unset($_SESSION['from_fare']);
                    } else {
                        echo "<br/><p id='fare_r2'>  Searching Result </p><br/>";
                    }
                    ?>

                </fieldset>
            </div>
        </div>

        <!-- Footer For Ticket reserved-->
        <?php
        include './includes/footer.php';
        ?>
    </body>
</html>
