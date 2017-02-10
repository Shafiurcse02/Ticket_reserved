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
            <div id="payWindow">
                <!--<div id="Search_div">Online Search</div>-->
                <div id="search_content">
                    <form id='form_fare_query' name="fare_form"accept-charset='UTF-8'>
                        <fieldset>
                            <legend>&nbsp;FARE QUERY &nbsp;</legend>
                            <table id="">
                                <tr>
                                    <td colspan="2">
                                        <div>
                                            Journey Date</div></td>
                                    <td>:</td>
                                    <td>
                                        <div>
                                            <select class="fare_input"  name="journey_date" id="qselecT1">
                                                <option value="null">===SELECT JOURNEY DATE===</option>
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
                                            <select class="fare_input" id="qselecT2" name="from" onclick="busFrom()">
                                                <option value="0">===NONE===</option>
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
                                            <select class="fare_input" id="qselecT3">
                                                <option value="0">===NONE===</option>
                                            </select>
                                            </font>
                                        </div>
                                    </td>
                                </tr> <tr>
                                    <td colspan="2">Station Type</td>
                                    <td>:</td>
                                    <td >
                                        <div>
                                            <font> 
                                            <select  class="fare_input" id="qselecT4">
                                                <option value="0">===NONE===</option>
                                            </select>
                                            </font>
                                        </div>
                                    </td>
                                </tr> <tr id="q_selectlast">
                                    <td colspan="2">Seat No</td>
                                    <td>:</td>

                                    <td>
                                        <div >
                                            <font> 
                                            <select class="fare_input" id="qselecT7">
                                                <option value="0">===NONE===</option>
                                            </select>
                                            </font>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div align="center"> 
                              <!--<input type="submit" name="show_fare" value="Show Fare" id="button1" tabindex="4" />-->
                                <input type="button" name="show_fare" value="Show Fare"
                                       id="button1" tabindex="7" onclick="get_result()" />
                            </div>
                        </fieldset>
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
