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
$trans = mysql_real_escape_string($_GET['trans']);
$defender_id = mysql_real_escape_string($_GET['rogid']);
$attacker = $_SESSION['SESS_LOGIN'];
$attacker_id = $id;

$attacker_t_sql = mysql_query("SELECT * FROM military WHERE member_id = '$id'", $db);

$defender_t_sql = mysql_query("SELECT * FROM roguenations WHERE id = '$defender_id' AND name = '$defender'", $db);
while ($attacker_t_row = mysql_fetch_array($attacker_t_sql)) {
    while ($defender_t_row = mysql_fetch_array($defender_t_sql)) {
        $defender_protection = $defender_t_row['protection'];
        $defender_troops = $defender_t_row['infantry'];
        $defender_tanks = $defender_t_row['tanks'];
        $defender_mines = $defender_t_row['mines'];
        $defender_mercs = $defender_t_row['mercs'];
        $defender_food = $defender_t_row['food'];
        $defender_culture = $defender_t_row['culture'];
        $defender_goods = $defender_t_row['goods'];
        $attacerk_id = $id;
        $attacker_troops = $troops;
        $attacker_tanks = $tanks;
        $attacker_mercs = $mercs;
        $attacker_trans = $trans;
        $attacker_protection = $attacker_t_sql['protection'];
    }
}
        if($defender_id == '') {
		$errmsg_arr[] = 'Please use the map to select a rogue nation first!';
		$errflag = true;
	}
if ($attacker_protection >= 3) {

    $errmsg_arr[] = 'You cannot attack. You are under protection.';
    $errflag = true;
}
$attacker_military_sql = mysql_query("SELECT * FROM military WHERE member_id = '$attacker_id'", $db);
while($attacker_military_row = mysql_fetch_array($attacker_military_sql))
{
    if($troops > $attacker_military_row['infantry'])  {
        $errmsg_arr[] = 'You do not have that many infantry.';
        $errflag = true;
    }
        if($tanks > $attacker_military_row['tanks'])  {
        $errmsg_arr[] = 'You do not have that many tanks.';
        $errflag = true;
    }
        if($mercs > $attacker_military_row['mercs'])  {
        $errmsg_arr[] = 'You do not have that many mercs.';
        $errflag = true;
    }
            if($trans > $attacker_military_row['transports'])  {
        $errmsg_arr[] = 'You do not have that many transports.';
        $errflag = true;
    }
    
}
if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    header("location: ../../member-index.php");
    echo "Debug: Error message seen.<br>";
    exit();
}

//Start the battle

$infantry1 = $troops;
$tanks1 = $tanks;
$mercs1 = $mercs;
$trans1 = $trans;

$infantry2 = $defender_troops;
$tanks2 = $defender_tanks;
$mercs2 = $defender_mercs;
$mines2 = $defender_mines;

$total1def = (($infantry1 * $infantrydef) + ($tanks1 * $tankdef) + ($mercs1 * $mercdef) + ($trans1 * $trans1hit));
$total1hit = (($infantry1 * $infantryhit) + ($tanks1 * $tankhit) + ($mercs1 * $merchit) + ($trans1 * $trans1def));

$total2def = (($defender_troops * $infantrydef) + ($tanks2 * $tankdef) + ($mercs2 * $mercdef) + ($mines2 * $minedef));
$total2hit = (($defender_troops * $infantryhit) + ($tanks2 * $tankhit) + ($mercs2 * $merchit));




$total1 = $total1hit;
$total2 = $total2def;


if ($total1 > $total2) {
    //Calc losses
    $loss = pow($total2 / $total1, 1.5);
    $infantry1loss = round($infantry1 * $loss);
    $tank1loss = round($tanks1 * $loss);
    $merc1loss = round($mercs1 * $loss);
    $trans1loss = round($trans1 * $loss);
    
    $losst = $loss * 100;
    
    
    //calc res raided
    $icarry = ($infantry1 - $infantry1loss) * $infantrycarry;    
    $tcarry = ($tanks1 - $trank1loss) * $tankcarry;
    $mcarry = ($mercs1 - $merc1loss) * $merccarry;
    $tcarry = ($trans - $trans1loss) * $transcarry;
    
    $totalcarry = $icarry + $tcarry + $mcarry + $tcarry;
    
    if($totalcarry > $defender_food)
    {
        $foodcarry = $defender_food;
    }
    if($totalcarry > $defender_culture)
    {
        $cultcarry = $defender_culture;
    }
    if($totalcarry > $defender_goods)
    {
        $goodscarry = $defender_goods;
    }
    
    if($totalcarry < $defender_food)
    {
        $foodcarry = $totalcarry;
    }
    if($totalcarry < $defender_culture)
    {
        $cultcarry = $totalcarry;
    }
    if($totalcarry < $defender_goods)
    {
        $goodscarry = $totalcarry;
    }
    
    
    $goldnumber = rand(0, 100);
    
    if ($goldnumber < 10)
    {
        $goldbar = "<tr><td colspan=\"4\">You found a gold bar.</td></tr>";
        mysql_query("UPDATE resources SET gold = gold + 1 WHERE member_id = '$attacker_id'", $db);
    }
    if ($goldnumber > 10)
    {
                $goldbar = "";

    }
    
        $leadnumber = rand(0, 100);
    
    if ($leadnumber < 49)
    {
        $leadbar = "<tr><td colspan=\"4\">You found a lead bar.</td></tr>";
        mysql_query("UPDATE lead_mine SET lead = lead + 1 WHERE member_id = '$attacker_id'", $db);
    }
    if ($leadnumber > 50)
    {
                $leadbar = "";

    }
    
    
    mysql_query("UPDATE resources SET food = food + '$foodcarry', culture = culture + '$cultcarry', goods = goods + '$goodscarry' WHERE member_id = '$id'", $db);
    mysql_query("UPDATE roguenations SET food = food - '$foodcarry', culture = culture - '$cultcarry', goods = goods - '$goodscarry' WHERE id = '$defender_id'", $db);
    $subject = "Battle Report";
    $body = "<table class=\"stats\"><tr><td colspan=\"4\"><b>Attacker:</b></td></tr>
  <tr><td colspan=\"4\">$attacker</td></tr>
  <tr><td>Infantry Before: </td><td>" . number_format($attacker_troops) . "</td><td>Infantry Lost: </td><td>" . number_format($infantry1loss) . "</td></tr>
  <tr><td>Mercs Before: </td><td>" . number_format($attacker_mercs) .  "</td><td>Mercs Lost: </td><td>" . number_format($merc1loss) . "</td></tr>
  <tr><td>Tanks Before: </td><td>" . number_format($attacker_tanks) .  "</td><td>Tanks Lost: </td><td>" . number_format($tank1loss) . "</td></tr>
  <tr><td>Transports Before: </td><td>" . number_format($attacker_trans) .  "</td><td>Transports Lost: </td><td>" . number_format($trans1loss) . "</td></tr>
<tr><td colspan=\"4\"><b>Acquired Resources</b></td></tr>
  <tr><td>Food: </td><td colspan=\"4\">" . number_format($foodcarry) . "</td></tr>
  <tr><td>Culture: </td><td colspan=\"4\">" . number_format($cultcarry) . "</td></tr>
  <tr><td>Goods: </td><td colspan=\"4\">" . number_format($goodscarry) . "</td></tr>
    $goldbar<br>
    $leadbar<br>
  <tr><td colspan=\"4\"><b>Defender:</b></td></tr>
  <tr><td colspan=\"4\">$defender</td></tr>
  <tr><td>Infantry Before: </td><td>" . number_format($defender_troops) . "</td><td>Infantry Lost: </td><td>" . number_format($infantry2) . "</td></tr>
  <tr><td>Mercs Before: </td><td>" . number_format($defender_mercs) . "</td><td>Mercs Lost: </td><td>" . number_format($mercs2) . "</td></tr>
  <tr><td>Tanks Before: </td><td>" . number_format($defender_tanks) . "</td><td>Tanks Lost: </td><td>" . number_format($tanks2) . "</td></tr>
  <tr><td>Mines Before: </td><td>" . number_format($defender_mines) . "</td><td>Tanks Lost: </td><td>" . number_format($mines2) . "</td></tr></table>";

      $mail_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
    while($mail = mysql_fetch_array($mail_sql))
    {
        $emailattacker = $mail['email'];
    }
        $mail_sql = mysql_query("SELECT * FROM members WHERE member_id = '$defender_id'", $db);
    while($maildef = mysql_fetch_array($mail_sql))
    {
        $emaildefender = $maildef['email'];
    }             
            $headers = "From: nations@micronationsgame.com \r\n";
            $headers .= "Reply-To: nations@micronationsgame.com \r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
            $checkmail_sql = mysql_query("SELECT * FROM msettings WHERE member_id = '$id'", $db);
            while($checkmail = mysql_fetch_array($checkmail_sql))
            {
            if($checkmail['warreports'] == "true")
            {
            mail($emailattacker, $subject, $body, $headers); 
            mail($emaildefender, $subject, $body, $headers);  

            }
            }
     
    
    
    
    
    mysql_query("INSERT INTO messages (user, fromuser, subject, body, date) VALUES ( '$attacker', 'World Organization', '$subject', '$body', Now())", $db);
    mysql_query("UPDATE members SET new_message = new_message + 1 WHERE member_id = '$id'", $db);
    mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', '$body', Now())", $logdb);
    mysql_query("UPDATE military SET infantry = infantry - '$infantry1loss', tanks = tanks - '$tank1loss', mercs = mercs - '$merc1loss', transports = transports - '$trans1loss' WHERE member_id = '$id'", $db);
    mysql_query("UPDATE roguenations SET infantry = infantry - '$infantry2', tanks = tanks - '$tanks2', mercs = mercs - '$mercs2', mines = mines - '$mines2'  WHERE id = '$defender_id'", $db);
}
if ($total2 > $total1) {
    $loss = pow($total1 / $total2, 1.5);
    $infantry2loss = round($infantry2 * $loss);
    $tank2loss = round($tanks2 * $loss);
    $merc2loss = round($mercs2 * $loss);
    $mine2loss = round($mines2 * $loss);
    $losst = $loss * 100;
    $farm_res = 0;
    $inds_res = 0;
    $cult_res = 0;
    $subject = "Battle Report";
    $body = "<table class=\"stats\"><tr><td colspan=\"4\"><b>Attacker:</b></td></tr>
  <tr><td colspan=\"4\">$attacker</td></tr>
  <tr><td>Infantry Before: </td><td>" . number_format($attacker_troops) . "</td><td>Infantry Lost: </td><td>" . number_format($infantry1) . "</td></tr>
  <tr><td>Mercs Before: </td><td>" . number_format($attacker_mercs) . "</td><td>Mercs Lost: </td><td>" . number_format($mercs1) . "</td></tr>
  <tr><td>Tanks Before: </td><td>" . number_format($attacker_tanks) . "</td><td>Tanks Lost: </td><td>" . number_format($tanks1) . "</td></tr>
   <tr><td>Transports Before: </td><td>" . number_format($attacker_trans) .  "</td><td>Transports Lost: </td><td>" . number_format($trans1) . "</td></tr>
            <tr><td colspan=\"4\"><b>Defender:</b></td></tr>
  <tr><td colspan=\"4\">$defender</td></tr>
  <tr><td>Infantry Before: </td><td>" . number_format($defender_troops) . " </td><td>Infantry Lost: </td><td>" . number_format($infantry2loss) . "</td></tr>
  <tr><td>Mercs Before: </td><td>" . number_format($defender_mercs) . " </td><td>Mercs Lost: </td><td>" . number_format($merc2loss) . "</td></tr>
  <tr><td>Tanks Before: </td><td>" . number_format($defender_tanks) . " </td><td>Tanks Lost: </td><td>" . number_format($tank2loss) . "</td></tr>
          <tr><td>Mines Before: </td><td>" . number_format($defender_mines) . " </td><td>Mines Lost: </td><td>" . number_format($mine2loss) . "</td></tr>  </table>";

          $mail_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
    while($mail = mysql_fetch_array($mail_sql))
    {
        $emailattacker = $mail['email'];
    }
        $mail_sql = mysql_query("SELECT * FROM members WHERE member_id = '$defender_id'", $db);
    while($maildef = mysql_fetch_array($mail_sql))
    {
        $emaildefender = $maildef['email'];
    }             
            $headers = "From: nations@micronationsgame.com \r\n";
            $headers .= "Reply-To: nations@micronationsgame.com \r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
            $checkmail_sql = mysql_query("SELECT * FROM msettings WHERE member_id = '$id'", $db);
            while($checkmail = mysql_fetch_array($checkmail_sql))
            {
            if($checkmail['warreports'] == "true")
            {
            mail($emailattacker, $subject, $body, $headers); 
            mail($emaildefender, $subject, $body, $headers);  

            }
            }
    
    mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', '$body', Now())", $logdb);
    mysql_query("INSERT INTO messages (user, fromuser, subject, body, date) VALUES ( '$attacker', 'World Organization', '$subject', '$body', Now())", $db);
    mysql_query("UPDATE members SET new_message = new_message + 1 WHERE member_id = '$id'", $db);
    mysql_query("UPDATE military SET infantry = infantry - '$infantry1', tanks = tanks - '$tanks1', mercs = mercs - '$mercs1', transports = transports = '$trans1' WHERE member_id = '$id'", $db);
    mysql_query("UPDATE roguenations SET infantry = infantry - '$infantry2loss', tanks = tanks - '$tank2loss', mercs = mercs - '$merc2loss' mines = mines - '$mine2loss' WHERE id = '$defender_id'", $db);
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





