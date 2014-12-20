<?php
include('/home/mcbride/public_html/micronationsgame/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

$infantry = '0';
$tanks = '0';
$mines = '0';
$mercs = '0';




$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$admin_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
while ($admin_row = mysql_fetch_array($admin_sql))
    if ($admin_row[25] <= 4) {
        header("location: ../member-index.php");
    }

$memberid = $_GET['memberid'];
$infantry = $_GET['infantry'];
$tanks = $_GET['tanks'];
$spies = $_GET['spies'];
$mercs = $_GET['mercs'];
$mines = $_GET['mines'];
$qeue = $_GET['id'];

 mysql_query("UPDATE military SET infantry = infantry + '$infantry', tanks = tanks + '$tanks', spies = spies + '$spies', mercs = mercs + '$mercs', mines = mines + '$mines' WHERE member_id = '$memberid'", $db);
 mysql_query("DELETE FROM training WHERE id = '$qeue'", $db);
    
 header("location: qeues.php");
    
?>
