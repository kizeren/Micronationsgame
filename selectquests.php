<?php
  include("./includes/config/auth.php");
  include("./includes/config/config.php");
  include("./includes/misc/include.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>news Index</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
<link href="button.css" rel="stylesheet" type="text/css" />

</head>
<body>
    <div id="banner">
<h1>Welcome <?php echo $_SESSION['SESS_LOGIN']; ?> to <?php echo $game_name; ?>!</h1>
<?php include("clock.php");
echo "</div>";
echo "<div id=\"main\">";
   include("newmenu.php");
$id = mysql_real_escape_string($_GET['id']);
$result = mysql_query("SELECT * FROM quests WHERE id = '$id'", $db);

while($row = mysql_fetch_array($result))
{

    
    

   echo "<table id=\"table-3\"><tr>";
   echo "<td>$row[2]</td></tr>";
 
  
 
 
  
                echo "<center><tr><td>";
                echo "<form action=\"finishquests.php\" method=\"get\">";
                echo "<input type=\"hidden\" name=\"for\" value=\"for\">";
                echo "<input type=\"hidden\" name=\"quest\" value=\"$row[0]\"\>";
                echo "<input type=\"submit\" value=\"Finish\" class=\"myButton\"/>";
                echo "</form>";
 
                echo "</center>";
                echo "</td></tr></table>";
   
}
include("online.php");
   echo "</div>";

   include("count.php");
?>
<?php  
include("count.php"); include("footer.php"); ?>
</table>
</body>
</html>

