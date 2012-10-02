<?php  
include("config.php");

  include("$directory/includes/config/auth.php");
  include("$directory/includes/misc/include.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Purchasing</title>
        <link href="loginmodule.css" rel="stylesheet" type="text/css" />
        <link href="button.css" rel="stylesheet" type="text/css" />

    </head>
    <body><div id="banner">
        <h1>Welcome <?php echo $_SESSION['SESS_LOGIN']; ?> to <?php echo $game_name; ?>!</h1>
        <?php include("$directory/includes/misc/clock.php"); ?>
        </div>

        <?php 
        include("$directory/includes/menus/newmenu.php");
        echo "<div id=\"main\">";
        include("$directory/includes/misc/resource.php");

        include("$directory/includes/misc/infomsg.php");

$id = mysql_real_escape_string($_GET['id']);
$result = mysql_query("SELECT * FROM messages WHERE id = '$id'", $db);

while($row = mysql_fetch_array($result))
{


   echo "From: $row[2] Subject: $row[3]<br>";
  
   echo  nl2br($row[4]);

    echo "<br><BR><BR><BR>";
    echo "<form action=\"./includes/messages/delete-message.php\" method=\"get\">";
    echo "<input type=\"hidden\" name=\"delete\" value=\"$row[0]\">";
    echo "<input type=\"submit\" value=\"Delete\" />";
}


include("$directory/includes/misc/online.php"); 
echo "</div>";
include("$directory/includes/misc/count.php"); include("$directory/includes/misc/footer.php"); ?>
</table>
</body>
</html>

