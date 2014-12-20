<?php
  include("config.php");

  include("$directory/includes/config/auth.php");
  include("$directory/includes/misc/include.php");

$langid = $_SESSION['SESS_LANG'];

$language_sql = mysql_query("SELECT * FROM workforce WHERE lang = '$langid'", $langdb);
while ($langrow = mysql_fetch_array($language_sql)) {
    $l1 = $langrow['1'];
    $l2 = $langrow['2'];
    $l3 = $langrow['3'];
    $l4 = $langrow['4'];
    $l5 = $langrow['5'];
    $l6 = $langrow['6'];
    $l7 = $langrow['7'];
    $l8 = $langrow['8'];
    $l9 = $langrow['9'];
    $l10 = $langrow['10'];
    $l11 = $langrow['11'];
    $l12 = $langrow['12'];
    $l13 = $langrow['13'];
    $l14 = $langrow['14'];
    $l15 = $langrow['15'];
    $l16 = $langrow['16'];
    $l17 = $langrow['17'];
    $l18 = $langrow['18'];
    $l19 = $langrow['19'];
    $l20 = $langrow['20'];
    $l21 = $langrow['21'];
}





echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html>";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
echo "<title>Assign workforce</title>";
echo "<link href=\"loginmodule.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "</head>";
echo "<body><div id=\"banner\">";
echo "<h1>$l1</h1>";
include("$directory/includes/misc/clock.php");
echo "</div>";
include("$directory/includes/menus/newmenu.php");
echo "<div id=\"main\">";
include("$directory/includes/misc/infomsg.php");

echo "<b>$l2</b><br>";


//Farms





$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$result = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);

while ($row = mysql_fetch_array($result)) {
    echo "$l3: $row[27]";
}
?>
<form id="Purchase" name="purchase" method="get" action="./includes/work/work-farm.php">

    <table><tr>
            <td><?php echo $l9; ?>: </td>
            <td><input name="farm" type="text" class="textfield" id="farm" /></td></tr>

        <?php
        $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $resultfarm = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);

        while ($rowfarm = mysql_fetch_array($resultfarm)) {
            $farm = $rowfarm[20] - $rowfarm[33];
            if ($farm <= 0) {
                echo "<tr><td colspan=\"4\">$l8</td></tr>";
            }
            echo "<tr><td colspan=\"4\">$l6: $farm</td></tr>";
        }
        ?>
        <tr><td><input type="submit" name="Submit" value="<?php echo $l7; ?>" class="myButton"/></td></tr>

</form>

<form id="Purchase" name="purchase" method="get" action="./includes/work/work-industry.php">
</tr>
</table><br><br><table>
    <tr>
        <td>Industrial: </td>
        <td><input name="industry" type="text" class="textfield" id="industry" /></td></tr>

<?php
$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$resultindustrial = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);

while ($rowindustrial = mysql_fetch_array($resultindustrial)) {
    $industrial = (($rowindustrial['industrial'] * 2) - $rowindustrial[31]);
    if ($industrial <= 0) {

        echo "<tr><td colspan=\"4\">$l8</td></tr>";
    } else {
        echo "<tr><td colspan=\"4\">$l6: $industrial </td></tr>";
    }
}
?>
    <tr><td><input type="submit" name="Submit" value="<?php echo $l7; ?>" class="myButton"/></td>
        </form>
    </tr>
</table><br><br><table>
    <tr><form id="Purchase" name="purchase" method="get" action="./includes/work/work-commercial.php">
        <td>Commercial: </td>
        <td><input name="commercial" type="text" class="textfield" id="commercial" /></td></tr>

<?php
$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$resultcommercial = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);

while ($rowcommercial = mysql_fetch_array($resultcommercial)) {
    $commercial = (($rowcommercial['commercial'] * 5) - $rowcommercial[32]);
    if ($commercial <= 0) {

        echo "<tr><td colspan=\"4\">$l8</td></tr>";
    } else {
        echo "<tr><td colspan=\"4\">$l6: $commercial</td></tr>";
    }
}
?>
        <tr><td><input type="submit" name="Submit" value="<?php echo $l7; ?>" class="myButton"/></td>
        </tr></table>
</form>
        <?php
        include("$directory/includes/misc/online.php");
        echo "<div>";
        include("$directory/includes/misc/footer.php");
        ?>
</body>
</html>






