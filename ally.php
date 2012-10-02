<?php  include("config.php");

  include("$directory/includes/config/auth.php");
  include("$directory/includes/misc/include.php");
?>

<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alliance</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
<link href="button.css" rel="stylesheet" type="text/css" />
</head>
<body><div id="banner">
    <h1>Alliance</h1>
    
 <?php 
 
 include("$directory/includes/misc/clock.php");
 echo "</div>";
 
 include("$directory/includes/menus/newmenu.php");
 echo "<div id=\"main\">";
 include("$directory/includes/misc/resource.php");

 include("$directory/includes/misc/functions.php");
 
 $ally_name = mysql_real_escape_string($_SESSION['SESS_ALLIANCE']);
 $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
 if($ally_name == '')
 {
     header("location: findally.php");
 }
 //include('menu4.php');
 $sql = "SELECT * FROM alliance WHERE name = '$ally_name'";
 $ally = mysql_query($sql, $db);
 while($ally_row = mysql_fetch_array($ally))
 {
     echo "Welcome to the alliance of ";
     echo "$ally_row[3]!";
     echo "<br>";
     $descr = bb2html($ally_row[4]);
     echo "$descr";
     echo "<br><br><br>Members:<br>";
     $members = mysql_query("SELECT * FROM members WHERE alliance = '$ally_name'", $db);
     while($mem_row = mysql_fetch_array($members))
     {
     echo "<img width=\"40px\" height=\"20px\" src=\"$mem_row[10]\"> $mem_row[3] ";
     }
     $ally_member_id = mysql_query("SELECT * FROM alliance WHERE member_id = '$id'", $db);
     echo "<table><tr>";
     while($ally_row1 = mysql_fetch_array($ally_member_id))
     {
         if ($ally_row1[2] > 0)
         {

        echo "<td>";
        echo "<form id=\"loginForm\" name=\"alliance\" method=\"get\" action=\"modifyally.php\">";
        echo "<input name=\"alliance\" type=\"hidden\" class=\"textfield\" value=\"$mem_row[37]\" />";
        echo "<input type=\"submit\" name=\"Submit\" value=\"Update Alliance Profile\" class=\"myButton\"/>";
        echo "</form>";
        echo "</td>";
         }

}
        echo "<td>";
        echo "<form id=\"loginForm\" name=\"alliance\" method=\"get\" action=\"leaveally.php\">";
        echo "<input name=\"alliance\" type=\"hidden\" class=\"textfield\" value=\"$mem_row[37]\" />";
        echo "<input type=\"submit\" name=\"Submit\" value=\"Leave Alliance\" class=\"myButton\"/>";
        echo "</form>";
        echo "</td></tr></table>";
     
          
     

     
 }

include("$directory/includes/misc/online.php"); 
echo "</div>";
include("$directory/includes/misc/count.php"); 
include("$directory/includes/misc/footer.php"); ?>
</body>
</html>