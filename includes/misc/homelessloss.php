<?php
$homeless = number_format((($row['homeless'] / $row['popcount']) * 100), 2);
if ( $homeless > 75)
{
    echo "Your homeless is to great. Several have left your nation!";
    mysql_query("UPDATE members SET popcount = popcount - (homeless/ 10) WHERE member_id = '$id' ");
    mysql_query("UPDATE members SET homeless = popcount - housing WHERE member_id = '$id' ");
    mysql_query("UPDATE members SET jobless = popcount - working WHERE member_id = '$id' ");
    mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', 'You lost 10% of your population because your homeless percent was highier then 75!!', Now())");

}
?>