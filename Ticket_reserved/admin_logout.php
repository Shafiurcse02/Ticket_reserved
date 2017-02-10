<?php

@session_start();
unset($_SESSION['user_id']);
unset($_SESSION['type']);
unset($_SESSION);
header("Location: http://localhost/Ticket_reserved/admin_login.php");
?>
