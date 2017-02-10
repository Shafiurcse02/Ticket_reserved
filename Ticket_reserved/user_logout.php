<?php

@session_start();
unset($_SESSION['user_id']);
unset($_SESSION['type']);

unset($_SESSION['num']);
unset($_SESSION['bus_id']);
 unset($_SESSION['from_fare']);
session_destroy();
unset($_SESSION);
header("Location: http://localhost/Ticket_reserved/user_login.php");
?>
   

