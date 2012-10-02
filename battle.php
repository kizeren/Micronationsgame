<?php  
include("config.php");

  include("$directory/includes/config/auth.php");
  include("$directory/includes/misc/include.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>War</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body><div id="banner">
<h1>Welcome <?php echo $_SESSION['SESS_LOGIN']; ?> to <?php echo $game_name; ?>!</h1>
<?php
include("$directory/includes/misc/clock.php");
echo "</div>";
include("$directory/includes/menus/newmenu.php");
echo "<div id=\"main\">";
include("$directory/includes/misc/resource.php");

include("$directory/includes/misc/infomsg.php");
include("$directory/includes/misc/include.php");
$id = $_SESSION['SESS_MEMBER_ID'];
$militarysql = mysql_query("SELECT * FROM military WHERE member_id = '$id'", $db);
while($militaryrow = mysql_fetch_array($militarysql))
{
    $infantry = $militaryrow['infantry'];
    $mercs = $militaryrow['mercs'];
    $tanks = $militaryrow['tanks'];
    $transports = $militaryrow['transports'];
    $f16s = $militaryrow['f16'];
    $ac130s = $militaryrow['ac130'];
    
}


$name = mysql_real_escape_string($_GET['name']);
$rogue = mysql_real_escape_string($_GET['rogue']);
$rogid = mysql_real_escape_string($_GET['rogid']);
$member_sql = mysql_query("SELECT * FROM map_coords WHERE member_id = '$id'", $db);
while($coords = mysql_fetch_array($member_sql))
{
    $memlat = $coords['lat'];
    $memlon = $coords['lon'];
}
$rogue_sql = mysql_query("SELECT * FROM roguenations WHERE id = '$rogid' AND name = '$rogue'", $db);
while($rogcoords = mysql_fetch_array($rogue_sql))
{
    $roglat = $rogcoords['lat'];
    $roglon = $rogcoords['lon'];
}

include("calcdist.php");

echo round(distance($memlat, $memlon, $roglat, $roglon, "m"));
?>
<table>
<form id="loginForm" name="battle" method="get" action="./includes/battle/do_battle.php">
      <tr><td>Attack whom? </td><td><input name="name" type="text" class="textfield" value="<?php echo $name; ?>" /></td></tr>
      <tr><td>How many mercs?</td><td><input name="mercs" type="text" class="textfield" id="name" /> <? echo $mercs; ?></td></tr>
      <tr><td>How many infantry?</td><td><input name="troops" type="text" class="textfield" id="name" /> <? echo $infantry; ?></td></tr>
      <tr><td>How many tanks?</td><td><input name="tanks" type="text" class="textfield" id="name" /> <? echo $tanks; ?></td></tr>
      <tr><td>How many transports?</td><td><input name="trans" type="text" class="textfield" id="name" /> <? echo $transports; ?></td></tr>
      <tr><td>How many F16s?</td><td><input name="f16" type="text" class="textfield" id="name" /> <? echo $f16s; ?></td></tr>
      <tr><td>How many AC130s?</td><td><input name="ac130" type="text" class="textfield" id="name" /> <? echo $ac130s; ?></td></tr>
      
      <tr><td></td><td><input type="submit" name="Submit" value="Battle" class="myButton"/></td></tr>
</form>
<form id="loginForm" name="battle" method="get" action="./includes/battle/do_scout.php">
  <tr><td>Scout whom? </td><td><input name="name" type="text" class="textfield" value="<?php echo $name; ?>" /></td></tr>
      <tr><td>How many spies?</td><td><input name="troops" type="text" class="textfield" id="name" /></td></tr>
      <tr><td></td><td><input type="submit" name="Submit" value="Battle" class="myButton"/></td></tr>
</form>
</table>
<table>
<form id="loginForm" name="battle" method="get" action="./includes/battle/do_rog_battle.php">
  <tr><td>Attack Rogue? </td><td><input name="name" type="text" class="textfield" value="<?php echo $rogue; ?>" /></td></tr>
          <input type="hidden" name="rogid" value="<?php echo $rogid; ?>">
      <tr><td>How many mercs?</td><td><input name="mercs" type="text" class="textfield" id="name" /> <? echo $mercs; ?></td></tr>
      <tr><td>How many infantry?</td><td><input name="troops" type="text" class="textfield" id="name" /> <? echo $infantry; ?></td></tr>
      <tr><td>How many tanks?</td><td><input name="tanks" type="text" class="textfield" id="name" /> <? echo $tanks; ?></td></tr>
      <tr><td>How many transports?</td><td><input name="trans" type="text" class="textfield" id="name" /> <? echo $transports; ?></td></tr>
      <tr><td></td><td><input type="submit" name="Submit" value="Battle" class="myButton"/></td></tr>
</form>

</table>





<?php include("$directory/includes/misc/online.php"); echo "</div>"; 
include("$directory/includes/misc/count.php"); 
include("$directory/includes/misc/footer.php"); ?>
</body>
</html>
