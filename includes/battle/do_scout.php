<?php
include('/home/mcbride/public_html/micronationsgame/config.php');

require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");
//$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
//$name = mysql_real_escape_string($_GET['name']);

$id = $_SESSION['SESS_MEMBER_ID'];
$name = mysql_real_escape_string($_GET['name']);

$infas = 1;
$helias = 2;

$id2 = mysql_query("SELECT * FROM members WHERE login = '$name'", $db);
$attacker = $_SESSION['SESS_LOGIN'];

while ($id2_row = mysql_fetch_array($id2)) {
    $troopcount1 = mysql_query("SELECT * FROM military WHERE member_id = '$id'", $db);
    $troopcount2 = mysql_query("SELECT * FROM military WHERE member_id = '$id2_row[0]'", $db);
    $money = $id2_row['money'];
    while ($tcount1 = mysql_fetch_array($troopcount1)) {




        while ($tcount2 = mysql_fetch_array($troopcount2)) {


            if ($tcount2[3] >= 3) {

                $errmsg_arr[] = 'You cannot attack this player they are under protection.';
                $errflag = true;
            }
            $newb_sql = mysql_query("SELECT * FROM newb_prot WHERE member_id = '$id2_row[0]'", $db);
            while ($newb = mysql_fetch_assoc($newb_sql)) {
                if ($newb['isnewb'] > 0) {

                    $errmsg_arr[] = 'You cannot attack this player they are under newbie protection.';
                    $errflag = true;
                }
            }
            if ($tcount1[3] >= 3) {

                $errmsg_arr[] = 'You cannot attack. You are under protection.';
                $errflag = true;
            }
            if ($errflag) {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                header("location: ../../member-index.php");
                exit();
            }


            $player1 = $tcount1[5];
            $player2 = $tcount2[5];


            $percent = round($player1 / $player2 * 100);
            echo "Percent: $percent<br>";
            if ($percent > '10000') {
                echo "Player 1 cannot attack.<br>";
                $errmsg_arr[] = 'You are to powerful to attack them.';
                $errflag = true;
            }

            if ($tcount1[1] == $tcount2[1]) {

                $errmsg_arr[] = 'You cannot attack yourself.';
                $errflag = true;
            }
            /*
              if($player1 < 100)
              {

              $errmsg_arr[] = 'You do not have enough troops.';
              $errflag = true;


              }
             */

            if ($errflag) {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                header("location: ../../member-index.php");
                exit();
            }

//spies
            if ($player1 > $player2) {
                $p2loss = $player2;
                echo "Player2 loss: $p2loss out of $player2<br>";
                $p1loss = $p2loss;
                echo "Player1 loss: $p1loss out of $player1<br>";

                mysql_query("UPDATE military SET spies = spies - '$p1loss' WHERE member_id = '$id'", $db);
                mysql_query("UPDATE military SET spies = spies - '$p2loss' WHERE member_id = '$id2_row[0]'", $db);
                mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', 'You attacked $id2_row[3] and lost $p1loss.', Now())", $logdb);
                mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id2_row[0]', 'You where attacked by $attacker and lost $p2loss.', Now())", $logdb);
            }
            if ($player1 < $player2) {

                echo "Player2 loss: $p2loss out of $player2<br>";
                $p1loss = $player1;
                echo "Player1 loss: $p1loss out of $player1<br>";
                $p2loss = $p1loss;
                mysql_query("UPDATE military SET spies = spies - '$p1loss' WHERE member_id = '$id'", $db);
                mysql_query("UPDATE military SET spies = spies - '$p2loss' WHERE member_id = '$id2_row[0]'", $db);
                mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', 'You attacked $id2_row[3] and lost $p1loss.', Now())", $logdb);
                mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id2_row[0]', 'You where attacked by $attacker and lost $p2loss.', Now())", $logdb);
            }


            if ($player1 > $player2) {

                $defender = $id2_row[3];

                

                
                
                mysql_query("UPDATE members SET money = money + '$money' WHERE member_id = '$id'", $db);
                mysql_query("UPDATE members SET money = money - '$money' WHERE member_id = '$id2_row[0]'", $db);
                mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id2_row[3]', 'You lost $money money from that attack.', Now())", $logdb);
                mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', 'You gained $money money from that attack.', Now())", $logdb);
                $subject = "Battle Report";
                $body = "<center>You attacked <b>$defender</b><br>
           <table class=\"stats\"><tr><td colspan=\"4\"><b>Attacker:</b></td></tr>
           <tr><td colspan=\"4\">$attacker</td></tr>
           <tr><td>Before: </td><td>$player1 </td><td>Lost: </td><td>$p1loss</td></tr>
           <tr><td colspan=\"4\"><b>Acquired Resources</b></td></tr>
           <tr><td>Money Collected: </td><td colspan=\"4\">$moneyt</td></tr>
           <tr><td colspan=\"4\"><b>Defender:</b></td></tr>
           <tr><td colspan=\"4\">$defender</td></tr>
           <tr><td>Before: </td><td>$player2 </td><td>Lost: </td><td>$p2loss</td></tr>
	   </table>
           </center>";

                mysql_query("INSERT INTO messages (user, fromuser, subject, body, date) VALUES ( '$attacker', 'World Organization', '$subject', '$body', Now())", $db);
                mysql_query("UPDATE members SET new_message = new_message + 1 WHERE member_id = '$id'", $db);
                $subject2 = "Battle Report";
                $body2 = "<center>You where attacked by <b>$attacker</b><br>
           <table class=\"stats\"><tr><td colspan=\"4\"><b>Attacker:</b></td></tr>
           <tr><td colspan=\"4\">$attacker</td></tr>
           <tr><td>Before: </td><td>$player1 </td><td>Lost: </td><td>$p1loss</td></tr>
           <tr><td colspan=\"4\"><b>Acquired Resources</b></td></tr>
           <tr><td>Money Collected: </td><td colspan=\"4\">$money</td></tr>
           <tr><td colspan=\"4\"><b>Defender:</b></td></tr>
           <tr><td colspan=\"4\">$defender</td></tr>
           <tr><td>Before: </td><td>$player2 </td><td>Lost: </td><td>$p2loss</td></tr>
	   </table>
           </center>";
                mysql_query("INSERT INTO messages (user, fromuser, subject, body, date) VALUES ( '$id2_row[3]', 'World Organization', '$subject2', '$body2', Now())", $db);
                mysql_query("UPDATE members SET new_message = new_message + 1 WHERE member_id = '$id2_row[0]'", $db);
                mysql_query("UPDATE military SET protection = protection + 1 WHERE member_id = '$id2_row[0]'", $db);
            } else {
                mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', 'You gained nothing from that attack.', Now())", $db);
                $subject = "Battle Report";
                $body = "<center>You attacked <b>$defender</b><br>
           <table class=\"stats\"><tr><td colspan=\"4\"><b>Attacker:</b></td></tr>
           <tr><td colspan=\"4\">$attacker</td></tr>
           <tr><td>Before: </td><td>$player1 </td><td>Lost: </td><td>$p1loss</td></tr>
           <tr><td colspan=\"4\"><b>Acquired Resources</b></td></tr>
           <tr><td>Money Aquired: </td><td colspan=\"4\">$money</td></tr>
	   <tr><td colspan=\"4\"><b>Defender:</b></td></tr>
           <tr><td colspan=\"4\">$defender</td></tr>
           <tr><td>Before: </td><td>$player2 </td><td>Lost: </td><td>$p2loss</td></tr>
	   </table>
           </center>";
                mysql_query("INSERT INTO messages (user, fromuser, subject, body, date) VALUES ( '$attacker', 'World Organization', '$subject', '$body', Now())", $db);
                mysql_query("UPDATE members SET new_message = new_message + 1 WHERE member_id = '$id'", $db);
                $subject2 = "Battle Report";
                $body2 = "<center>You where attacked by <b>$attacker</b><br>
           <table class=\"stats\"><tr><td colspan=\"4\"><b>Attacker:</b></td></tr>
           <tr><td colspan=\"4\">$attacker</td></tr>
           <tr><td>Before: </td><td>$player1 </td><td>Lost: </td><td>$p1loss</td></tr>
           <tr><td colspan=\"4\"><b>Acquired Resources</b></td></tr>
           <tr><td>Money Aquired: </td><td colspan=\"4\">$money</td></tr>
	   <tr><td colspan=\"4\"><b>Defender:</b></td></tr>
           <tr><td colspan=\"4\">$defender</td></tr>
           <tr><td>Before: </td><td>$player2 </td><td>Lost: </td><td>$p2loss</td></tr>
	   </table>
           </center>";
                mysql_query("INSERT INTO messages (user, fromuser, subject, body, date) VALUES ( '$id2_row[3]', 'World Organization', '$subject2', '$body2', Now())", $db);
                mysql_query("UPDATE members SET new_message = new_message + 1 WHERE member_id = '$id2_row[0]'", $db);
                mysql_query("UPDATE military SET protection = protection + 1 WHERE member_id = '$id2_row[0]'", $db);
            }
        }
    }
}

$errmsg_arr[] = 'Check your nation log for report info.';
$errflag = true;
if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    header("location: ../../member-index.php");
    exit();
}
?>


