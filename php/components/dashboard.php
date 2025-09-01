<?php
if(!isset($_SESSION)) {
    session_start();
}
require_once('/var/www/html/php/include/_connect.php');
include_once('/var/www/html/php/include/_execute.php');
require_once('/var/www/html/php/include/_bdie.php');
?>

<h1 class="text-center">Dashboard</h1>