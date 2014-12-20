<?php

   include('/home/mcbride/public_html/micronationsgame/config.php');

require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");





$ac130 = mysql_real_escape_string($_GET['ac130']);
$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$result = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);
$result2 = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);




while ($row = mysql_fetch_array($result)) {




    while ($res = mysql_fetch_array($result2)) {
        if (($ac130 * 10000) > $res[3]) {
            $errmsg_arr[] = 'You do not have enough culture to train.';
            $errflag = true;
        }

        if (($ac130 * 10000 ) > $res[4]) {
            $errmsg_arr[] = 'You do not have enough goods to train.';
            $errflag = true;
        }
        if ($ac130 > $res[17]) {
            $errmsg_arr[] = 'You do not have enough gold to train.';
            $errflag = true;
        }
    }
    if ($ac130 * 50000 > $row[14]) {
        $errmsg_arr[] = 'You do not have enough money to train.';
        $errflag = true;
    }


    if ($errflag) {
        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        header("location: ../../military.php");
        exit();
    }
    $culture = $ac130 * 1000;
    $goods = $ac130 * 1000;
    $ac130_t = $ac130 * 5000;
    $gold = $ac130;
    $message = "You are training " . $ac130 . " ac130's for " . number_format($ac130_t) . " " . $row[7] . ", " . number_format($culture) . " culture and " . number_format($goods) . " goods.";

    //$result2 = mysql_query("UPDATE military SET ac130 = ac130 + '$ac130' WHERE member_id = '$id'", $db);

    $f16_sql = mysql_query("SELECT * FROM trainf16 WHERE member_id = '$id'", $db);
    $ac130_sql = mysql_query("SELECT * FROM trainac130 WHERE member_id = '$id'", $db);

    $f16result = mysql_num_rows($f16_sql);
    $ac130result = mysql_num_rows($ac130_sql);

    $numresult = $f16result + $ac130result;
    $structure_sql = mysql_query("SELECT * FROM structures WHERE member_id = '$id'", $db);
    while ($struct = mysql_fetch_array($structure_sql)) {
        if ($numresult >= $struct['hangers']) {

            $errmsg_arr[] = 'You cannot have more queus.';
            $errflag = true;
        }
        if ($struct['hangers'] == '0') {
            $errmsg_arr[] = 'You no hangers.';
            $errflag = true;
        }
        if ($errflag) {
            $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
            header("location: ../../military.php");
            exit();
        }
    }
    //date time for finished troops
    $research_sql = mysql_query("SELECT * FROM research WHERE member_id='$id'", $db);
    while ($research = mysql_fetch_array($research_sql)) {

        $lvl = round($research['miltrainlvl'] / 20);
        $ticks = round(($ac130 / $lvl) * 20);
        $now = new DateTime;
        $clone = $now;        //this doesnot clone so:
        $clone->modify('+' . $ticks . ' Minutes');

        $date = $now->format('m/d/Y g:i:s A');
                $timestamp = strtotime($date);

    }


    //Add troops to qeues.
    mysql_query("INSERT INTO trainac130 ( member_id, ac130, date, lvl, timestamp ) VALUES ('$id', '$ac130', '$date', '$lvl', '$timestamp')", $db);
    mysql_query("UPDATE members SET money = money - '$ac130_t' WHERE member_id = '$id'", $db);
    $res_cost = mysql_query("UPDATE resources SET culture = culture - '$culture', goods = goods - '$goods', gold = gold - '$gold' WHERE member_id = '$id'", $db);
    $result3 = mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', '$message', Now())", $logdb);
    $errmsg_arr[] = ' ' . $message . ' ';
    $errflag = true;
    if ($errflag) {
        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        header("location: ../../military.php");
        exit();
    }
}
?>

