<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
include("config.php");

include("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");
header('Refresh: 60');
$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);



echo "<html>";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
echo "<title>Research</title>";
echo "<link href=\"loginmodule.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "</head>";
echo "<body>";
echo "<div id=\"banner\">";
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
echo "<h1>Research</h1>";
include("$directory/includes/misc/clock.php");
echo "</div>";
include("$directory/includes/menus/newmenu.php");
echo "<div id=\"main\">";
include("$directory/includes/misc/infomsg.php");
include("$directory/includes/misc/resource.php");
echo "<table id=\"table-3\">";
?>

<?
$research = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);

$research2 = mysql_query("SELECT * FROM resource_cost WHERE id = 1", $db);
$research3 = mysql_query("SELECT * FROM resource_cost WHERE id = 2", $db);
$research4 = mysql_query("SELECT * FROM resource_cost WHERE id = 3", $db);
$research5 = mysql_query("SELECT * FROM resource_cost WHERE id = 4", $db);
$research6 = mysql_query("SELECT * FROM resource_cost WHERE id = 5", $db);
$research7 = mysql_query("SELECT * FROM resource_cost WHERE id = 6", $db);
$research8 = mysql_query("SELECT * FROM research WHERE member_id = '$id'", $db);
$research9 = mysql_query("SELECT * FROM research WHERE member_id = '$id'", $db);
$research10 = mysql_query("SELECT * FROM resource_cost WHERE id = 7", $db);
$research11 = mysql_query("SELECT * FROM research WHERE member_id = '$id'", $db);
$research12 = mysql_query("SELECT * FROM resource_cost WHERE id = 8", $db);
//TODO Clean this crap up!!
$research13 = mysql_query("SELECT * FROM resource_cost WHERE id = 9", $db);
$research14 = mysql_query("SELECT * FROM resource_cost WHERE id = 10", $db);


while ($research_row = mysql_fetch_array($research)) {



    //FARMING RESEARCH

    while ($research2_row = mysql_fetch_array($research2)) {
        if ($research_row[7] > 0) {
            $fftick = $research_row['farmlvl'] - $research_row[6];
            $ftick = round(($research_row[6] / $research_row['farmlvl']) * 100);
            echo "<tr><td>Researching farming to level $research_row[5]. Ticks left: $fftick <script type=\"text/javascript\">drawProgressBar('#33cc33', 288, $ftick);</script> ";
            echo "<form action=\"./includes/research/speedupresearch.php\" metho=\"get\">";
            echo "<input type=\"hidden\" name=\"farm\" value=\"1\">";
            echo "<input type=\"submit\" value=\"Speed Up Research\" />";
            echo "</form>";
        } else {
            echo "<tr><td>Research Cost for Farming: " . number_format($research2_row[2] * ($research_row[5] + 1) + 0.6) . " Food, " . number_format($research2_row[3] * ($research_row[5] + 1)) . " culture and " . number_format($research2_row[4] * ($research_row[5] + 1)) . " goods.";
            echo "<form action=\"./includes/research/researchfarm.php\" method=\"get\">";
            echo "<input type=\"hidden\" name=\"isfarmresearch\" value=\"isfarmresearch\">";
            echo "<input type=\"submit\" value=\"Research Farming\" />";
            echo "</form>";
            echo "</td></tr>";
        }
    }
    // CULTURE RESEARCH
    while ($research3_row = mysql_fetch_array($research3)) {

        if ($research_row[10] > 0) {
            $cctick = $research_row['culturelvl'] - $research_row[9];
            $ccstick = round(($research_row[9] / $research_row['culturelvl']) * 100);

            echo "<tr><td>Researching culture to level $research_row[8]. Ticks left: $cctick <script type=\"text/javascript\">drawProgressBar('#33cc33', 288, $ccstick);</script>";
            echo "<form action=\"./includes/research/speedupresearch.php\" metho=\"get\">";
            echo "<input type=\"hidden\" name=\"commercial\" value=\"1\">";
            echo "<input type=\"submit\" value=\"Speed Up Research\" />";
            echo "</form>";
        } else {
            echo "<tr><td>Research Cost for culture: " . number_format($research3_row[2] * ($research_row[8] + 1) * 2) . " Food, " . number_format($research3_row[3] * ($research_row[8] + 1) * 2) . " culture and " . number_format($research3_row[4] * ($research_row[8] + 1) + 0.3) . " goods.";
            echo "<form action=\"./includes/research/researchculture.php\" method=\"get\">";
            echo "<input type=\"hidden\" name=\"isfarmresearch\" value=\"iscultureresearch\">";
            echo "<input type=\"submit\" value=\"Research Culture\" />";
            echo "</form>";
            echo "</td></tr>";
        }
    }
// INDUSTRY RESEARCH
    while ($research4_row = mysql_fetch_array($research4)) {
        if ($research_row[13] > 0) {
            $ggtick = $research_row['industrylvl'] - $research_row[12];
            $gtick = round(($research_row[12] / $research_row['industrylvl']) * 100);
            echo "<tr><td>Researching industry to level $research_row[11]. Ticks left: $ggtick <script type=\"text/javascript\">drawProgressBar('#33cc33', 288, $gtick);</script>";
            echo "<form action=\"./includes/research/speedupresearch.php\" metho=\"get\">";
            echo "<input type=\"hidden\" name=\"industry\" value=\"1\">";
            echo "<input type=\"submit\" value=\"Speed Up Research\" />";
            echo "</form>";
        } else {
            echo "<tr><td>Research Cost for industry: " . number_format($research4_row[2] * ($research_row[11] + 1) * 2) . " Food, " . number_format($research4_row[3] * ($research_row[11] + 1) * 1.5) . " culture and " . number_format($research4_row[4] * ($research_row[11] + 1) * 3) . " goods.";
            echo "<form action=\"./includes/research/researchgoods.php\" method=\"get\">";
            echo "<input type=\"hidden\" name=\"isindustryresearch\" value=\"isindustryresearch\">";
            echo "<input type=\"submit\" value=\"Research Industry\" />";
            echo "</form>";
            echo "</td></tr>";
        }
    }
    //STORAGE RESEARCH
    while ($research5_row = mysql_fetch_array($research5)) {
        if ($research_row[16] > 0) {
            $sstick = $research_row['storagelvl'] - $research_row[15];
            $stick = round(($research_row[15] / $research_row['storagelvl']) * 100);
            echo "<tr><td>Researching storage level to $research_row[14]. Ticks left: $sstick <script type=\"text/javascript\">drawProgressBar('#33cc33', 288, $stick);</script>";
            echo "<form action=\"./includes/research/speedupresearch.php\" metho=\"get\">";
            echo "<input type=\"hidden\" name=\"warehouse\" value=\"1\">";
            echo "<input type=\"submit\" value=\"Speed Up Research\" />";
            echo "</form>";
        } else {
            echo "<tr><td>Research Cost for storage: " . number_format($research5_row[2] * ($research_row[14] + 1) * 2) . " Food, " . number_format($research5_row[3] * ($research_row[14] + 1) + 0.6) . " culture and " . number_format($research5_row[4] * ($research_row[14] + 1) * 3) . " goods.";
            echo "<form action=\"./includes/research/researchstorage.php\" method=\"get\">";
            echo "<input type=\"hidden\" name=\"isstorageresearch\" value=\"isstorageresearch\">";
            echo "<input type=\"submit\" value=\"Research Storage\" />";
            echo "</form>";
            echo "</td></tr>";
        }
    }

//SATELLITE RESEARCH

    while ($research9_row = mysql_fetch_array($research9)) {
        while ($research8_row = mysql_fetch_array($research8)) {
            if ($research8_row[3] < 5) {
                echo "<tr><td>You need to research tech to level five to unlock satelites.</td></tr>";
            } else {
                while ($research6_row = mysql_fetch_array($research6)) {
                    $mil_res = mysql_query("SELECT * FROM military WHERE member_id = '$id'", $db);
                    while ($mil_row = mysql_fetch_array($mil_res)) {
                        $satick = round((100 * $mil_row[7]) / 288);
                        if ($mil_row[8] > 0) {
                            $saatick = $mil_row['satlvl'] - $mil_row[7];
                            $sattick = round(($mil_row[7] / $mil_row['satlvl']) * 100);
                            echo "<tr><td>Researching satelite tech to level $mil_row[9]. Ticks left: $saatick <script type=\"text/javascript\">drawProgressBar('#33cc33', 288, $satick);</script>";
                            echo "<form action=\"./includes/research/speedupresearch.php\" method=\"get\">";
                            echo "<input type=\"hidden\" name=\"satelite\" value=\"1\">";
                            echo "<input type=\"submit\" value=\"Speed Up Research\" />";
                            echo "</form>";
                        } else {
                            echo "<tr><td>Research Cost for Satellite: " . number_format($research6_row[2] * ($mil_row[9] + 1) * 3) . " Food, " . number_format($research6_row[3] * ($mil_row[9] + 1) * 1.6) . " culture and " . number_format($research6_row[4] * ($mil_row[9] + 1) * 4) . " goods.";
                            echo "<form action=\"./includes/research/do_sat_research.php\" method=\"get\">";
                            echo "<input type=\"hidden\" name=\"issatresearch\" value=\"issatresearch\">";
                            echo "<input type=\"submit\" value=\"Research Satellite\" />";
                            echo "</form>";
                            echo "</td></tr>";
                        }
                    }
                }
            }
//TECH RESEARCH


            while ($research7_row = mysql_fetch_array($research7)) {
                $techtick = round((100 * $research8_row[4]) / 288);
                if ($research8_row[2] > 0) {
                    $ttick = $research8_row['techlvl'] - $research8_row[4];
                    $techtick = round(( $research8_row[4] / $research8_row['techlvl']) * 100);
                    echo "<tr><td>Researching tech to level $research8_row[3]. Ticks left: $ttick <script type=\"text/javascript\">drawProgressBar('#33cc33', 288, $techtick);</script>";
                    echo "<form action=\"./includes/research/speedupresearch.php\" metho=\"get\">";
                    echo "<input type=\"hidden\" name=\"tech\" value=\"1\">";
                    echo "<input type=\"submit\" value=\"Speed Up Research\" />";
                    echo "</form>";
                } else {
                    echo "<tr><td>Research Cost for tech: " . number_format($research7_row[2] * ($research8_row[3] + 1) * 2) . " Food, " . number_format(($research7_row[3] * ($research8_row[3] + 1) * 3) + 0.5) . " culture and " . number_format($research7_row[4] * ($research8_row[3] + 1) + 0.3) . " goods.";
                    echo "<form action=\"./includes/research/techresearch.php\" method=\"get\">";
                    echo "<input type=\"hidden\" name=\"isstorageresearch\" value=\"isstorageresearch\">";
                    echo "<input type=\"submit\" value=\"Research Tech\" />";
                    echo "</form>";
                    echo "</td></tr>";
                }
            }


// Gold RESEARCH


            while ($research10_row = mysql_fetch_array($research10)) {
                $goldtick = round((100 * $research8_row[7]) / 288);
                if ($research11 >= $max_gold_level) {
                    echo "<tr><td>Max research achieved for gold mine.</td></tr>";
                } else {

                    if ($research8_row[5] > 0) {
                        $ggtick = $research8_row['goldlvl'] - $research8_row[7];
                        $goldtick = round(($research8_row[7] / $research8_row['goldlvl']) * 100);
                        echo "<tr><td>Researching gold to level $research8_row[6]. Ticks left: $ggtick <script type=\"text/javascript\">drawProgressBar('#33cc33', 288, $goldtick);</script>";
                        echo "<form action=\"./includes/research/speedupresearch.php\" metho=\"get\">";
                        echo "<input type=\"hidden\" name=\"gold\" value=\"1\">";
                        echo "<input type=\"submit\" value=\"Speed Up Research\" />";
                        echo "</form>";
                    } else {
                        echo "<tr><td>Research Cost for gold: " . number_format($research10_row[2] * ($research8_row[6] + 1) * 2) . " Food, " . number_format($research10_row[3] * ($research8_row[6] + 1) + 0.8) . " culture and " . number_format($research10_row[4] * ($research8_row[6] + 1) * 2) . " goods.";
                        echo "<form action=\"./includes/research/researchgold.php\" method=\"get\">";
                        echo "<input type=\"hidden\" name=\"isstorageresearch\" value=\"isstorageresearch\">";
                        echo "<input type=\"submit\" value=\"Research Gold\" />";
                        echo "</form>";
                        echo "</td></tr>";
                    }
                }
            }
            //Military training research
            while ($research12_row = mysql_fetch_array($research12)) {
                while ($research11_row = mysql_fetch_array($research11)) {
                    $miltick = round((100 * $research8_row[9]) / 288);
                    if ($research8_row[8] > 0) {
                        $mmiltick = $research8_row['miltrainlvl'] - $research8_row[9];
                        $miltick = round(($research8_row[9] / $research8_row['miltrainlvl']) * 100);
                        echo "<tr><td>Researching military training to level $research8_row[10]. Ticks left: $mmiltick <script type=\"text/javascript\">drawProgressBar('#33cc33', 288, $miltick);</script>";
                        echo "<form action=\"./includes/research/speedupresearch.php\" metho=\"get\">";
                        echo "<input type=\"hidden\" name=\"militarytraining\" value=\"1\">";
                        echo "<input type=\"submit\" value=\"Speed Up Research\" />";
                        echo "</form>";
                    } else {
                        echo "<tr><td>Research Cost for military training: " . number_format($research12_row[2] * ($research8_row[10] + 1) * 3) . " Food, " . number_format($research12_row[3] * ($research8_row[10] + 1) + 1.4) . " culture and " . number_format($research12_row[4] * ($research8_row[10] + 1) * 2) . " goods.";
                        echo "<form action=\"./includes/research/researchmilitary.php\" method=\"get\">";
                        echo "<input type=\"hidden\" name=\"ismiltrain\" value=\"ismiltrain\">";
                        echo "<input type=\"submit\" value=\"Research military training\" />";
                        echo "</form>";
                        echo "</td></tr>";
                    }
                }
            }
        }
    }
}
while ($refine_row = mysql_fetch_array($research13)) {
    $refine_sql = mysql_query("SELECT * FROM refinery WHERE member_id = '$id'", $db);
    while ($refinery_row = mysql_fetch_array($refine_sql)) {
        $refinelevel = $refinery_row['level'];
        $refineresearch = $refinery_row['isresearch'];
        $refinetick = $refinery_row['tick'];
        $refinefood = $refine_row['foodcost'];
        $refinecult = $refine_row['culturecost'];
        $refinegoods = $refine_row['goodscost'];

        if ($refineresearch > 0) {
            $newrefinelvl = $refinelevel + 1;
            $newrefinetick = round($refinetick / $refinelevel * 100);
            $rrtick = $refinelevel -$refinetick;
            echo "<tr><td>Researching refining to level $newrefinelvl. Ticks left: $rrtick <script type=\"text/javascript\">drawProgressBar('#33cc33', 288, $newrefinetick);</script>";
            echo "<form action=\"./includes/research/speedupresearch.php\" metho=\"get\">";
            echo "<input type=\"hidden\" name=\"militarytraining\" value=\"1\">";
            echo "<input type=\"submit\" value=\"Speed Up Research\" />";
            echo "</form>";
        } else {
            echo "<tr><td>Research Cost for refinery: " . number_format($refinefood * ($refinelevel + 1) * 3) . " Food, " . number_format($refinecult * ($refinelevel + 1) + 1.4) . " culture and " . number_format($refinegoods * ($refinelevel + 1) * 2) . " goods.";
            echo "<form action=\"./includes/research/researchrefine.php\" method=\"get\">";
            echo "<input type=\"hidden\" name=\"ismiltrain\" value=\"ismiltrain\">";
            echo "<input type=\"submit\" value=\"Research refinery technology\" />";
            echo "</form>";
            echo "</td></tr>";
        }
    }
}
while ($oil1_row = mysql_fetch_array($research14)) {
    $oil_sql = mysql_query("SELECT * FROM oil_well WHERE member_id = '$id'", $db);
    while ($oil_row = mysql_fetch_array($oil_sql)) {
        $oillevel = $oil_row['level'];
        $oilresearch = $oil_row['isresearch'];
        $oiltick = $oil_row['tick'];
        $oilfood = $oil1_row['foodcost'];
        $oilcult = $oil1_row['culturecost'];
        $oilgoods = $oil1_row['goodscost'];

        if ($oilresearch > 0) {
            $newoillvl = $oillevel + 1;
            $newoiltick = round($oiltick / $oillevel * 100);
            $rrtick = $oillevel -$oiltick;
            echo "<tr><td>Researching oil production to level $newoillvl. Ticks left: $rrtick <script type=\"text/javascript\">drawProgressBar('#33cc33', 288, $newoiltick);</script>";
            echo "<form action=\"./includes/research/speedupresearch.php\" metho=\"get\">";
            echo "<input type=\"hidden\" name=\"militarytraining\" value=\"1\">";
            echo "<input type=\"submit\" value=\"Speed Up Research\" />";
            echo "</form>";
        } else {
            echo "<tr><td>Research Cost for oil production: " . number_format($oilfood * ($oillevel + 1) * 3) . " Food, " . number_format($oilcult * ($oillevel + 1) + 1.4) . " culture and " . number_format($oilgoods * ($oillevel + 1) * 2) . " goods.";
            echo "<form action=\"./includes/research/researchoil.php\" method=\"get\">";
            echo "<input type=\"hidden\" name=\"ismiltrain\" value=\"ismiltrain\">";
            echo "<input type=\"submit\" value=\"Research oil mining\" />";
            echo "</form>";
            echo "</td></tr>";
        }
    }
}
echo "</table>";
echo "</body>";



include("$directory/includes/misc/online.php");

echo "</div>";
include("$directory/includes/misc/count.php");
include("$directory/includes/misc/footer.php");

echo "</html>";
?>










