<?php   
include('/home/mcbride/public_html/micronationsgame/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $admin_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'");
        while($admin_row = mysql_fetch_array($admin_sql))
                if($admin_row[25] < 1)
                {
                    header("location: ../member-index.php");
                }

$name = mysql_real_escape_string($_GET['name']);
$flag = mysql_real_escape_string($_GET['flag']);
$food = mysql_real_escape_string($_GET['food']);
$culture = mysql_real_escape_string($_GET['culture']);
$goods = mysql_real_escape_string($_GET['goods']);
$lat = mysql_real_escape_string($_GET['lat']);
$lon = mysql_real_escape_string($_GET['lon']);
$infantry = mysql_real_escape_string($_GET['infantry']);
$level = mysql_real_escape_string($_GET['level']);
                


mysql_query("INSERT INTO roguenations (name , flag, food, culture, goods, lat, lon, level, infantry) VALUES ('$name', '$flag', '$food', '$culture', '$goods', '$lat', '$lon', '$level', '$infantry')", $db);


header("location: editrogue.php");


?>
