<?php  
include("config.php");

  include("$directory/includes/config/auth.php");
  include("$directory/includes/misc/include.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Information Update</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="banner">
<h1>Update your MicroNation.</h1>
<?php
include("$directory/includes/misc/clock.php");
echo "</div>";
include("$directory/includes/menus/newmenu.php");
echo "<div id=\"main\">";
$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$result = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);
$langid = $_SESSION['SESS_LANG'];

$language_sql = mysql_query("SELECT * FROM lang_update WHERE lang = '$langid'", $langdb);
while($langrow = mysql_fetch_array($language_sql))
{
    $l1 = $langrow['1'];
    $l2 = $langrow['2'];
    $l3 = $langrow['3'];
    $l4 = $langrow['4'];
    $l5 = $langrow['5'];
       $l6 = $langrow['6']; 
        $l7 = $langrow['7'];
      $l8 = $langrow['8'];
    $l9 = $langrow['9'];
        $l10 = $langrow['10'];
}  
while($row = mysql_fetch_array($result))
{
  echo "<table>";
  echo "<form action=\"./includes/misc/settingsapply.php\" method=\"get\">";
  echo "<tr><td>$l1: </td><td><input class=\"textfield\" type=\"text\" value=\"$row[5]\" name=\"nation\" /></td></tr>";

  echo "<tr><td>$l2: </td><td><input class=\"textfield\" type=\"text\" value=\"$row[6]\" name=\"motto\" /></td></tr>";

  echo "<tr><td>$l3: </td><td><input class=\"textfield\" type=\"text\" value=\"$row[7]\" name=\"monetary\" /></td></tr>";

  echo "<tr><td>$l4: </td><td><input class=\"textfield\" type=\"text\" value=\"$row[8]\" name=\"tree\" /></td></tr>";

  echo "<tr><td>$l5: </td><td><input class=\"textfield\" type=\"text\" value=\"$row[9]\" name=\"plant\" /></td></tr>";

  echo "<tr><td>$l6: </td><td><input class=\"textfield\" type=\"text\" value=\"$row[10]\" name=\"flag\" /> &nbsp&nbsp<a href=\"flags.php\">$l10</a></td></tr>";
  echo "<tr><td><img width=\"40px\" height=\"20px\" src=\"$row[10]\"> </td></tr>";
  echo "<tr><td>$l7: </td><td><input type=\"text\" class=\"textfield\" value=\"$row[15]\" name=\"tax\" /></td></tr>";

  echo "<tr><td>$l8: </td><td><input type=\"text\" class=\"textfield\" value=\"$row[26]\" name=\"religion\" /></td></tr>";

  $lonlat = mysql_query("SELECT * FROM map_coords WHERE member_id = '$id'", $db);
  while($longlatrow = mysql_fetch_array($lonlat))
  {
  echo "<tr><td>$l9: </td><td><input type=\"text\" class=\"textfield\" value=\"$longlatrow[2]\" name=\"lat\" /><input type=\"text\" class=\"textfield\" value=\"$longlatrow[3]\" name=\"lon\" /></td></tr>";
 
  }
  echo "<tr><td><input type=\"submit\" value=\"submit\"></td></tr>";
  echo "</form>";
  echo "</table>";
  echo "</td></tr></table>";
  


}
include("$directory/includes/misc/online.php"); 
echo "</div>";
include("$directory/includes/misc/count.php"); 
include("$directory/includes/misc/footer.php");
echo "</body>";
echo "</html>";
?>