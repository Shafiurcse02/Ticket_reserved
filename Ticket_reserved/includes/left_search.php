<script type="text/javascript">


    function makeTwoChars(inp) {
        return String(inp).length < 2 ? "0" + inp : inp;
    }

    function initialiseInputs() {
        // Clear any old values from the inputs (that might be cached by the browser after a page reload)
        document.getElementById("sd").value = "";
        document.getElementById("ed").value = "";

        // Add the onchange event handler to the start date input
        datePickerController.addEvent(document.getElementById("sd"), "change", setReservationDates);
    }

    var initAttempts = 0;

    function setReservationDates(e) {
        // Internet Explorer will not have created the datePickers yet so we poll the datePickerController Object using a setTimeout
        // until they become available (a maximum of ten times in case something has gone horribly wrong)

        try {
            var sd = datePickerController.getDatePicker("sd");
            var ed = datePickerController.getDatePicker("ed");
        } catch (err) {
            if (initAttempts++ < 10)
                setTimeout("setReservationDates()", 50);
            return;
        }

        // Check the value of the input is a date of the correct format
        var dt = datePickerController.dateFormat(this.value, sd.format.charAt(0) == "m");

        // If the input's value cannot be parsed as a valid date then return
        if (dt == 0)
            return;

        // At this stage we have a valid YYYYMMDD date

        // Grab the value set within the endDate input and parse it using the dateFormat method
        // N.B: The second parameter to the dateFormat function, if TRUE, tells the function to favour the m-d-y date format
        var edv = datePickerController.dateFormat(document.getElementById("ed").value, ed.format.charAt(0) == "m");

        // Set the low range of the second datePicker to be the date parsed from the first
        ed.setRangeLow(dt);

        // If theres a value already present within the end date input and it's smaller than the start date
        // then clear the end date value
        if (edv < dt) {
            document.getElementById("ed").value = "";
        }
    }

    function removeInputEvents() {
        // Remove the onchange event handler set within the function initialiseInputs
        datePickerController.removeEvent(document.getElementById("sd"), "change", setReservationDates);
    }

    datePickerController.addEvent(window, 'load', initialiseInputs);
    datePickerController.addEvent(window, 'unload', removeInputEvents);

    //]]>
</script>
<table width="250" border=0>
    <tr ><th colspan="2"></th></tr>
    <tr>
        <td>
            Journey Date:
        </td>  
        <td >
            <span style="margin-right: 11px;">
                <input type="date" class="w8em format-d-m-y highlight-days-67 range-low-today" name="date" id="sd" value="" maxlength="10" readonly="readonly" style="width: 120px;  border: 2px double #CCCCCC; padding:1px 2px;"/>
            </span>
        </td>
    </tr>
    <tr>
        <td>
            Source Place:
        </td>  
        <td>
            <select name="start" id="selecT">
                <?php
                include "includes/connection.php";

                $query = 'SELECT distinct source FROM `bus`';
                $query1 = mysql_query($query, $connection);

                if (!$query1) {
                    die("Database select room fail" . mysql_error());
                }
                echo ' <option value=' . Null . '>' . '=Select Place=' . '</option>';
                while ($row = mysql_fetch_array($query1)) {
                    echo ' <option value=' . $row['source'] . '>' . $row['source'] . '</option>';
                }
                ?>
                <!--                <option value="gaibandha" selected>gaibandha</option>
                                <option value="dhaka">Dhaka</option>
                                <option value="rangpur">Rangpur</option>
                                <option value="bogra">Bogra</option>-->
            </select>
        </td>
    </tr>
    <tr>
        <td>
            Destination Place:
        </td>  
        <td>
            <select name="destination" id="selecT">
                <?php
                $query = 'SELECT distinct destination FROM `bus`';
                $query3 = mysql_query($query, $connection);

                if (!$query3) {
                    die("Database select room fail" . mysql_error());
                }
                echo ' <option value=' . Null . '>' . '=Select Place=' . '</option>';
                while ($row = mysql_fetch_array($query3)) {
                    echo ' <option value=' . $row['destination'] . '>' . $row['destination'] . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>


    <tr> <td>
            Select Time:
        </td>
        <td >
            <select name="time" id="selecT">
                <?php
                $query = 'SELECT distinct time FROM `bus`';
                $query2 = mysql_query($query, $connection);

                if (!$query2) {
                    die("Database select room fail" . mysql_error());
                }
                echo ' <option value=' . NULL . '>' . '=Select Time=' . '</option>';
                while ($row = mysql_fetch_array($query2)) {
                    echo ' <option value=' . $row['time'] . '>' . $row['time'] . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            Type:
        </td>  
        <td>
            <select name="type" id="selecT">
                <?php
                $query = 'SELECT distinct type FROM `bus`';
                $query4 = mysql_query($query, $connection);

                if (!$query4) {
                    die("Database select room fail" . mysql_error());
                }
                echo ' <option value=' . NULL . '>' . '=Select Type=' . '</option>';
                while ($row = mysql_fetch_array($query4)) {
                    echo ' <option value=' . $row['type'] . '>' . $row['type'] . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            Seat Amount:
        </td>  
        <td>
            <select name="seat" id="selecT">
                <option value="1"> 1</option>
                <option value="2">2</option>

            </select>
        </td>
    </tr>
    <tr>
        <td   colspan="2" align="right"><input type="submit" value="Search" title="Search jnuhotel.com" /></td>
    </tr>
</table>