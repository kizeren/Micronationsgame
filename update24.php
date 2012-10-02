<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
include("config.php");

if (isset($_SERVER['REQUEST_URI']))
{
    die("Access denied");
}


?>
