<?php
$price_seat = "";
$bus_ids = "";

session_start();
include './includes/connection.php';
$query = "SELECT * FROM `bus` where  `source`='dhaka' AND `type`='ac' AND  `time`='10am' AND `destination`='gaibandha';";

$query2 = mysql_query($query, $connection);

if (!$query2) {
    die("Database select  fail" . mysql_error());
}

while ($row = mysql_fetch_array($query2)) {
    $price_seat = $row['price'];
    $bus_ids = $row['bus_id'];
}
echo $price_seat . ' ' . $bus_ids . '<br/>';
$jpurnet_date = date("Y-m-d", strtotime("2015-05-21"));
$quer = "SELECT * FROM `seat`  "
        . "where `bus_id`='$bus_ids' AND `seat_id` not in "
        . "(SELECT `seat_id` FROM `reservation` where `date`='$jpurnet_date' AND `bus_id`='$bus_ids');";

//$quer=$quer = "SELECT * FROM `seat`"
//        . "where `bus_id`='$bus_ids';";
//"SELECT * FROM `reservation` r,`seat` s  "where r.`bus_id`='$bus_ids' AND r.`date`='$jpurnet_date' AND r.`seat_id`!=s.`seat_id`;";;

$query4 = mysql_query($quer, $connection);

if (!$query4) {
    die("Database select  fail" . mysql_error());
}echo 'fgfgf' . '<br/>';
$cv = array('');
$i = 0;
while ($row4 = mysql_fetch_array($query4)) {
    $cv[$i] = $row4['seat_name'];
    echo 'Sdsfdss ' . count($row4) . '<br/>';
    echo $row4['seat_name'] . '    ' . $row4['bus_id'] . '     ' . $row4['seat_id'] . '<br/>';
    $i++;
}
foreach ($cv as $value) {
    echo $value . '' . '<br/>';
}
for ($index = 0; $index < count($cv); $index++) {
    echo $cv[$index] . '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp;';
    if ($index % 3 == 0) {
        echo '<br/>';
    }
}echo ' Seshe ,m,m,m,m, ' . count($row4) . '<br/>';

foreach ($cv as $value) {
    echo ' <option value=' . $value . 'selected>' . $value . '</option>';
}
echo 'gg';
$seat_number = 1;
switch ($seat_number) {
    case 1:
        echo '<select name="seat_cofrm" id="selecT">';
        foreach ($cv as $value) {
            echo ' <option value=' . $value . 'selected>' . $value . '</option>';
        }
        echo '</select>';
        break;

    default:
        break;
}
?>



<form name="form1" method="post" action="registration_2.php" onSubmit="return check();">
    <table style=""  bordercolor="#000000" cellspacing="1" border="2">
        <tbody>
            <tr>
                <td style=" height: 40px" bordercolor="#000000" bgcolor="<?php echo $set[1]; ?>">
                    <strong>&nbsp;1&nbsp;<input type="checkbox" name="seat[]" value="1"><?php $status; ?>
                    </strong></td>
                <td rowspan="10" bordercolor="#000000" style="width: 137px" >
                    &nbsp;</td>
                <td bordercolor="#000000" style="width: 128px" bgcolor="<?php echo $set[2]; ?>">
                    <strong>&nbsp;2&nbsp;&nbsp; <input type="checkbox" name="seat[]" value="2"></strong></td>
                <td style=" height: 40px" bordercolor="#000000" bgcolor="<?php echo $set[3]; ?>" >
                    <strong>&nbsp;3 <input type="checkbox" name="seat[]" value="3"></strong></td>
            </tr> <tr>

            </tr>
        </tbody>
    </table>
</form>
<table>
    <tr><td style=" height: 40px" bordercolor="#000000" bgcolor="<?php echo $set[1]; ?>">
            <strong>&nbsp;1&nbsp;<input type="checkbox" name="seat[]" value="1">
            </strong></td>
        <td style=" height: 40px" bordercolor="#000000" bgcolor="<?php echo $set[1]; ?>">
            <strong>&nbsp;1&nbsp;<input type="checkbox" name="seat[]" value="1"><?php $status; ?>
            </strong></td>
        <td style=" height: 40px" bordercolor="#000000" bgcolor="<?php echo $set[1]; ?>">
            <strong>&nbsp;1&nbsp;<input type="checkbox" name="seat[]" value="1">
            </strong></td>
        <td style=" height: 40px" bordercolor="#000000" bgcolor="<?php echo $set[1]; ?>">
            <strong>&nbsp;1&nbsp;<input type="checkbox" name="seat[]" value="1"><?php $status; ?>
            </strong></td>
        <td rowspan="8" bordercolor="#000000" style="width: 137px" >
            &nbsp;</td><td style=" height: 40px" bordercolor="#000000" bgcolor="<?php echo $set[1]; ?>">
            <strong>&nbsp;1&nbsp;<input type="checkbox" name="seat[]" value="1"><?php $status; ?>
            </strong></td>
        <td style=" height: 40px" bordercolor="#000000" bgcolor="<?php echo $set[1]; ?>">
            <strong>&nbsp;1&nbsp;<input type="checkbox" name="seat[]" value="1">
            </strong></td>
        <td style=" height: 40px" bordercolor="#000000" bgcolor="<?php echo $set[1]; ?>">
            <strong>&nbsp;1&nbsp;<input type="checkbox" name="seat[]" value="1">
            </strong></td>

        <td>wew</td>
        <td>ewe</td>
    </tr>
    <tr></tr>
    <tr></tr> 
    <tr></tr> 
    <tr></tr> 
    <tr></tr> 
    <tr></tr> 
    <tr></tr> 
    <tr></tr>








</table>