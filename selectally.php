<?php
  include("./includes/config/auth.php");
  include("./includes/config/config.php");
  include("./includes/misc/include.php");
        include("functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alliance</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body>
 <?php include('menu.php');
 $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
 $ally_id = mysql_real_escape_string($_GET['name']);

 //include('menu4.php');

 $ally = mysql_query("SELECT * FROM alliance WHERE name = '$ally_id'", $db);
 while($ally_row = mysql_fetch_array($ally))
 {

     echo "$ally_row[3]";
     echo "<br>";
     $descr = bb2html($ally_row[4]);
     echo "$descr";
     
     $ally_lookup_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
     while($ally_lookup_row = mysql_fetch_array($ally_lookup_sql))
     {
         if ($ally_lookup_row[37] == '')
         {

        echo "<form id=\"loginForm\" name=\"alliance\" method=\"get\" action=\"joinally.php\">";
        echo "<input name=\"alliance\" type=\"hidden\" class=\"textfield\" value=\"$ally_row[3]\" />";
        echo "<input type=\"submit\" name=\"Submit\" value=\"Join Alliance\" />";
        echo "</form>";
 }
     }
 }



    ?>
    <?php include("online.php"); include("count.php"); include("footer.php"); ?>
</body>
</html>