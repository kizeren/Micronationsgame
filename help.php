<?php  
include("config.php");

  include("$directory/includes/config/auth.php");
  include("$directory/includes/misc/include.php");
$langid = $_SESSION['SESS_LANG'];
$language_sql = mysql_query("SELECT * FROM help WHERE lang = '$langid'", $langdb);
while ($langrow = mysql_fetch_array($language_sql)) {
    $l1 = $langrow['1'];
    $l2 = $langrow['2'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><? echo $l2; ?></title>
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

echo $l1;

include("$directory/includes/misc/online.php");
echo "</div>";
include("$directory/includes/misc/count.php");
include("$directory/includes/misc/footer.php");
?>
    </body>
</html>
