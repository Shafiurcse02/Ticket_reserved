<?php

$price_seat = "";
$bus_ids = "";

session_start();
include './includes/connection.php';
$jdt = str_replace('/', '-', '26/06/2015');
$jpurnet_date = date('Y-m-d', strtotime($jdt));
//                                       
//                                        
$QueryL = "SELECT * FROM `registration` r,`reservation`  r1,`dashboard`"
        . "where `id`='1' AND r.user_id=`dashboard`.user_id AND "
        . "r1.date='$jpurnet_date' AND r1.user_id=r.user_id AND r1.bus_id='1'"
        . ";";

//   $QueryL = "SELECT * FROM `reservation`"AND r.user_id=r1.user_id AND d.date=r1.date AND d.bus_id=r1.bus_id
//        . " where `date`='$jpurnet_date' AND `user_id`=1";


$Resul = mysql_query($QueryL);
if ($Resul) {
    while ($row = mysql_fetch_array($Resul)) {
        echo 'fgfgfgfgf';
        $_SESSION['t_id'] = $row['user_id'];
        echo $row['user_id'];
//                                                header("Location:http://localhost/Ticket_reserved/ticketid.php");
    }
} else {
    echo 'Interted Corrected Information';
}