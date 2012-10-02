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
echo "<title>Admin: News</title>";
echo "<link href=\"../loginmodule.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "</head>";
echo "<body><div id\"banner\">";
echo "<h1>Welcome";
echo $_SESSION['SESS_LOGIN'];
echo " to ";
echo $game_name; 
echo "<img src=\"http://mcbride.homelinux.net/~nations/flags/beta_icon.gif\"></h1>";
include("$directory/includes/misc/clock.php");
echo "</div>";
include("newmenu.php");
echo "<div id=\"main\">";
include("$directory/includes/misc/infomsg.php");
echo "<h3>Post news.</h3><br>";
?>

<table>
<form id="News" name="news" method="get" action="post_news.php">
    <tr><td>Title:</td><td> <input name="title" type="text" class="textfield" id="title" /></td></tr>
    <tr><td>News:</td><td> <textarea cols="50" rows="4" name="body"></textarea></td></tr>
    <tr><td><input type="submit" name="Post" value="news" /></td></tr>
</table>
</form>
<?php
include("$directory/includes/misc/online.php");
echo "</div>";
include("$directory/includes/misc/count.php");
include("$directory/includes/misc/footer.php");

?>
</body>
</html>