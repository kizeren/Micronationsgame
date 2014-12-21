<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('config.php');
// Greater then 4036 ticks and not logged in get deleted.
// changed for beta world.
echo "\r\ndeletion update\r\n";
$deletion = mysql_query("SELECT * FROM members WHERE ttd > 40000", $db);
while ($deletion_row = mysql_fetch_array($deletion)) {
    $bank_sql = mysql_query("SELECT * FROM worldbank", $db);
    while ($bank = mysql_fetch_array($bank_sql)) {
        $id = $deletion_row[0];
        echo "$id\r\n";
        $res_sql = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);
        while ($res = mysql_fetch_array($res_sql)) {

            
            $money = $deletion_row['money'];
            $food = $res['food'];
            $culture = $res['culture'];
            $goods = $res['goods'];
            $land = $deletion_row['land'];
            echo "$deletion_row[0]\r\n";
            mysql_query("UPDATE worldbank SET money = money + '$money', food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', land = land + '$land'", $db);
            mysql_query("DELETE FROM alliance WHERE member_id = '$deletion_row[0]' ", $db);
            mysql_query("DELETE FROM bills WHERE member_id = '$deletion_row[0]' ", $db);
            mysql_query("DELETE FROM connection_log WHERE member_id = '$deletion_row[0]' ", $db);
            mysql_query("DELETE FROM military  WHERE member_id = '$deletion_row[0]' ", $db);
            mysql_query("DELETE FROM resources  WHERE member_id = '$deletion_row[0]'", $db);
            mysql_query("DELETE FROM satellites  WHERE member_id = '$deletion_row[0]' ", $db);

            mysql_query("DELETE FROM nationlog WHERE nationid = '$deletion_row[0]'", $db);
            mysql_query("DELETE FROM messages WHERE user = '$deletion_row[3]'", $db);
            mysql_query("DELETE FROM bills WHERE member_id= '$deletion_row[0]'", $db);
            mysql_query("DELETE FROM members WHERE member_id = '$deletion_row[0]'", $db);
            mysql_query("DELETE FROM research WHERE member_id = '$deletion_row[0]'", $db);
            mysql_query("DELETE FROM structures WHERE member_id = '$deletion_row[0]'", $db);
            mysql_query("DELETE FROM map_coords WHERE member_id = '$deletion_row[0]'", $db);
            mysql_query("DELETE FROM points WHERE member_id = '$deletion_row[0]'", $db);
            mysql_query("DELETE FROM newb_prot WHERE member_id = '$deletion_row[0]'", $db);
        }
    }
}
?>