<?php
  include("./includes/config/auth.php");
  include("./includes/config/config.php");
  include("./includes/misc/include.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alliance</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>Update Alliance</h1>
 <?php include('menu.php'); ?>

HTML Not allowed. BBcode is allowed.
<table>
<form id="alliance" name="telegram" method="get" action="post-ally.php">
<?php
$name = mysql_real_escape_string($_SESSION['SESS_ALLIANCE']);
$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$ally_info = mysql_query("SELECT * FROM alliance WHERE member_id = '$id' AND name = '$name'", $db);
while($ally_info_row = mysql_fetch_array($ally_info))
{
    echo "<tr><td>Current:</td><td>$ally_info_row[4]</td></tr>";
    echo "<tr><td>Description:</td><td> <textarea cols=\"100\" rows=\"10\" value=\"$ally_info_row[4]\" name=\"description\"></textarea></td></tr>";
    
}
    ?>
    <tr><td><input type="submit" value="Submit" /></td></tr>
</table>
</form>
    <br>
[img]http://example.com/example.img[/img]<br>
[url="http://examle.com"example.com[/url]<br>
[mail="example@example.com"Example[/mail]<br>
[size="25"]HUGE[/size]<br>
[color="red"]RED[/color]<br>
[b]bold[/b]<br>
[i]italic[/i]<br>
[u]underline[/u]<br>
[list][*]item[*]item[*]item[/list]<br>
[code]value="123";[/code]<br>
[quote]I say[/quote]<br>
    <?php include("online.php");
include("count.php"); include("footer.php");
?>
    </body>
</html>
