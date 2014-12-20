<?php

include('/home/mcbride/public_html/micronationsgame/config.php');

require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");
//$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
//$name = mysql_real_escape_string($_GET['name']);
$errflag = false;
$id = $_SESSION['SESS_MEMBER_ID'];
$defender = mysql_real_escape_string($_GET['name']);
$troops = mysql_real_escape_string($_GET['troops']);
$tanks = mysql_real_escape_string($_GET['tanks']);
$mercs = mysql_real_escape_string($_GET['mercs']);
$f16 = mysql_real_escape_string($_GET['f16']);
$ac130 = mysql_real_escape_string($_GET['ac130']);

$attacker = $_SESSION['SESS_LOGIN'];
$attacker_id = $id;

$defender_sql = mysql_query("SELECT * FROM members WHERE login = '$defender'", $db);
$attacker_t_sql = mysql_query("SELECT * FROM military WHERE member_id = '$id'", $db);
while ($defender_row = mysql_fetch_array($defender_sql)) {

    $defender_t_sql = mysql_query("SELECT * FROM military WHERE member_id = '$defender_row[0]'", $db);
    $defender_res_sql = mysql_query("SELECT * FROM resources WHERE member_id = '$defender_row[0]'", $db);
    while ($attacker_t_row = mysql_fetch_array($attacker_t_sql)) {
        while ($defender_t_row = mysql_fetch_array($defender_t_sql)) {
            while ($defender_res_row = mysql_fetch_array($defender_res_sql)) {
                $warehouse = ($defender_row['warehouse'] * 10000) + ($defender_res_row[14] * 1000);
                $defender_id = $defender_row['member_id'];
                $defender_protection = $defender_t_row['protection'];
                $defender_troops = $defender_t_row['infantry'];
                $defender_tanks = $defender_t_row['tanks'];
                $defender_mercs = $defender_t_row['mercs'];
                $defender_mines = $defender_t_row['mines'];
                $defender_f16s = $defender_t_row['f16'];
                $defender_ac130s = $defender_t_row['ac130'];

                $attacerk_id = $id;
                $attacker_troops = $troops;
                $attacker_tanks = $tanks;
                $attacker_mercs = $mercs;
                $attacker_f16s = $f16;
                $attacker_ac130s = $ac130;
                $attacker_protection = $attacker_t_sql['protection'];
            }
        }
    }
}
if ($defender_protection >= 3) {

    $errmsg_arr[] = 'You cannot attack this player they are under protection.';
    $errflag = true;
}
$newb_sql = mysql_query("SELECT * FROM newb_prot WHERE member_id = '$defender_sql[0]'", $db);
while ($newb = mysql_fetch_assoc($newb_sql)) {
    if ($newb['isnewb'] > 0) {

        $errmsg_arr[] = 'You cannot attack this player they are under newbie protection.';
        $errflag = true;
    }
}
if ($attacker_protection >= 3) {

    $errmsg_arr[] = 'You cannot attack. You are under protection.';
    $errflag = true;
}


if ($attacker_id == $defender_id) {

    $errmsg_arr[] = 'You cannot attack yourself.';
    $errflag = true;
}
$attacker_military_sql = mysql_query("SELECT * FROM military WHERE member_id = '$attacker_id'", $db);
while ($attacker_military_row = mysql_fetch_array($attacker_military_sql)) {
    if ($troops > $attacker_military_row['infantry']) {
        $errmsg_arr[] = 'You do not have that many infantry.';
        $errflag = true;
    }
    if ($tanks > $attacker_military_row['tanks']) {
        $errmsg_arr[] = 'You do not have that many tanks.';
        $errflag = true;
    }
    if ($mercs > $attacker_military_row['mercs']) {
        $errmsg_arr[] = 'You do not have that many mercs.';
        $errflag = true;
    }
    if ($f16 > $attacker_military_row['f16']) {
        $errmsg_arr[] = 'You do not have that many f16s.';
        $errflag = true;
    }
    if ($ac130 > $attacker_military_row['ac130']) {
        $errmsg_arr[] = 'You do not have that many AC130s.';
        $errflag = true;
    }
}


if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    header("location: ../../member-index.php");
    exit();
}

$infantry1 = $troops;
$tanks1 = $tanks;
$mercs1 = $mercs;
$f161 = $f16;
$ac1301 = $ac130;


$infantry2 = $defender_troops;
$tanks2 = $defender_tanks;
$mercs2 = $defender_mercs;
$mines2 = $defender_mines;
$f162 = $defender_f16s;
$ac1302 = $defender_ac130s;

$total1def = (($infantry1 * $infantrydef) + ($tanks1 * $tankdef) + ($mercs1 * $mercdef) + ($f161 * $f16def) + ($f161 * $f16def ));
$total1hit = (($infantry1 * $infantryhit) + ($tanks1 * $tankhit) + ($mercs1 * $merchit) + ($f161 * $f16hit) + ($ac1301 * $ac130hit ));

$total2def = (($defender_troops * $infantrydef) + ($tanks2 * $tankdef) + ($mercs2 * $mercdef) + ($mines2 * $minedef) + ($f162 * $f16def) + ($ac1302 * $ac130def ));
$total2hit = (($defender_troops * $infantryhit) + ($tanks2 * $tankhit) + ($mercs2 * $merchit) + ($f162 * $f16def) + ($ac1302 * $ac130def ));




$total1 = $total1hit;
$total2 = $total2def;


if ($total1 > $total2) {
    $loss = pow($total2 / $total1, 1.5);
    $infantry1loss = round($infantry1 * $loss);
    $tank1loss = round($tanks1 * $loss);
    $merc1loss = round($mercs1 * $loss);
    $f161loss = round($f161 * $loss);
    $ac1301loss = round($ac1301 * $loss);
    $losst = $loss * 100;

    if (($def_res_row[2] - $warehouse) < 0) {
        $farm = 0;
    } else {
        $farm = $def_res_row[2] - $warehouse;
    }

    if (($def_res_row[3] - $warehouse) < 0) {
        $cult = 0;
    } else {
        $cult = $def_res_row[3] - $warehouse;
    }

    if (($def_res_row[4] - $warehouse) < 0) {
        $inds = 0;
    } else {
        $inds = $def_res_row[4] - $warehouse;
    }
    $farm_res = round($farm);
    $inds_res = round($inds);
    $cult_res = round($cult);
    mysql_query("UPDATE resources SET food = food + '$farm_res', culture = culture + '$cult_res', goods = goods + '$inds_res' WHERE member_id = '$id'", $db);
    mysql_query("UPDATE resources SET food = food - '$farm_res', culture = culture - '$cult_res', goods = goods - '$inds_res' WHERE member_id = '$defender_id'", $db);
    $subject = "Battle Report";
    $body = "<table class=\"stats\"><tr><td colspan=\"4\"><b>Attacker:</b></td></tr>
  <tr><td colspan=\"4\">$attacker</td></tr>
  <tr><td>Infantry Before: </td><td>$attacker_troops </td><td>Infantry Lost: </td><td>$infantry1loss</td></tr>
  <tr><td>Mercs Before: </td><td>$attacker_mercs </td><td>Mercs Lost: </td><td>$merc1loss</td></tr>
  <tr><td>Tanks Before: </td><td>$attacker_tanks </td><td>Tanks Lost: </td><td>$tank1loss</td></tr>
        <tr><td>F16s Before: </td><td>$attacker_f16s </td><td>F16s Lost: </td><td>$f161loss</td></tr>
  <tr><td>AC130s Before: </td><td>$attacker_ac130s </td><td>AC130s Lost: </td><td>$ac1301loss</td></tr>

  <tr><td colspan=\"4\"><b>Acquired Resources</b></td></tr>
  <tr><td>Food: </td><td colspan=\"4\">$farm_res</td></tr>
  <tr><td>Culture: </td><td colspan=\"4\">$cult_res</td></tr>
  <tr><td>Goods: </td><td colspan=\"4\">$inds_res</td></tr>
  <tr><td colspan=\"4\"><b>Defender:</b></td></tr>
  <tr><td colspan=\"4\">$defender</td></tr>
  <tr><td>Infantry Before: </td><td>$defender_troops </td><td>Infantry Lost: </td><td>$infantry2</td></tr>
  <tr><td>Mercs Before: </td><td>$defender_mercs </td><td>Mercs Lost: </td><td>$mercs2</td></tr>
  <tr><td>Tanks Before: </td><td>$defender_tanks </td><td>Tanks Lost: </td><td>$tanks2</td></tr>
  <tr><td>Mines Before: </td><td>$defender_mines </td><td>Tanks Lost: </td><td>$mines2</td></tr>
        <tr><td>F16s Before: </td><td>$defender_f16s </td><td>F16s Lost: </td><td>$f162</td></tr>
  <tr><td>AC130s Before: </td><td>$defender_ac130s </td><td>AC130s Lost: </td><td>$ac1302</td></tr></table>";




    mysql_query("INSERT INTO messages (user, fromuser, subject, body, date) VALUES ( '$attacker', 'World Organization', '$subject', '$body', Now())", $db);
    mysql_query("UPDATE members SET new_message = new_message + 1 WHERE member_id = '$id'", $db);
    mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', '$body', Now())", $logdb);

    $subject2 = "Battle Report";
    $body2 = "<table class=\"stats\"><tr><td colspan=\"4\"><b>Attacker:</b></td></tr>
  <tr><td colspan=\"4\">$attacker</td></tr>
  <tr><td>Infantry Before: </td><td>$attacker_troops </td><td>Infantry Lost: </td><td>$infantry1loss</td></tr>
  <tr><td>Mercs Before: </td><td>$attacker_mercs </td><td>Mercs Lost: </td><td>$merc1loss</td></tr>
  <tr><td>Tanks Before: </td><td>$attacker_tanks </td><td>Tanks Lost: </td><td>$tank1loss</td></tr>
        <tr><td>F16s Before: </td><td>$attacker_f16s </td><td>F16s Lost: </td><td>$f161loss</td></tr>
  <tr><td>AC130s Before: </td><td>$attacker_ac130s </td><td>AC130s Lost: </td><td>$ac1301loss</td></tr>
  <tr><td colspan=\"4\"><b>Acquired Resources</b></td></tr>
  <tr><td>Food: </td><td colspan=\"4\">$farm_res</td></tr>
  <tr><td>Culture: </td><td colspan=\"4\">$cult_res</td></tr>
  <tr><td>Goods: </td><td colspan=\"4\">$inds_res</td></tr>
  <tr><td colspan=\"4\"><b>Defender:</b></td></tr>
  <tr><td colspan=\"4\">$defender</td></tr>
  <tr><td>Infantry Before: </td><td>$defender_troops </td><td>Infantry Lost: </td><td>$infantry2</td></tr>
  <tr><td>Mercs Before: </td><td>$defender_mercs </td><td>Mercs Lost: </td><td>$mercs2</td></tr>
  <tr><td>Tanks Before: </td><td>$defender_tanks </td><td>Tanks Lost: </td><td>$tanks2</td></tr>
      <tr><td>Mines Before: </td><td>$defender_mines </td><td>Mines Lost: </td><td>$mines2</td></tr>
           <tr><td>F16s Before: </td><td>$defender_f16s </td><td>F16s Lost: </td><td>$f162</td></tr>
  <tr><td>AC130s Before: </td><td>$defender_ac130s </td><td>AC130s Lost: </td><td>$ac1302</td></tr></table>";



    $mail_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
    while ($mail = mysql_fetch_array($mail_sql)) {
        $emailattacker = $mail['email'];
    }
    $mail_sql = mysql_query("SELECT * FROM members WHERE member_id = '$defender_id'", $db);
    while ($maildef = mysql_fetch_array($mail_sql)) {
        $emaildefender = $maildef['email'];
    }
    $headers = "From: nations@micronationsgame.com \r\n";
    $headers .= "Reply-To: nations@micronationsgame.com \r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $checkmailatt_sql = mysql_query("SELECT * FROM msettings WHERE member_id = '$id'", $db);
    while ($checkmailatt = mysql_fetch_array($checkmailatt_sql)) {
        if ($checkmailatt['warreports'] == "true") {
            mail($emailattacker, $subject, $body, $headers);
        }
    }
    $checkmaildef_sql = mysql_query("SELECT * FROM msettings WHERE member_id = '$defender_id'", $db);
    while ($checkmaildef = mysql_fetch_array($checkmaildef_sql)) {
        if ($checkmaildef['warreports'] == "true") {
            mail($emaildefender, $subject, $body, $headers);
        }
    }
    mysql_query("UPDATE pkill SET pkill = pkill + 1 WHERE member_id = '$id'", $db);
    mysql_query("UPDATE pkill SET ploss = ploss + 1 WHERE member_id = '$defender_id'", $db);

    mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$defender_id', '$body2', Now())", $logdb);
    mysql_query("INSERT INTO messages (user, fromuser, subject, body, date) VALUES ( '$defender', 'World Organization', '$subject2', '$body2', Now())", $db);
    mysql_query("UPDATE members SET new_message = new_message + 1 WHERE member_id = '$defender_id'", $db);
    //mysql_query("UPDATE military SET protection = protection + 1 WHERE member_id = '$id2_row[0]'", $db);
    mysql_query("UPDATE military SET infantry = infantry - '$infantry1loss', tanks = tanks - '$tank1loss', mercs = mercs - '$merc1loss' WHERE member_id = '$id'", $db);
    mysql_query("UPDATE military SET infantry = infantry - '$infantry2', tanks = tanks - '$tanks2', mercs = mercs - '$mercs2', mines = mines - '$mines2'  WHERE member_id = '$defender_id'", $db);
}
if ($total2 > $total1) {
    $loss = pow($total1 / $total2, 1.5);
    $infantry2loss = round($infantry2 * $loss);
    $tank2loss = round($tanks2 * $loss);
    $merc2loss = round($mercs2 * $loss);
    $mine2loss = round($mines2 * $loss);
    $f162loss = round($f162 * $loss);
    $ac1302loss = round($ac1302 * $loss);
    $losst = $loss * 100;
    $farm_res = 0;
    $inds_res = 0;
    $cult_res = 0;
    $subject = "Battle Report";
    $body = "<table class=\"stats\"><tr><td colspan=\"4\"><b>Attacker:</b></td></tr>
  <tr><td colspan=\"4\">$attacker</td></tr>
  <tr><td>Infantry Before: </td><td>$attacker_troops </td><td>Infantry Lost: </td><td>$infantry1</td></tr>
  <tr><td>Mercs Before: </td><td>$attacker_mercs </td><td>Mercs Lost: </td><td>$mercs1</td></tr>
  <tr><td>Tanks Before: </td><td>$attacker_tanks </td><td>Tanks Lost: </td><td>$tanks1</td></tr>
                 <tr><td>F16s Before: </td><td>$attacker_f16s </td><td>F16s Lost: </td><td>$f161</td></tr>
  <tr><td>AC130s Before: </td><td>$attacker_ac130s </td><td>AC130s Lost: </td><td>$ac1301</td></tr>
  <tr><td colspan=\"4\"><b>Acquired Resources</b></td></tr>
  <tr><td>Food: </td><td colspan=\"4\">$farm_res</td></tr>
  <tr><td>Culture: </td><td colspan=\"4\">$cult_res</td></tr>
  <tr><td>Goods: </td><td colspan=\"4\">$inds_res</td></tr>
  <tr><td colspan=\"4\"><b>Defender:</b></td></tr>
  <tr><td colspan=\"4\">$defender</td></tr>
  <tr><td>Infantry Before: </td><td>$defender_troops </td><td>Infantry Lost: </td><td>$infantry2loss</td></tr>
  <tr><td>Mercs Before: </td><td>$defender_mercs </td><td>Mercs Lost: </td><td>$merc2loss</td></tr>
  <tr><td>Tanks Before: </td><td>$defender_tanks </td><td>Tanks Lost: </td><td>$tank2loss</td></tr>
          <tr><td>Mines Before: </td><td>$defender_mines </td><td>Mines Lost: </td><td>$mine2loss</td></tr>
           <tr><td>F16s Before: </td><td>$defender_f16s </td><td>F16s Lost: </td><td>$f162loss</td></tr>
  <tr><td>AC130s Before: </td><td>$defender_ac130s </td><td>AC130s Lost: </td><td>$ac1302loss</td></tr></table>";

    mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', '$body', Now())", $logdb);
    mysql_query("INSERT INTO messages (user, fromuser, subject, body, date) VALUES ( '$attacker', 'World Organization', '$subject', '$body', Now())", $db);
    mysql_query("UPDATE members SET new_message = new_message + 1 WHERE member_id = '$id'", $db);
    $subject2 = "Battle Report";
    $body2 = "<table class=\"stats\"><tr><td colspan=\"4\"><b>Attacker:</b></td></tr>
      <tr><td colspan=\"4\">$attacker</td></tr>
  <tr><td>Infantry Before: </td><td>$attacker_troops </td><td>Infantry Lost: </td><td>$infantry1</td></tr>
  <tr><td>Mercs Before: </td><td>$attacker_mercs </td><td>Mercs Lost: </td><td>$mercs1</td></tr>
  <tr><td>Tanks Before: </td><td>$attacker_tanks </td><td>Tanks Lost: </td><td>$tanks1</td></tr>
  <tr><td>F16s Before: </td><td>$attacker_f16s </td><td>F16s Lost: </td><td>$f161</td></tr>
  <tr><td>AC130s Before: </td><td>$attacker_ac130s </td><td>AC130s Lost: </td><td>$ac1301</td></tr>
      
  <tr><td colspan=\"4\"><b>Acquired Resources</b></td></tr>
  <tr><td>Food: </td><td colspan=\"4\">$farm_res</td></tr>
  <tr><td>Culture: </td><td colspan=\"4\">$cult_res</td></tr>
  <tr><td>Goods: </td><td colspan=\"4\">$inds_res</td></tr>
  <tr><td colspan=\"4\"><b>Defender:</b></td></tr>
  <tr><td colspan=\"4\">$defender</td></tr>
  <tr><td>Infantry Before: </td><td>$defender_troops </td><td>Infantry Lost: </td><td>$infantry2loss</td></tr>
  <tr><td>Mercs Before: </td><td>$defender_mercs </td><td>Mercs Lost: </td><td>$merc2loss</td></tr>
  <tr><td>Tanks Before: </td><td>$defender_tanks </td><td>Tanks Lost: </td><td>$tank2loss</td></tr>
  <tr><td>Mines Before: </td><td>$defender_mines </td><td>Mines Lost: </td><td>$mine2loss</td></tr>  
  <tr><td>F16s Before: </td><td>$defender_f16s </td><td>F16s Lost: </td><td>$f162loss</td></tr>
  <tr><td>AC130s Before: </td><td>$defender_ac130s </td><td>AC130s Lost: </td><td>$ac1302loss</td></tr></table>
    
    ";
    $mail_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
    while ($mail = mysql_fetch_array($mail_sql)) {
        $emailattacker = $mail['email'];
    }
    $mail_sql = mysql_query("SELECT * FROM members WHERE member_id = '$defender_id'", $db);
    while ($maildef = mysql_fetch_array($mail_sql)) {
        $emaildefender = $maildef['email'];
    }
    $headers = "From: nations@micronationsgame.com \r\n";
    $headers .= "Reply-To: nations@micronationsgame.com \r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $checkmailatt_sql = mysql_query("SELECT * FROM msettings WHERE member_id = '$id'", $db);
    while ($checkmailatt = mysql_fetch_array($checkmailatt_sql)) {
        if ($checkmailatt['warreports'] == "true") {
            mail($emailattacker, $subject, $body, $headers);
        }
    }
    $checkmaildef_sql = mysql_query("SELECT * FROM msettings WHERE member_id = '$defender_id'", $db);
    while ($checkmaildef = mysql_fetch_array($checkmaildef_sql)) {
        if ($checkmaildef['warreports'] == "true") {
            mail($emaildefender, $subject, $body, $headers);
        }
    }
    mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$defender_id', '$body2', Now())", $logdb);
    mysql_query("INSERT INTO messages (user, fromuser, subject, body, date) VALUES ( '$defender', 'World Organization', '$subject2', '$body2', Now())", $db);
    mysql_query("UPDATE members SET new_message = new_message + 1 WHERE member_id = '$defender_id'", $db);
    //mysql_query("UPDATE military SET protection = protection + 1 WHERE member_id = '$id2_row[0]'", $db);

    mysql_query("UPDATE pkill SET pkill = pkill + 1 WHERE member_id = '$defender_id'", $db);
    mysql_query("UPDATE pkill SET ploss = ploss + 1 WHERE member_id = '$id'", $db);
    mysql_query("UPDATE military SET infantry = infantry - '$infantry1', tanks = tanks - '$tanks1', mercs = mercs - '$mercs1' WHERE member_id = '$id'", $db);
    mysql_query("UPDATE military SET infantry = infantry - '$infantry2loss', tanks = tanks - '$tank2loss', mercs = mercs - '$merc2loss', mines = mines - '$mine2loss' WHERE member_id = '$defender_id'", $db);
}



$errmsg_arr[] = 'Check your nation log for report info.';
$errflag = true;
if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    header("location: ../../member-index.php");
    exit();
}


echo "Debug:  Please copy this information down and send as a support request.  Check to make sure you have been subtracted the amount of troops it says above.<br>";
echo "Debug:  Resource looting is disabled.<br>";
echo "Debug:  Nation reports are disabled.<br>";
echo "Debug:  In game mail for battle reports is disabled.</br>";
echo "Debug:  <a href=\"battle.php\">Battle</a>";
?>


