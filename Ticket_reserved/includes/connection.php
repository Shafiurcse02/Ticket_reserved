<?php
$connection = mysql_connect("localhost", "root", "");
if (!$connection) {
    die("Database is failed to connect" . mysql_error());
}
$db_select = mysql_select_db("bus_ticket", $connection);
if (!$db_select) {
    die("Database is failed to connect" . mysql_error());
}
?>