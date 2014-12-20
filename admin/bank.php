<?php    
include('/home/mcbride/public_html/micronationsgame/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

                $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $admin_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
        while($admin_row = mysql_fetch_array($admin_sql))
                if($admin_row[25] < 3)
                {
                    header("location: ../member-index.php");
                }


echo "<html>";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />";
echo "<title>Admin: Edit Rogue nation</title>";
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
include("../infomsg.php");
echo "<h3>Edit the bank.</h3><br>";

$edit_sql = mysql_query("SELECT * FROM worldbank", $db);
while($edit_row = mysql_fetch_array($edit_sql))
{
    echo "<table>";
    echo "<tr><td>Editing:</td><td bgcolor=\"silver\"><b>World Bank</b></td></tr>";
    echo "<form action=\"do_edit_bank.php\" method=\"get\"><br>";
    echo "<tr><td>Money:</td><td><input class=\"textfield\" type=\"text\" value=\"" . $edit_row['money'] . "\" name=\"money\" /</td></tr>";
    echo "<tr><td>Food:</td><td><input class=\"textfield\" type=\"text\" value=\"" . $edit_row['food'] . "\" name=\"food\" /></td></tr>";
    echo "<tr><td>Culture:</td><td><input class=\"textfield\" type=\"text\" value=\"" . $edit_row['culture'] . "\" name=\"culture\" /></td></tr>";
    echo "<tr><td>Goods:</td><td><input class=\"textfield\" type=\"text\" value=\"" . $edit_row['goods'] . "\" name=\"goods\" /></td></tr>";
    echo "<tr><td>Land:</td><td><input class=\"textfield\" type=\"text\" value=\"" . $edit_row['land'] . "\" name=\"land\" /></td></tr>";
    echo "<tr><td></td><td><input type=\"submit\" value=\"submit\" class=\"myButton\"></td></tr>";
    echo "</table>";
    echo "</form>";
    
}



?>
