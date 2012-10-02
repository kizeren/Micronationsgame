<?php  include("config.php");

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
 
    $color="1";

    $id = mysql_real_escape_string($_SESSION['SESS_LOGIN']);
    $message_sql = mysql_query("SELECT * FROM messages WHERE user = '$id' ORDER BY date DESC", $db);
    echo "<center><table class=\"messages\">";
    while($message_row = mysql_fetch_array($message_sql))
    {
        if($color==1){
        echo "<tr bgcolor='#99CCEE'><td><a class=\"first\" href=\"read-message.php?id=$message_row[0]\">$message_row[3]</a>";
        echo "<small>From $message_row[2] on $message_row[5]</small></td> ";
        echo "<td><form action=\"./includes/messages/delete-message.php\" method=\"get\">";
        echo "<input type=\"hidden\" name=\"delete\" value=\"$message_row[0]\">";
        echo "<input type=\"submit\" value=\"Delete\" />";
        echo "</td></tr> ";
        $color="2";
        }
        else
        {
        echo "<tr bgcolor='#99EEFF'><td><a class=\"first\" href=\"read-message.php?id=$message_row[0]\">$message_row[3]</a>";
        echo "<small>From $message_row[2] on $message_row[5]</small></td>";
        echo "<td><form action=\"./includes/messages/delete-message.php\" method=\"get\">";
        echo "<input type=\"hidden\" name=\"delete\" value=\"$message_row[0]\">";
        echo "<input type=\"submit\" value=\"Delete\" />";
        echo "</td></tr> ";
        $color="1";
        }

    }
    echo "</table></center>";

?>


<?php include("$directory/includes/misc/online.php");
include("$directory/includes/misc/count.php"); 
include("$directory/includes/misc/footer.php");
?>