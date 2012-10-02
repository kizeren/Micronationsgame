<?php
include("config.php");

require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");
include("$directory/includes/misc/count.php");
include("$directory/includes/misc/do_satellites_rep.php");
$langid = $_SESSION['SESS_LANG'];
include("$directory/includes/misc/functions.php");
header('Refresh: 60');


$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);

//Set ttdmail to 0 so when 2016 ticks is reached user gets mail.
mysql_query("UPDATE ttdmail SET mailsent = 0 WHERE member_id = '$id'", $db);


$first_sql = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);
while ($first_row = mysql_fetch_array($first_sql)) {
    if ($first_row[29] > 0) {

        header("location: first-time.php");
        exit();
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<?php
$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);

echo "<html>";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
echo "<title>National Information</title>";
echo "<link href=\"loginmodule.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "</head>";
echo "<body>";
echo "<div id=\"banner\">";
echo "<h1>Welcome ";
echo $_SESSION['SESS_LOGIN'];
echo " to $game_name <img src=\"http://mcbride.homelinux.net/~nations/flags/beta_icon.gif\"></h1>";

include("$directory/includes/misc/clock.php");
echo "</div>";
echo "<div id=\"main\">";
include("$directory/includes/misc/resource.php");

include("$directory/includes/misc/infomsg.php");
//New menu layout
?>
<style type="text/css">
    div.smallish-progress-wrapper {
        /* Don't change the following lines. */
        position: relative; border: 1px solid black;

    }
    div.smallish-progress-bar
    {
        /* Don't change the following lines. */
        position: absolute; top: 0; left: 0; height: 100%;

    }
    div.smallish-progress-text
    {
        /* Don't change the following lines. */
        text-align: center; position: relative;
        /* Add your customizations after this line. */

    }
</style>
<!-- Progess bar widget, by Matthew Harvey (matt at smallish.com) -->
<!-- Licensed under a Creative Commons Attribution-Share Alike 2.5 License (http://creativecommons.org/licenses/by-sa/2.5/) -->
<script type="text/javascript">
    function drawProgressBar(color, width, percent)
    {
        var pixels = width * (percent / 100);
        document.write('<div class="smallish-progress-wrapper" style="width: ' + width + 'px">'); document.write('<div class="smallish-progress-bar" style="width: ' + pixels + 'px; background-color: ' + color + ';"></div>');
        document.write('<div class="smallish-progress-text" style="width: ' + width + 'px">' + percent + '%</div>');
        document.write('</div>'); }
</script>
<?php
$result1 = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);

$military_sql = mysql_query("SELECT * FROM military WHERE member_id='$id'", $db);
while ($military_row = mysql_fetch_array($military_sql)) {
    $mtick = round((100 * $military_row[4]) / 288);
    $mmtick = 288 - $military_row[4];
    if ($military_row[3] >= 3) {
        echo "You are under WO protection for $mmtick ticks.<br>";
        echo "You cannot attack or attack anyone else durning this time.<br>";
        echo "<script type=\"text/javascript\">drawProgressBar('#33cc33', 288, $mtick);</script> <br>";
    }
    $newbprotection_sql = mysql_query("SELECT * FROM newb_prot WHERE member_id = '$id'", $db);
    while ($newb = mysql_fetch_array($newbprotection_sql)) {
        $newbtick = 2016 - $newb[3];
        if ($newb[2] > 0) {
            $progress = round(($newb[3] / 2016) * 100);
            echo "You are under WO newbie protection for 7 days.<br>";
            echo "Ticks left: $newbtick.<br><script type=\"text/javascript\">drawProgressBar('#33cc33', 288, $progress);</script> <br>";
        }
    }
    $troops = number_format($military_row['infantry']);
    $spies = number_format($military_row['spies']);
    $tanks = number_format($military_row['tanks']);
    $mercs = number_format($military_row['mercs']);
    $mines = number_format($military_row['mines']);
    $f16 = number_format($military_row['f16']);
    $ac130 = number_format($military_row['ac130']);
}
$language_sql = mysql_query("SELECT * FROM member_index WHERE lang = '$langid'", $langdb);
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

while ($row = mysql_fetch_array($result1)) {
    $population = number_format($row[12]);
    $money = number_format($row[14]);
    $jobless = number_format($row[27]);
    $homeless = number_format($row[16]);


    include("$directory/includes/menus/newmenu.php");
    echo "<td>";

    echo "<table>"; //Primary Table.
    echo "<tr><td valign=\"top\">";
    echo "<table class=\"member\">"; //First table.
    echo "<tr><td class=\"member\" colspan=\"2\"><b>$l1</b></td></tr>";
    echo "<tr><td>$l2:</td><td> $row[5]</td></tr>";
    echo "<tr><td>$l3:</td><td> $row[6]</td></tr>";
    echo "<tr><td>$l4:</td><td> $row[7]</td></tr>";
    echo "<tr><td>$l5:</td><td> $row[8]</td></tr>";
    echo "<tr><td>$l6:</td><td> $row[9]</td></tr>";
    echo "<tr><td>$l7:</td><td> <img width=\"40px\" height=\"20px\" src=\"$row[10]\"></td></tr>";
    echo "<tr><td>$l8:</td><td>$row[26]</td></tr>";
    echo "</table></td><td valign=\"top\">"; //End First Table.
    echo "<table class=\"member2\">"; // Second Table.
    echo "<tr><td class=\"member\" colspan=\"2\">";
    echo "$l9</td></tr>";
    echo "<tr><td>$l10:</td><td> $population</td></tr>";
    echo "<tr><td>$l11:</td><td> $row[15]%</td></tr>";
    echo "<tr><td>$l12:</td><td> $money $row[7]</td></tr>";
    $work_farm = number_format($row[33]);
    $work_comm = number_format($row[32]);
    $work_ind = number_format($row['work_ind']);
    $home_use = number_format($row[33] + $row[32] + $row['work_ind']);
    $ware = number_format($row[38]);
    $land = number_format($row[34]);
    echo "<tr><td>$l13:</td><td> " . number_format($row[17]) . "</td></tr>";
    echo "<tr><td>$l14:</td><td> $ware</td></tr>";
    echo "<tr><td>$l15:</td><td>$homeless</td></tr>";
    echo "<tr><td>$l16:</td><td>$jobless</td></tr>";
    echo "<tr><td>Infantry</td><td>$troops</td></tr>";
    echo "<tr><td>Spies:</td><td>$spies</td></tr>";
    echo "<tr><td>Tanks:</td><td>$tanks</td></tr>";
    echo "<tr><td>Mercs:</td><td>$mercs</td></tr>";
    echo "<tr><td>Mines:</td><td>$mines</td></tr>";
    echo "<tr><td>F16s:</td><td>$f16</td></tr>";
    echo "<tr><td>AC130s</td><td>$ac130</td></tr>";
    echo "</table>";
    ////end second table.
    echo "</td></tr></table>"; //end primary table
    echo "<table><tr><td>"; //start 2nd primary table.
    echo "<table class=\"member2\">"; //start first table.
    echo "<tr><td class=\"member\" colspan=\"2\"><b>$l17</b></td></tr>";
    $freeland = number_format($freeland1 = ($row[34] - ($row[19] + $row[18] + $row[20] + $row[17] + $row[38])));
    echo "<tr><td>$l18:</td><td>$land (Free: $freeland)</td</tr>";

    $res_sql = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);
    while ($res_row = mysql_fetch_array($res_sql)) {


        $research = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);

        $troopsupkeep = mysql_query("SELECT * FROM military WHERE member_id ='$id'", $db);

        while ($research_row = mysql_fetch_array($research)) {

            while ($tukeep = mysql_fetch_array($troopsupkeep)) {
                $food = number_format($res_row[2]);
                $culture = number_format($res_row[3]);
                $goods = number_format($res_row[4]);
                $tupkeep = number_format($tukeep[2]);
                $food_tick = number_format($row[33] * 10);
                $culture_tick = number_format($row[32] * 5);
                $goods_tick = number_format($row['work_ind'] * 3);
                $food_bonus = number_format($research_row[5] * 1000);
                $culture_bonus = number_format($research_row[8] * 500);
                $goods_bonus = number_format($research_row[11] * 100);
                echo "<tr><td>$l19:</td><td> " . number_format($row[18]) . " (Pop: $work_ind Homes Needed: " . number_format($row[18] * 2) . ") </td></tr>";
                echo "<tr><td>$l20:</td><td> " . number_format($row[19]) . " (Pop: $work_comm Homes Needed: " . number_format($row[19] * 5) . ") </td></tr>";
                echo "<tr><td>$l21:</td><td> " . number_format($row[20]) . " (Pop: $work_farm Homes Needed: " . number_format($row[20]) . ") </td></tr>";
                echo "<tr><td><img src=\"../icons/Food.png\" hieght=\"32px\" width=\"32px\" title=\"Food\"></td><td>$food (Upkeep Troops: <font color=\"#FF0000\"> -$tupkeep </font> Production: <font color=\"green\"> +$food_tick </font> Research: <font color=\"green\">+$food_bonus</font>)</td><td>";
                echo "<tr><td><img src=\"../icons/vinyl-record-icon.jpg\" hieght=\"32px\" width=\"32px\" title=\"Culture\"></td><td>$culture (Production: <font color=\"green\"> +$culture_tick </font>Research: <font color=\"green\">+$culture_bonus</font>)</td><td>";
                echo "<tr><td><img src=\"../icons/e84ba8be.png\" title=\"Goods\"></td><td>$goods (Production: <font color=\"green\"> +$goods_tick </font>Research: <font color=\"green\">+$goods_bonus</font>)</td><td>";


                $gold = mysql_query("SELECT * FROM structures WHERE member_id = '$id'", $db);
                while ($goldrow = mysql_fetch_array($gold)) {
                    if ($goldrow[2] == 1) {
                        $goldsql = mysql_query("SELECT * FROM research WHERE member_id = '$id'", $db);
                        while ($gold = mysql_fetch_array($goldsql)) {
                            $goldprod = $research_row[17];
                            $goldsum = $gold[6] * 0.001;
                            echo "<tr><td><img src=\"../icons/Gold-Bar-icon.png\" title=\"Gold Bars\"></td><td>$goldprod (Production: <font color=\"green\"> +$goldsum)</td></tr>";
                        }
                    }
                }
            }
        }
    }
    echo "</table>"; //end first table
    echo "</td></tr></table>"; //end second primary table
    echo "</td></tr><table>";

    echo "</div>";


// Not working as I want yet.
// include("homelessloss.php");
    include("$directory/includes/misc/online.php");

    include("$directory/includes/misc/footer.php");
}
mysql_free_result($res_sql);
mysql_free_result($result1);
mysql_free_result($gold);
mysql_free_result($research);
mysql_free_result($goldsql);
echo "</body>";

echo "</html>";
?>


