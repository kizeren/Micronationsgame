<?php  include("config.php");

  include("$directory/includes/config/auth.php");
  include("$directory/includes/misc/include.php");
$langid = $_SESSION['SESS_LANG'];

$language_sql = mysql_query("SELECT * FROM newmessage WHERE lang = '$langid'", $langdb);
while ($langrow = mysql_fetch_array($language_sql)) {
    $l1 = $langrow['1'];
    $l2 = $langrow['2'];
    $l3 = $langrow['3'];
    $l4 = $langrow['4'];
    $l5 = $langrow['5'];

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><? echo $l1; ?></title>
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
        ?>
<table>
<form id="telegram" name="telegram" method="get" action="./includes/messages/post-message.php">
    <tr><td><? echo $l2; ?>:</td><td> <input name="user" type="text" class="textfield" id="title" /></td></tr>
    <tr><td><? echo $l3; ?>:</td><td> <input name="subject" type="text" class="textfield" id="title" /></td></tr>
    <tr><td><? echo $l4; ?>:</td><td> <textarea cols="50" rows="4" name="body"></textarea></td></tr>
    <tr><td><input type="submit" value="<? echo $l5; ?>" /></td></tr>
</table>
</form>

<?php include("$directory/includes/misc/online.php");
echo "</div>";
include("$directory/includes/misc/count.php"); 
include("$directory/includes/misc/footer.php");
?>