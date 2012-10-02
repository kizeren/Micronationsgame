<?php
  include("./includes/config/auth.php");
  include("./includes/config/config.php");
  include("./includes/misc/include.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>News</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="banner">   
<h1>News </h1>
<?php include("clock.php");
echo "</div>";
include("newmenu.php");
echo "<div id=\"main\">";
include("infomsg.php");


$id = mysql_real_escape_string($_GET['id']);
$result = mysql_query("SELECT * FROM news WHERE id = '$id'", $db);

while($row = mysql_fetch_array($result))
{

   echo "<table>";
   echo "<tr><td>";
   echo "Message ID: $row[0]</td><td>Title: $row[1]</a>";
   echo "</td></tr>";
   echo "<td colspan=\"2\">" . nl2br($row[2]) . "</td></tr></table>";
include("count.php");

}


 include("online.php");
 echo "</div>";
 include("count.php"); include("footer.php"); ?>
</table>
</body>
</html>

