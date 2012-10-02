<?php
$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
mysql_query("UPDATE members SET ttd = 0, online = '1' WHERE member_id = '$id'", $db);
mysql_query("SELECT SUM( popcount ) FROM members", $db);
mysql_query("UPDATE members SET homeless = popcount - housing WHERE member_id = '$id'", $db);
mysql_query("UPDATE members SET homeless = 0 WHERE homeless < 0 AND member_id = '$id'", $db);
mysql_query("UPDATE members SET jobless = popcount - working WHERE member_id = '$id'", $db);
mysql_query("UPDATE members SET working = work_ind + work_comm + work_farm WHERE member_id = '$id'", $db);


?>
