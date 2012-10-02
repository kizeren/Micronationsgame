<?php
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
  include("config.php");

  include("$directory/includes/config/auth.php");
  include("$directory/includes/misc/include.php");

echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
echo "<title>World Organization Bank</title>";
echo "<link href=\"loginmodule.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "</head>";
echo "<body>";
echo "<div id=\"banner\">";
echo "<h1>World Organization Bank</h1>";
include("$directory/includes/misc/clock.php");
echo "</div>";
include("$directory/includes/menus/newmenu.php");
echo "<div id=\"main\">";
include("$directory/includes/misc/infomsg.php");

$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);

$name = mysql_real_escape_string($_SESSION['SESS_LOGIN']);
$member_sql = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);
$mmoney_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
$bank_sql = mysql_query("SELECT * FROM worldbank", $db);
while ($bank_row = mysql_fetch_array($bank_sql)) {
    while ($member = mysql_fetch_array($member_sql)) {
        while ($memmoney = mysql_fetch_array($mmoney_sql)) {
            echo "<br><center><img height=\"150px\" width=\"300px\" src=\"../icons/wo.gif\"></center></br>";
            $money = number_format($bank_row[1]);
            $food = number_format($bank_row[2]);
            $culture = number_format($bank_row[3]);
            $goods = number_format($bank_row[4]);
            $land = number_format($bank_row[5]);
            $mfood = number_format($member['food']);
            $mculture = number_format($member['culture']);
            $mgoods = number_format($member['goods']);
            $mem = number_format($memmoney['money']);
            echo "<center><table>";
            echo "<tr><td align=\"center\" colspan=\"2\">Your funds</td><td class=\"spacer\"></td><td align=\"center\" colspan=\"2\">Bank funds</td></tr>";
            echo "<tr><td>Funds:</td><td>$mem</td><td class=\"spacer\"></td><td>Funds:</td><td>$money</td></tr>";
            echo "<tr><td>Food:</td><td>$mfood</td><td class=\"spacer\"></td><td>Food:</td><td>$food</td></tr>";
            echo "<tr><td>Culture:</td><td>$mculture</td><td class=\"spacer\"></td><td>Culture:</td><td>$culture</td></tr>";
            echo "<tr><td>Goods:</td><td>$mgoods</td><td class=\"spacer\"></td><td>Goods:</td><td>$goods</td></tr>";
            echo "<tr><td></td><td></td><td class=\"spacer\"><td>Land:</td><td>$land</td></tr>";
            echo "</table></center><br>";
            if ($bank_row <= 0) {
                echo "<center>The bank cannot buy anything at this time.</center>";
            } else {
                echo "<br><center><table>";
                echo "<form action=\"./includes/worldbank/wobanksell.php\" method=\"get\">";
                echo "<tr><td align=\"center\">Sell Food</td><td align=\"center\">Sell Culture</td><td align=\"center\">Sell Goods</td><td align=\"center\">Sell Land</td></tr>";
                echo "<tr>";
                echo "<td><input class=\"textfield\" value=\"0\" type=\"text\" name=\"food\" /></td>";
                echo "<td><input class=\"textfield\" value=\"0\" type=\"text\" name=\"culture\" /></td>";
                echo "<td><input class=\"textfield\" value=\"0\" type=\"text\" name=\"goods\" /></td>";
                echo "<td><input class=\"textfield\" value=\"0\" type=\"text\" name=\"land\" /></td>";
                echo "<td align=\"center\"><input type=\"submit\" value=\"Sell\" class=\"myButton\"></td>";
                echo "</tr></tr><td></td>";

                echo "<td></td></tr>";
                echo "</table></center></form>";
            }
            echo "<br><center><table>";
            echo "<form action=\"./includes/worldbank/wobankbuy.php\" method=\"get\">";
            echo "<tr><td align=\"center\">Buy Food</td><td align=\"center\">Buy Culture</td><td align=\"center\">Buy Goods</td><td align=\"center\">Buy Land</td></tr>";
            echo "<tr>";
            if ($bank_row[2] <= 0) {
                echo "<td>No food in the bank.</td>";
            } else {
                echo "<td><input class=\"textfield\" value=\"0\" type=\"text\" name=\"food\" /></td>";
            }
            if ($bank_row[3] <= 0) {
                echo "<td>No culture in the bank.</td>";
            } else {
                echo "<td><input class=\"textfield\" value=\"0\" type=\"text\" name=\"culture\" /></td>";
            }
            if ($bank_row[4] <= 0) {
                echo "<td>No goods in the bank.</td>";
            } else {
                echo "<td><input class=\"textfield\" value=\"0\" type=\"text\" name=\"goods\" /></td>";
            }

            if ($bank_row[5] <= 0) {
                echo "<td>Bank has no land.</td>";
            } else {
                echo "<td><input class=\"textfield\" value=\"0\" type=\"text\" name=\"land\" /></td>";
            }
            echo "<td align=\"center\"><input type=\"submit\" value=\"Buy\" class=\"myButton\"></td>";
            echo "</tr></tr><td></td>";

            echo "<td></td></tr>";
            echo "</table></center></form>";

            echo "<br><center><table>";
            echo "<form action=\"./includes/worldbank/offeraid.php\" method=\"get\">";
            echo "<tr><td align=\"center\">Enter the username</td><td align=\"center\">Food</td><td align=\"center\">Culture</td><td align=\"center\">Goods</td></tr>";
            echo "<tr>";
            echo "<td><input class=\"textfield\" value=\"$name\" \type=\"text\" name=\"name\" /></td>";

            echo "<td><input class=\"textfield\" value=\"0\" type=\"text\" name=\"food\" /></td>";
            echo "<td><input class=\"textfield\" value=\"0\" type=\"text\" name=\"culture\" /></td>";
            echo "<td><input class=\"textfield\" value=\"0\" type=\"text\" name=\"goods\" /></td>";
            echo "<td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Offer Foreign Aid\" class=\"myButton\"></td>";
            echo "</tr></tr><td></td>";

            echo "<td></td></tr>";
            echo "</table></center></form>";
        }
    }
}


include("$directory/includes/misc/online.php");
echo "</div>";
include("$directory/includes/misc/count.php");
include("$directory/includes/misc/footer.php");
echo "</body>";
echo "</html>";
?>