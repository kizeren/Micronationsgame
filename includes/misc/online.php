

<h4>Who's Online:</h4><br>
<?php
$online_sql = mysql_query("SELECT * FROM members WHERE online = '1'", $db);
while ($online_row = mysql_fetch_array($online_sql))
{
    
    echo "<img width=\"40px\" height=\"40px\" src=\"$online_row[10]\"> <a href=\"public_profile.php?id=$online_row[0]\">$online_row[3]</a> ";
}
mysql_free_result($online_sql);
?>
