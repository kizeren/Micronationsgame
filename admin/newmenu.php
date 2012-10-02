<script type="text/javascript">
// From: http://www.webdeveloper.com/forum/showthread.php?p=1067491#post1067491

var interval = setInterval(one_second,1000);

var color_one = '#FFFFFF';
var color_two = '#902011';
var color_flag = true;

function one_second() {
  if (color_flag) { document.getElementById('mail').style.backgroundColor=color_one; }
             else { document.getElementById('mail').style.backgroundColor=color_two; }
  color_flag = !color_flag;
}
</script>
<script src="../ajaxtest.js"></script>
<?php
$id = $_SESSION['SESS_MEMBER_ID'];
$langid = $_SESSION['SESS_LANG'];

$langsql = mysql_query("SELECT * FROM lang_menu WHERE lang = '$langid'", $langdb);
while($langrow = mysql_fetch_array($langsql))
{
    $menu1 = $langrow['menu1'];
    $menu2 = $langrow['menu2'];
    $menu3 = $langrow['menu3'];
    $menu4 = $langrow['menu4'];
    $menu5 = $langrow['menu5'];
    $menu6 = $langrow['menu6'];
    $menu7 = $langrow['menu7'];
    $menu8 = $langrow['menu8'];
    $menu9 = $langrow['menu9'];
    $menu10 = $langrow['menu10'];
    $menu11 = $langrow['menu11'];
    $menu12 = $langrow['menu12'];
    $menu13 = $langrow['menu13'];
    $menu14 = $langrow['menu14'];
    $menu15 = $langrow['menu15'];
    $menu16 = $langrow['menu16'];
    $menu17 = $langrow['menu17'];
    $menu18 = $langrow['menu18'];
    $menu19 = $langrow['menu19'];
    $menu20 = $langrow['menu20'];
    $menu21 = $langrow['menu21'];
    $menu22 = $langrow['menu22'];
    $menu23 = $langrow['menu23'];
    $menu24 = $langrow['menu24'];
    $menu25 = $langrow['menu25'];
    $menu26 = $langrow['menu26'];
    $menu27 = $langrow['menu27'];
    $menu28 = $langrow['menu28'];
    $menu29 = $langrow['menu29'];
    $menu30 = $langrow['menu30'];
    $menu31 = $langrow['menu31'];
    $menu32 = $langrow['menu32'];
    $menu33 = $langrow['menu33'];
    $menu34 = $langrow['menu34'];
    $menu35 = $langrow['menu35'];
    $menu36 = $langrow['menu36'];
    
    
}
$mailsql = mysql_query("SELECT new_message FROM members WHERE member_id = '$id'", $db);
while($mail = mysql_fetch_array($mailsql)){
    if($mail['new_message'] > 0)
    {
        $message =  "<tr><td id=\"mail\"><a href=\"../messages.php\" target=\"_self\">$menu4</a></td></tr>";

    }
    if($mail['new_message'] == 0)
    {
        $message = "<tr><td><a href=\"../messages.php\" target=\"_self\">$menu4</a></td></tr>";

    }
}
echo "<div id=\"sidebar\">";
echo "<table><tr><td><div id=\"countdown\">$menu35: ";
include("../tick.php");
echo "</div></td></tr></table>";
echo "<table  class=\"member3\"><tr>";
echo "<tr><td class=\"member\"><b>$menu7<b></td></tr>";
echo "<tr><td><a href=\"../member-index.php\" target=\"_self\">$menu1</a></td></tr>";
echo "<tr><td><a href=\"../settings.php\" target=\"_self\">$menu2</a></td></tr>";
echo "<tr><td><a href=\"../member-profile.php\" target=\"_self\">$menu3</a></td></tr>";
//echo "<tr><td><a href=\"messages.php\" target=\"_self\">$menu4</a></td></tr>";
echo $message;
echo "<tr><td><a href=\"../new-message.php\" target=\"_self\">$menu5</a></td></tr>";
echo "<tr><td><a href=\"../nationlog.php\" taget=\"_self\">$menu6</a></td></tr>";
echo "<td class=\"member\"><b>$menu8<b></td></tr>";
echo "<tr><td><a href=\"../workforce.php\" target=\"_self\">$menu9</a></td></tr>";
echo "<tr><td><a href=\"../buy.php\" target=\"_self\">$menu10</a></td></tr>";
echo "<td class=\"member\"><b>$menu11<b></td></tr>";
echo "<tr><td><a href=\"../wobank.php\" target=\"_self\">$menu12</a></td></tr>";
echo "<tr><td><a href=\"../news.php\" target=\"_self\">$menu13</a></td></tr>";
echo "<tr><td><a href=\"../stats.php\" target=\"_self\">$menu14</a></td></tr>";
echo "<tr><td><a href=\"../quests.php\" target=\"_self\">$menu15</a></td></tr>";
echo "<tr><td><a href=\"../rank.php\" target=\"_self\">$menu34</a></td></tr>";
echo "<td class=\"member\"><b>$menu16</b></td></tr>";
echo "<tr><td><a href=\"../military.php\" target=\"_self\">$menu17</a></td></tr>";
echo "<tr><td><a href=\"../sat.php\" target=\"_self\">$menu18</a></td></tr>";
echo "<tr><td><a href=\"../battle.php\" target=\"_self\">$menu19</a></td></tr>";
echo "<tr><td><a href=\"../ally.php\" target=\"_self\">$menu20</a></td></tr>";
echo "<tr><td><a href=\"../ajaxmap.php\" target=\"_self\">$menu21</a></td></tr>";
echo "<td class=\"member\"><b>$menu22<b></td></tr>";
echo "<tr><td><a href=\"../chat.php\" target=\"_blank\">$menu23</a></td></tr>";
echo "<td class=\"member\"><b>$menu24<b></td></tr>";
echo "<tr><td><a href=\"../research.php\" target=\"_self\">$menu25</a></td></tr>";
echo "<td class=\"member\"><b>$menu26<b></td></tr>";
echo "<tr><td><a href=\"../account.php\" target=\"_self\">$menu27</a></td></tr>";
echo "<tr><td><a href=\"../support.php\" target=\"_self\">$menu28</a></td></tr>";
echo "<tr><td><a href=\"../forum/\" target=\"_blank\">$menu36</a></td></tr>";
echo "<tr><td><a href=\"../help.php\" target=\"_self\">$menu29</a></td></tr>";
echo "<tr><td><a href=\"http://wiki.micronationsgame.com\" target=\"_blank\">$menu30</a></td></tr>";
echo "<tr><td><a href=\"../gettingstarted.php\" target=\"_self\">$menu31</a></td></tr>";
echo "<tr><td><a href=\"../rules.php\" target=\"_self\">$menu32</a></td></tr>";
echo "<tr><td><a href=\"../logout.php\" target=\"_self\">$menu33</a></td></tr>";


//Admin portion of menu
        $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $admin_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
        while($admin_row = mysql_fetch_array($admin_sql))
                if($admin_row[25] > 0)
                {
                    echo "<tr><td class=\"member\">Administrate </td></tr>";
                if($admin_row[25] == 5)
                {
                    
                    echo "<tr><td><a href=\"news.php\">Post News</a><br></td></tr>";
                }
                if($admin_row[25] >= 4)
                {
                    echo "<tr><td><a href=\"multi.php\">Multihunt</a><br></td></tr>";
                    echo "<tr><td><a href=\"ttd.php\">TTD Users</a><br></td></tr>";
                    echo "<tr><td><a href=\"edit.php\">Edit User</a><br></td></tr>";
                    echo "<tr><td><a href=\"rules.php\">Edit Rules</a><br></td></tr>";
                    echo "<tr><td><a href=\"bank.php\">Edit Bank</a><br></td></tr>";

                }
                                if($admin_row[25] >= 1)
                {

                    echo "<tr><td><a href=\"editrogue.php\">Edit Rogues</a></td></tr>";
                }
                }


echo "</table></div>";
mysql_free_result($langsql);
mysql_free_result($mailsql);
mysql_free_result($admin_sql);
?>