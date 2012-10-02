<?php
  include("./includes/config/auth.php");
  include("./includes/config/config.php");
  include("./includes/misc/include.php");
       

echo "<html>";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
echo "<title>National Information</title>";
echo "<link href=\"loginmodule.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "</head>";
echo "<body>";
echo "<div id=\"banner\">";
echo "<h1>Welcome ";
echo $_SESSION['SESS_LOGIN'];
echo " to $game_name <img src=\"http://mcbride.homelinux.net/~nations/flags/beta_icon.gif\"></h1>";
echo "</div>";
include("newmenu.php");
echo "<div id=\"main\">";
include("$directory/includes/misc/resource.php");

echo "<table id=\"table-news\">";
$result = mysql_query("SELECT * FROM news ORDER BY id DESC", $db);

while($row = mysql_fetch_array($result))
{

   

   echo "<tr><td align=\"left\">";
   echo "Message ID: $row[0]</td><td align=\"left\">Title: <a href=\"selectnews.php?id=$row[0]\">$row[1]</a></td><td align=\"left\">Date: $row[3]</td><td align=\"left\">From: $row[4]";
   echo "</td></tr>";


}



echo "</table>";
include("online.php");
echo "</div>";
include("count.php"); include("footer.php");
echo "</body>";
echo "</html>";
