<?php  
include('/home/mcbride/public_html/micronationsgame/config.php');

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
echo "<title>Admin: Time til Death </title>";
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
echo "<h3>User to be deleted.</h3><br>";



$ttd_sql = mysql_query("SELECT * FROM members WHERE ttd > 2016", $db);
while($ttd_row = mysql_fetch_array($ttd_sql))
{
    echo "Member ID $ttd_row[0], Name $ttd_row[3], Ticks: $ttd_row[13]<br>";
}


include("../online.php");
echo "</div>";
include("../count.php");
include("../footer.php");

?>
