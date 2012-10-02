<?php  
include("config.php");

  include("$directory/includes/config/auth.php");
  include("$directory/includes/misc/include.php");
$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$result = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);
$name = $_SESSION['SESS_LOGIN'];
echo "<html>";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
echo "<title>National Information</title>";
echo "<link href=\"loginmodule.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "</head>";
echo "<body>";
echo "<div id=\"banner\">";
echo "<h1>Welcome ";
echo $name;
echo " to $game_name <img src=\"http://mcbride.homelinux.net/~nations/flags/beta_icon.gif\"></h1>";
 
include("$directory/includes/misc/clock.php");
echo "</div>";
echo "<div id=\"main\">";
include("$directory/includes/menus/newmenu.php");
include("infomsg.php");
 
 echo"<table>";
 echo "<form id=\"loginForm\" name=\"support\" method=\"get\" action=\"do_support.php\">";
 echo "<tr><td>Please fill out below information</td><tr>";
 echo "<tr><td>Name:</td><td>$name</td></tr>";
 echo "<tr><td>World:</td><td>$world</td></tr>";
echo "<tr><td>Description of the problem:</td><td> <textarea cols=\"100\" rows=\"10\" value=\"\" name=\"description\"></textarea></td></tr>";
echo "<input type=\"hidden\" value=\"$name\" name=\"name\" /> <input type=\"hidden\" value=\"$world\" name=\"world\" />";
echo "<tr><td></td><td><input type=\"submit\" value=\"Submit\" /></td></tr>";
echo "</table>";
 
 



// Not working as I want yet.
// include("homelessloss.php");
    include("$directory/includes/misc/online.php");
 echo "</div>";
    include("$directory/includes/misc/footer.php");

echo "</body>";

echo "</html>";
?>