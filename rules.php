<?php
	require_once('auth.php');
        require_once('config.php');include("include.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rules</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="banner">   
<h1>Rules </h1>
<?php include("clock.php");
echo "</div>";
include("newmenu.php");
echo "<div id=\"main\">";
include("infomsg.php");
include("functions.php");
$rules_sql = mysql_query("SELECT * FROM rules", $db);
while($rules_row = mysql_fetch_array($rules_sql))
{

    echo bb2html($rules_row[0]);

}
include("online.php");
echo "</div>";
include("count.php");
include("footer.php");
?>