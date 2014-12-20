<?php

include('/home/mcbride/public_html/micronationsgame/config.php');

require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");
$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$sat_sql = mysql_query("SELECT * FROM satellites WHERE member_id = '$id' AND satrep = 0", $db);

while ($sat_row = mysql_fetch_array($sat_sql)) {
    $mil_sql = mysql_query("SELECT * FROM military WHERE member_id = '$sat_row[2]'", $db);
    while ($mil_row = mysql_fetch_array($mil_sql)) {
        $user_sql = mysql_query("SELECT * FROM members WHERE member_id = '$sat_row[2]'", $db);
        while ($user_row = mysql_fetch_array($user_sql)) {

            if ($sat_row[4] == 1) {
                return;
            } else {

                $fromuser = mysql_real_escape_string($_SESSION['SESS_LOGIN']);
                $subject = "Intelligence Report";
                                if ($mil_row[9] >= 26 && $mil_row[9] <= 30) {
                    $body = "<center> <b>$user_row[5]</b><br>
    Number of Mercinaries: $mil_row[11]<br>
           Number of Troops: $mil_row[2]<br>
           Number of Spies: $mil_row[5]<br>
           Number of Tanks: $mil_row[10]<br>
               Number of Transports: $mil_row[13]</br>
           </center>";
                }
                if ($mil_row[9] >= 20 && $mil_row[9] <= 25) {
                    $body = "<center> <b>$user_row[5]</b><br>
    Number of Mercinaries: $mil_row[11]<br>
           Number of Troops: $mil_row[2]<br>
           Number of Spies: $mil_row[5]<br>
           Number of Tanks: $mil_row[10]<br>
           </center>";
                }
                if ($mil_row[9] >= 10 && $mil_row[9] <= 19) {
                    $body = "<center> <b>$user_row[5]</b><br>
        Number of Mercinaries: $mil_row[11]<br>
           Number of Troops: $mil_row[2]<br>
           Number of Spies: $mil_row[5]<br>
           </center>";
                }
                if ($mil_row[9] >= 1 && $mil_row[9] <= 9) {
                    $body = "<center> <b>$user_row[5]</b><br>
                        Number of Mercinaries: $mil_row[11]<br>
           Number of Troops: $mil_row[2]<br>
           </center>";
                }
                mysql_query("INSERT INTO messages (user, fromuser, subject, body, date) VALUES ( '$fromuser', 'Satellite Intelligence', '$subject', '$body', Now())", $db);
                mysql_query("UPDATE members SET new_message = new_message + 1 WHERE member_id = '$id'", $db);
                mysql_query("UPDATE satellites SET satrep = 1 WHERE member_id = '$id'", $db);
                mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', '$body', Now())", $logdb);
            }
        }
    }
}
?>
