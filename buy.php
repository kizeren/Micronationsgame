<?php  
include("config.php");

  include("$directory/includes/config/auth.php");
  include("$directory/includes/misc/include.php");
$langid = $_SESSION['SESS_LANG'];

$language_sql = mysql_query("SELECT * FROM purchasing WHERE lang = '$langid'", $langdb);
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

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><? echo $l1; ?></title>
        <link href="loginmodule.css" rel="stylesheet" type="text/css" />
        <link href="button.css" rel="stylesheet" type="text/css" />

    </head>
    <body><div id="banner">
            <h1>Welcome <?php echo $_SESSION['SESS_LOGIN']; ?> to <?php echo $game_name; ?>!</h1>
            <?php include("$directory/includes/misc/clock.php"); ?>
        </div>

        <?php
        include("$directory/includes/menus/newmenu.php");
        echo "<div id=\"main\">";
        include("$directory/includes/misc/resource.php");
        include("$directory/includes/misc/infomsg.php");

        $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);

        $member_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
        while ($mrow = mysql_fetch_assoc($member_sql)) {
            $structures_sql = mysql_query("SELECT * FROM structures WHERE member_id = '$id'", $db);
            while ($srow = mysql_fetch_array($structures_sql)) {
                $housing = $mrow['housing'];
                $farms = $mrow['farm'];
                $commercial = $mrow['commercial'];
                $industrial = $mrow['industrial'];
                $warehouse = $mrow['warehouse'];
                $barracks = number_format($srow['barracks']);
                $hangers = number_format($srow['hangers']);
                $freeland = number_format($freeland1 = ($mrow['land'] - ($mrow['housing'] + $mrow['farm'] + $mrow['commercial'] + $mrow['industrial'] + $mrow['warehouse'])));
                $money = number_format($mrow['money']);
                echo "<table class=\"buy\">";
                echo "<tr><td>$l2: $freeland</td><td>$l11: $money<tr>";
                echo "<form id=\"purchaseform\" name=\"purchase\" method=\"get\" action=\"./includes/misc/purchase.php\">";
                echo "<tr><td><input name=\"housing\" type=\"text\" class=\"textfield\" id=\"housing\" value=\"0\"/></td><td>$l3 $100</td><td>$l9 $housing.</td></tr>";
                echo "<tr><td><input name=\"farms\" type=\"text\" class=\"textfield\" id=\"farms\" value=\"0\"/></td><td>$l4 $100</td><td>$l9 $farms.</td></tr>";
                echo "<tr><td><input name=\"industry\" type=\"text\" class=\"textfield\" id=\"industry\" value=\"0\"/></td><td>$l5 $300</td><td>$l9 $industrial.</td></tr>";
                echo "<tr><td><input name=\"commercial\" type=\"text\" class=\"textfield\" id=\"commercial\" value=\"0\"/></td><td>$l6 $500 </td><td>$l9 $commercial.</td></tr>";
                echo "<tr><td><input name=\"warehouse\" type=\"text\" class=\"textfield\" id=\"warehouse\" value=\"0\"/></td><td>$l7 $100</td><td>$l9 $warehouse.</td></tr>";
                echo "<tr><td><input name=\"barracks\" type=\"text\" class=\"textfield\" id=\"barracks\" value=\"0\"/></td><td>$l8 $10,000</td><td>$l9 $barracks.</td></tr>";
                echo "<tr><td><input name=\"hangers\" type=\"text\" class=\"textfield\" id=\"hangers\" value=\"0\"/></td><td>$l12 $10,000</td><td>$l9 $hangers.</td></tr>";

                echo "<tr><td><input type=\"submit\" name=\"Submit\" value=\"$l10\" class=\"myButton\" /></td></tr>";
                echo "</form>";
                
                $goldmine = $srow['gold_mine'];
                if ($goldmine == '1') {
                    echo "</table>";
                }
                if ($goldmine == '0') {
                    echo "<form id=\"Purchase\" name=\"purchase\" method=\"get\" action=\"./includes/misc/purchase-gold.php\">";
                    
                    echo "<tr><td><input type=\"submit\" name=\"Submit\" value=\"Buy\" class=\"myButton\" /></td>";
                    echo "<td>Gold mine cost $1, 000, 000. You can only buy one.</td></tr>";
                    echo "</form>";
                    echo "</table>";
                }
            }
        }

        include("$directory/includes/misc/online.php");

        echo "</td></tr></table></div>";
        include("$directory/includes/misc/count.php");
        include("$directory/includes/misc/footer.php");
        echo "</body>";
        echo "</html>";
        mysql_free_result($member_sql);
        mysql_free_result($structures_sql);
        
        ?>