<?php  
include("config.php");

  include("$directory/includes/config/auth.php");
  include("$directory/includes/misc/include.php");
        header('Refresh: 60');

$name = mysql_real_escape_string($_SESSION['SESS_LOGIN']);
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html>";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
echo "<title>World Statistics</title>";
echo "<link href=\"loginmodule.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "</head>";
echo "<body><div id=\"banner\">";
echo "<h1>World Statistics</h1>";
include("$directory/includes/misc/clock.php");
echo "</div>";
include("$directory/includes/menus/newmenu.php");
echo "<div id=\"main\">";
echo "<div id=\"statspic\"></div>";
echo "<table  id=\"stats\">";

echo "<tr><td>Fax From: World Organization</td></tr>";
echo "<tr><td>To: $name</td></tr>";
echo "<tr><td colspan=\"2\">Subject: World Organization statistics.</td></tr>";
echo "<tr><td colspan=\"3\">The World Organization has release its report on various world statistics.</tr><td>";
$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$result = mysql_query("SELECT * FROM population WHERE id = 1", $db);
$nation = mysql_query("SELECT * FROM population WHERE id = 2", $db);
$homeless = mysql_query("SELECT * FROM population WHERE id = 3", $db);
$jobless = mysql_query("SELECT * FROM population WHERE id = 4", $db);
$acre = mysql_query("SELECT * FROM population WHERE id = 5", $db);
while($row = mysql_fetch_array($result))
{
 $population = number_format($row[2]);

echo "<tr><td>Population:</td><td>$population</td></tr>";
}
while($natrow = mysql_fetch_array($nation))
{
    $natnumb = number_format($natrow[2]);
    echo "<tr><td>Nations:</td><td>$natnumb</td></tr>";
}
while($homelessrow = mysql_fetch_array($homeless))
{
    $homenumb = number_format($homelessrow[2]);
    echo "<tr><td>Homeless:</td><td>$homenumb</td></tr>";
}
while($joblessrow = mysql_fetch_array($jobless))
{
    $jobnumb = number_format($joblessrow[2]);
    echo "<tr><td>Jobless:</td><td>$jobnumb</td></tr>";
}
while($acrerow = mysql_fetch_array($acre))
{
    $acrenumb = number_format($acrerow[2]);
    echo "<tr><td>Land:</td><td>$acrenumb</td></tr>";
}
$stats = mysql_query("SELECT * FROM members ORDER BY land DESC LIMIT 0,1", $db);
while($stat_row = mysql_fetch_array($stats))
{
    echo "<tr><td>Largest Nation:</td><td><img width=\"40px\" height=\"20px\" src=\"$stat_row[10]\">  $stat_row[5]</td></tr>";
}
$stats1 = mysql_query("SELECT * FROM members ORDER BY money DESC LIMIT 0,1", $db);
while($stat1_row = mysql_fetch_array($stats1))
{
    echo "<tr><td>Wealthiest Nation:</td><td><img width=\"40px\" height=\"20px\" src=\"$stat1_row[10]\"> $stat1_row[5]</td></tr>";
}
echo "</table>";
include("$directory/includes/misc/online.php");
echo "</div>";
include("$directory/includes/misc/count.php");

include("$directory/includes/misc/footer.php");



echo "</body>";
echo "</html>";
