<?php
  include("./includes/config/auth.php");
  include("./includes/config/config.php");
  include("./includes/misc/include.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Profile</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>My Profile </h1>
<?php include("menu.php"); ?>

<?php

$id = mysql_real_escape_string($_GET['id']);
$result = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);

while($row = mysql_fetch_array($result))
{
    echo "<center>";
    echo "<table cellspacing=\"0\">";
    echo "<tr><td align=\"center\" valign=\"top\">";

    echo "<img name=\"flag_image\" class=\"bigflag\" alt=\"\" src=\"$row[10]\">";
    echo "</td><td align=\"left\">";

    echo "<h2> The Nation of $row[5] </h2>";
    echo "<p class=\"slogan\">&ldquo; $row[6] &rdquo;</p>";
    echo "</td></tr>";
    echo "</table>";
    echo "</center>";
    echo "<center><table><tr><td>";
    echo "The forests of $row[5] are known for thier $row[8] trees and $row[9] plants.<td>";
    echo "<td>These living things are protected under government law.</td>";
    echo "</td></tr>";

    echo "</table>";
    echo "</center>";
   //echo "Nation name: $row[5]<br>";
   //echo "National motto: $row[6]<br>";
   //echo "Monetary unit: $row[7]<br>";
   //echo "National tree: $row[8]<br>";
   //echo "National plant: $row[9]<br>";
   //echo "National flag: <img width=\"40px\" height=\"20px\" src=\"$row[10]\"><br>";


}
?>

</body>
</html>