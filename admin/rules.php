<?php        include('/home/nations/public_html/beta/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

                $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $admin_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'");
        while($admin_row = mysql_fetch_array($admin_sql))
                if($admin_row[25] < 4)
                {
                    header("location: ../member-index.php");
                }


echo "<html>";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />";
echo "<title>Admin: Rules</title>";
echo "<link href=\"../loginmodule.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "</head>";
echo "<body><div id\"banner\">";
echo "<h1>Welcome";
echo $_SESSION['SESS_LOGIN'];
echo " to ";
echo $game_name; 
echo "<img src=\"http://mcbride.homelinux.net/~nations/flags/beta_icon.gif\"></h1>";
include("../clock.php");
echo "</div>";
include("newmenu.php");
echo "<div id=\"main\">";
include("infomsg.php");
echo "<h3>Rules.</h3><br>";

include("../functions.php");
$rules_sql = mysql_query("SELECT * FROM rules");
while($rules_row = mysql_fetch_array($rules_sql))
{
    echo "<form id=\"rules\" name=\"rules\" method=\"get\" action=\"post_rules.php\">";
    echo "<textarea cols=\"100\" rows=\"20\" name=\"rules\">$rules_row[0]</textarea>";
    echo "<input type=\"submit\" name=\"Post\"/>";
    echo "<br><Br><BR><BR><BR>";
    echo bb2html($rules_row[0]);

}



include("../online.php");
echo "</div>";
include("../count.php");
include("../footer.php");
echo "</body>";
echo "</html>";
?>