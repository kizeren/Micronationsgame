<?php
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
  include("config.php");

  include("$directory/includes/config/auth.php");
  include("$directory/includes/misc/include.php");

echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
echo "<title>Your profile</title>";
echo "<link href=\"loginmodule.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "<link href=\"button.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "</head>";
echo "<body>";
echo "<h1>Your Profile</h1>";
echo "<div id=\"banner\">";
include("$directory/includes/misc/clock.php");
echo "</div>";
include("$directory/includes/menus/newmenu.php");
echo "<div id=\"main\">";
include("$directory/includes/misc/infomsg.php");

$result = mysql_query("UPDATE members SET nation = '$popcount', WHERE member_id='$id'", $db);



$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$result = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);

while($row = mysql_fetch_array($result))
{
    
    echo "<table cellspacing=\"0\">";
    echo "<tr><td align=\"center\" valign=\"top\">";

    echo "<img hiehgt=\"214\" width=\"108\" name=\"flag_image\" class=\"bigflag\" alt=\"\" src=\"$row[10]\">";
    echo "</td><td align=\"left\">";

    echo "<h2> The Nation of $row[5] </h2>";
    echo "<p\"><b><i>&#8220;$row[6]&#8221;</i><b></p>";
    echo "</td></tr>";
    echo "</table>";
    
    echo "<center><table><tr><td>";
    echo "The forests of $row[5] are known for thier $row[8] trees and $row[9] plants. These living things are protected under government law.</td>";
    echo "</td></tr>";
    $population = number_format($row[12]);
    $money = number_format($row[14]);
    $homeless = number_format((($row['homeless'] / $row['popcount']) * 100), 2);
    $jobless = number_format((($row['jobless'] / $row['popcount']) * 100), 2);
    echo "<tr><td>$row[5] has grown to a population of $population. The average tax rate on its citizens is $row[15]%.</td></tr>";
    echo "<tr><td>The nation currently has $$money $row[7] it can use towards building a better nation for its citzens.</td><td></td></tr>";
    echo "<tr><td>There is a $homeless% homeless rate and a jobless rate of $jobless%.";
    if ($row[15] > 90)
    {
        echo "The nation is also money thirsty, taxing its workers more then 90%.";
    }
    $result2 = mysql_query("SELECT * FROM points WHERE member_id='$id'", $db);
       while($row1 = mysql_fetch_array($result2))
        {
           $points = $row1['points'];
           echo "<tr><td>You have points " . number_format($points) . ". </td></tr>";
       }
    echo "</table>";
    echo "</center>";
    echo "<br><br>Awards:<br>";
    include("$directory/includes/misc/count.php");
    include("awards.php");


}

 
   
?>
<?php

include("$directory/includes/misc/online.php");
echo "</div>";
include("$directory/includes/misc/count.php");
include("$directory/includes/misc/footer.php");
?>
</body>
</html>
