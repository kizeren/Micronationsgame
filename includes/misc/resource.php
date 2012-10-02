<?php
$langid = $_SESSION['SESS_LANG'];
$languagesql = mysql_query("SELECT * FROM resources WHERE lang = '$langid'", $langdb);
while ($langrowres = mysql_fetch_array($languagesql)) {
    $rl1 = $langrowres['1'];
    $rl2 = $langrowres['2'];
    $rl3 = $langrowres['3'];
    $rl4 = $langrowres['4'];
    $rl5 = $langrowres['5'];
    $rl6 = $langrowres['6'];
    $rl7 = $langrowres['7'];

}
$result = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);
while ($row = mysql_fetch_array($result)) {
    $res_sql = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);
    while ($res_row = mysql_fetch_array($res_sql)) {
        $gold = mysql_query("SELECT * FROM structures WHERE member_id = '$id'", $db);
        while ($goldrow = mysql_fetch_array($gold)) {
            $research = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);
            while ($research_row = mysql_fetch_array($research)) {

                $goldsql = mysql_query("SELECT * FROM research WHERE member_id = '$id'", $db);
                while ($gold = mysql_fetch_array($goldsql)) {
                    $goldprod = $research_row[17];
                    $goldsum = $gold[6] * 0.001;
                       $leadsql = mysql_query("SELECT * FROM lead_mine WHERE member_id = '$id'", $db);
                       while($leadrow = mysql_fetch_array($leadsql)) {
                           $lead = number_format($leadrow['lead']); 
                           
                           
                       }
                    $food = number_format($res_row[2]);
                    $culture = number_format($res_row[3]);
                    $goods = number_format($res_row[4]);
                    $food_tick = number_format($row[33] * 10);
                    $culture_tick = number_format($row[32] * 5);
                    $goods_tick = number_format($row[31] * 3);
                    $money = number_format($row['money']);
                
                }
            }
        }
    }
}
?>
<script type="text/javascript" src="./overlib/overlib.js"><!-- overLIB (c) Erik Bosrup --></script>

<div id="res_bar" style="left: 400px; top: 60px;">
    <table><tr>
            <td><img src="" height="17px" width="17px" onmouseover="return overlib('<? echo $rl5; ?>.', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3);" onmouseout="return nd();"></td><td><? echo "$$money"; ?></td>
            <td><img src="../icons/Food.png" height="17px" width="17px" onmouseover="return overlib('<? echo $rl1; ?>.<br> <?echo $rl4; ?>: <? echo "$food_tick"; ?>', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3);" onmouseout="return nd();"></td><td><? echo "$food"; ?></td>
            <td><img src="../icons/vinyl-record-icon.jpg" height="17px" width="17px" onmouseover="return overlib('<? echo $rl2; ?>.<br> <?echo $rl4; ?>: <? echo "$culture_tick"; ?>', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3);" onmouseout="return nd();"></td><td><? echo "$culture"; ?></td>
            <td><img src="../icons/e84ba8be.png" height="17px" width="17px" onmouseover="return overlib('<? echo $rl3; ?>.<br> <?echo $rl4; ?>: <? echo "$goods_tick"; ?>', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3);" onmouseout="return nd();"></td><td><? echo "$goods"; ?></td>
            <td><img src="../icons/Gold-Bar-icon.png" height="17px" width="17px" onmouseover="return overlib('<? echo $rl7; ?>.<br> <?echo $rl4; ?>: <? echo "$goldsum"; ?>', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3);" onmouseout="return nd();"></td><td><? echo "$goldprod"; ?></td>
            <td>Lead: <? echo $lead; ?></td>
        </tr></table></div>

<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>

<?php
mysql_free_result($res_sql);
mysql_free_result($result);
mysql_free_result($gold);
mysql_free_result($research);
mysql_free_result($goldsql);
?>