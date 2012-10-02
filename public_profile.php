<?php
  include("./includes/config/auth.php");
  include("./includes/config/config.php");
  include("./includes/misc/include.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nation Profile</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>MicroNations</h1>
<a href="http://www.micronationsgame.com/">Join us!</a>

<?php

 


$id = mysql_real_escape_string($_GET['id']);
$result = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);

while($row = mysql_fetch_array($result))
{
    echo "<center>";
    echo "<table cellspacing=\"0\">";
    echo "<tr><td align=\"center\" valign=\"top\">";

    echo "<img hiehgt=\"214\" width=\"108\" name=\"flag_image\" class=\"bigflag\" alt=\"\" src=\"$row[10]\">";
    echo "</td><td align=\"left\">";

    echo "<h2> The Nation of $row[5] </h2>";
    echo "<p class=\"slogan\">&ldquo; $row[6] &rdquo;</p>";
    echo "</td></tr>";
    echo "</table>";
    echo "</center>";
    echo "<center><table><tr><td>";
    echo "The forests of $row[5] are known for thier $row[8] trees and $row[9] plants. These living things are protected under government law.</td>";
    echo "</td></tr>";
    $population = number_format($row[12]);
    $money = number_format($row[14]);
    $homeless = number_format($row[16] / $row[17]);
    $jobless = number_format($row[12] / ($row[18] + $row[19] +$row[20]));
    echo "<tr><td>$row[5] has grown to a population of $population. The average tax rate on its citizens is $row[15]%.</td></tr>";
    echo "<tr><td>The nation currently has $$money $row[7] it can use towards building a better nation for its citzens.</td><td></td></tr>";
    echo "<tr><td>There is a $homeless% homeless rate and a jobless rate of $jobless%.";
    if ($row[15] > 90)
    {
        echo "The nation is also money thirsty, taxing its works more then 90%.";
    
    }
        
        $result2 = mysql_query("SELECT * FROM points WHERE member_id='$id'", $db);

    
           while($row1 = mysql_fetch_array($result2))
        {
           $points = $row1['points'];
           echo "<tr><td>This player has " . number_format($points) . " points. </td></tr>";
       }
    echo "</table>";
    echo "</center>";






include("count.php");
include("awards.php");

}

?>

</body>
</html>
