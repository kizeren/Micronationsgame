<?php
  include("./includes/config/auth.php");
  include("./includes/config/config.php");
  include("./includes/misc/include.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>National Law Information</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body><div id="banner">
<h1>Welcome <?php echo $_SESSION['SESS_LOGIN']; ?> to <?php echo $game_name; ?>!<img src="http://mcbride.homelinux.net/~nations/flags/beta_icon.gif"></h1>
 <?php include("clock.php"); ?>
    </div>
<?php include("newmenu.php"); ?>
    
<div id="main">
<?php include("infomsg.php"); ?>
Current list of laws that need to be voted for or against.<br>
<?php


$result = mysql_query("SELECT * FROM quests", $db);
echo "<table id=\"table-3\">";
echo "<tr><th>Please follow the quests in order.</th><th>Date finished.</th></tr>";
while($row = mysql_fetch_array($result))
{

   
   
   
   echo "<td><a href=\"selectquests.php?id=$row[0]\">$row[1]</a></td><td></td>";
   echo "</td></tr>";


}



echo "</table>";
include("online.php");
echo "</div>";


include("count.php");
include("footer.php");

echo "</body>";
echo "</html>";