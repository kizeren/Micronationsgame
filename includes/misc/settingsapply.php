<?php

        include('/home/nations/public_html/beta/config.php');

	require_once("$directory/includes/config/auth.php");
        include("$directory/includes/misc/include.php");

$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$nation = mysql_real_escape_string($_GET['nation']);
$motto = mysql_real_escape_string($_GET['motto']);
$monetary = mysql_real_escape_string($_GET['monetary']);
$tree = mysql_real_escape_string($_GET['tree']);
$plant = mysql_real_escape_string($_GET['plant']);
$flag = mysql_real_escape_string($_GET['flag']);
$taxpreg = mysql_real_escape_string($_GET['tax']);
$tax = preg_replace("/[[:^digit:]]/", '', $taxpreg);
$lat = mysql_real_escape_string($_GET['lat']);
$lon = mysql_real_escape_string($_GET['lon']);
$religion = mysql_real_escape_string($_GET['religion']);
$name = mysql_real_escape_string($_SESSION['SESS_LOGIN']);

if ($tax > 100) {
    $errmsg_arr[] = 'Cannot set tax higher then 100.';
    $errflag = true;
}
if ($tax < 1) {
    $errmsg_arr[] = 'Cannot set tax lower then 1% you will have no income..';
    $errflag = true;
}


if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    header("location: ../../settings.php");
    exit();
}
$result = mysql_query("UPDATE members SET nation = '$nation', motto = '$motto', monetary = '$monetary', tree = '$tree', plant = '$plant', flag = '$flag', ttd = 0, tax = '$tax', religion = '$religion' WHERE member_id='$id'", $db);
$result = mysql_query("UPDATE map_coords SET name = '$name', lat = '$lat', lon = '$lon' WHERE member_id = '$id'", $db);

$errmsg_arr[] = 'Settings updated.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
header("location: ../../member-index.php");
?>
