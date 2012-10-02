<?php
include('/home/nations/public_html/beta/config.php');

include("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");
$lat = rand(1, 100);
$lon = rand(1, 100);

$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$name = mysql_real_escape_string($_SESSION['SESS_LOGIN']);
mysql_query("UPDATE members SET land = 0, first_login = '0', money = 200000 WHERE member_id = '$id'", $db);
mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', 'You have founded a nation!!!', Now())", $logdb);
mysql_query("INSERT INTO resources (member_id, food, culture, goods, farmlvl, culturelvl, industrylvl, storagelvl) VALUES ('$id', '0', '0', '0', '0', '0', '0,', '0')", $db);
mysql_query("INSERT INTO structures (member_id, gold_mine, oil_well) VALUES ('$id', '0', '0')", $db);
mysql_query("INSERT INTO research (member_id, istechresearch, techlvl, techtick, isgoldresearch, goldlvl, goldtick) VALUES ('$id', '0', '0', '0', '0', '0', '0')", $db);
mysql_query("INSERT INTO military (member_id) VALUES ('$id')", $db);
mysql_query("INSERT INTO ttdmail (member_id, mailsent) VALUES ('$id', '0')", $db);
mysql_query("INSERT INTO points (member_id, points) VALUES ('$id', '100')", $db);
mysql_query("INSERT INTO research (member_id) VALUES ('$id')", $db);
mysql_query("INSERT INTO map_coords (member_id, name, lat, lon) VALUES ('$id', '$name', '$lat', '$lon')", $db);
mysql_query("INSERT INTO newb_prot (member_id, isnewb, tick) VALUES ('$id', '1', '0')", $db);
mysql_query("INSERT INTO msettings (member_id, warreports, news) VALUES ('$id', 'true', 'true')", $db);
mysql_query("INSERT INTO pkill (member_id, pkill, ploss) VALUES ('$id', '0', '0')", $db);
mysql_query("SELECT id FROM quests", $db);
mysql_query("INSERT INTO lead_mine (member_id, level, lead) VALUES ('$id', '1', '0'", $db);
//TODO  Adding in random resources.
//  lead,Uranium,Iron,water,silver
while ($questrow = mysql_fetch_array($questsql)) {
    mysql_query("INSERT INTO user_quests (member_id, id, active, awarded) VALUES ( '$id', '$questrow[0]', '1', '0')", $db);
}
header("location: ../../member-index.php");
?>
