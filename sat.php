<?php
include("config.php");

require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Satellites</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="banner">   
<h1>Satellites </h1>
<?php 
$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);

include("$directory/includes/misc/clock.php");
echo "</div>";
echo "<div id=\"main\">";
include("$directory/includes/misc/resource.php");

include("$directory/includes/misc/infomsg.php");
    include("$directory/includes/menus/newmenu.php");

echo "Select a nation to place a new satellite.<br>";

echo "<table>";
echo "<form id=\"loginForm\" name=\"name\" method=\"get\" action=\"./includes/misc/placesat.php\">
      <tr><td colspan=\"2\">Nation name?</td></tr>
      <tr><td><input name=\"name\" type=\"text\" class=\"textfield\" id=\"name\" /></td>
      <td><input type=\"submit\" value=\"Place Sat\" /></td></tr>";
echo "</form>";
echo "</table>";

echo "<br><br>";
echo "Current satellites:<br>";
$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$sat_sql = mysql_query("SELECT * FROM satellites WHERE member_id = '$id'", $db);
while($sat_row = mysql_fetch_array($sat_sql))
{
    $sat_sql2 = mysql_query("SELECT * FROM members WHERE member_id = '$sat_row[2]'", $db);
    while($sat_row2 = mysql_fetch_array($sat_sql2))
    {
        echo "$sat_row2[3]<br>";
    }

}







echo "</div>";
    include("$directory/includes/misc/online.php");

    include("$directory/includes/misc/footer.php");

echo "</body>";

echo "</html>";
?>