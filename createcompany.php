<?php
include("config.php");

require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");
include("$directory/includes/misc/count.php");
include("$directory/includes/misc/do_satellites_rep.php");
$langid = $_SESSION['SESS_LANG'];
include("$directory/includes/misc/functions.php");
header('Refresh: 60');


$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);

//Set ttdmail to 0 so when 2016 ticks is reached user gets mail.
mysql_query("UPDATE ttdmail SET mailsent = 0 WHERE member_id = '$id'", $db);


$first_sql = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);
while ($first_row = mysql_fetch_array($first_sql)) {
    if ($first_row[29] > 0) {

        header("location: first-time.php");
        exit();
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<?php
$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);

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

include("$directory/includes/misc/clock.php");
echo "</div>";
echo "<div id=\"main\">";
include("$directory/includes/misc/resource.php");

include("$directory/includes/misc/infomsg.php");
include("$directory/includes/menus/newmenu.php");
?>
<table><tr><td>
<form id="loginForm" name="battle" method="get" action="./includes/misc/do_create_company.php">
      <tr><td>Company Name:</td><td><input name="name" type="text" class="textfield" value="Example: Gas N Go" /></td></tr>
      <tr><td>Company Type:</td><td>
              
              <select name="type">
<option value="Oil">Oil</option>
<option value="Fuel">Fuel</option>
<option value="Food">Food</option>
<option value="Goods">Goods</option>
<option value="Lead">Lead</option>
<option value="Gold">Gold</option>

</select>
              
              
          </td></tr>

      
      <tr><td></td><td><input type="submit" name="Submit" value="Submit" class="myButton"/></td></tr>
</form>
            </table>
<?
include("$directory/includes/misc/online.php");echo "</div>";
include("$directory/includes/misc/footer.php");

echo "</body>";

echo "</html>";
?>


