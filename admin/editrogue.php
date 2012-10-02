<?php        include('/home/nations/public_html/beta/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

                $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $admin_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
        while($admin_row = mysql_fetch_array($admin_sql))
                if($admin_row[25] < 1)
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
echo "<h3>Edit a rogue nation.</h3><br>";
?>
<table>
<form id="loginForm" name="name" method="get" action="editrogue.php">
      
      <tr><td><input name="name" type="text" class="textfield" id="name" /></td>
      <td><input type="submit" value="Submit" class="myButton"/></td></tr>
</form>

</table>
<?php
$name = mysql_real_escape_string($_GET['name']);
$edit_sql = mysql_query("SELECT * FROM roguenations WHERE name = '$name'", $db);
while($edit_row = mysql_fetch_array($edit_sql))
{
    echo "<table>";
    echo "<tr><td>Editing:</td><td bgcolor=\"silver\"><b>$name</b></td></tr>";
    echo "<form action=\"do_editrogue.php\" method=\"get\"><br>";
    echo "<tr><td>Id:</td><td>" . $edit_row['id'] . "</td></tr>";
    echo "<input type=\"hidden\" name=\"id\" value=\"" . $edit_row['id'] . "\">";
    echo "<tr><td>Name:</td><td><input class=\"textfield\" type=\"text\" value=\"" . $edit_row['name'] . "\" name=\"name\" /</td></tr>";
    echo "<tr><td>Flag:</td><td><input class=\"textfield\" type=\"text\" value=\"" . $edit_row['flag'] . "\" name=\"flag\" /></td></tr>";
    echo "<tr><td>Food:</td><td><input class=\"textfield\" type=\"text\" value=\"" . $edit_row['food'] . "\" name=\"food\" /></td></tr>";
    echo "<tr><td>Culture:</td><td><input class=\"textfield\" type=\"text\" value=\"" . $edit_row['culture'] . "\" name=\"culture\" /></td></tr>";
    echo "<tr><td>Goods:</td><td><input class=\"textfield\" type=\"text\" value=\"" . $edit_row['goods'] . "\" name=\"goods\" /></td></tr>";
    echo "<tr><td>Latitude:</td><td><input class=\"textfield\" type=\"text\" value=\"" . $edit_row['lat'] . "\" name=\"lat\" /></td></tr>";
    echo "<tr><td>Longitude:</td><td><input class=\"textfield\" type=\"text\" value=\"" . $edit_row['lon'] . "\" name=\"lon\" /></td></tr>";
    echo "<tr><td>Troops:</td><td><input class=\"textfield\" type=\"text\" value=\"" . $edit_row['infantry'] . "\" name=\"infantry\" /></td></tr>";
    echo "<tr><td>Level:</td><td><input class=\"textfield\" type=\"text\" value=\"" . $edit_row['level'] . "\" name=\"level\" /></td></tr>";
    echo "<tr><td></td><td><input type=\"submit\" value=\"submit\" class=\"myButton\"></td></tr>";
    echo "</table>";
    echo "</form>";
    
}
echo "<br><br><h3>Add a rogue nation.</h3><br>
      Please.  Only enter in the Name, Latitude and Longitude.  The other fields are for admin use only.<br>
      Levels range from 0 (infinite troops), 1 to 15.<br>
      Do not edit a rogue nation unless trained on how to do so.<br>
      Example:<br>
            Name - Alexandra, Victoria<br>
            Latitude - -37.191<br>
            Longitude - 145.711<br>
            Level - 1<br>
            <br>
            <br>
<form id=\"loginForm\" name=\"name\" method=\"get\" action=\"addrogue.php\">
       <table>
      <tr><td>Name:</td><td><input name=\"name\" type=\"text\" class=\"textfield\" /></td></tr>
      <tr><td>Flag:</td><td><input name=\"flag\" type=\"text\" class=\"textfield\" /></td></tr>
      <tr><td>Food:</td><td><input name=\"food\" type=\"text\" class=\"textfield\" /></td></tr>
      <tr><td>Culture:</td><td><input name=\"culture\" type=\"text\" class=\"textfield\" /></td></tr>
      <tr><td>Goods:</td><td><input name=\"goods\" type=\"text\" class=\"textfield\" /></td></tr>
      <tr><td>Troops:</td><td><input name=\"infantry\" type=\"text\" class=\"textfield\" /></td></tr>
      <tr><td>Latitude:</td><td><input name=\"lat\" type=\"text\" class=\"textfield\" /></td></tr>
      <tr><td>Longitude:</td><td><input name=\"lon\" type=\"text\" class=\"textfield\" /></td></tr>
      <tr><td>Level:</td><td><input name=\"level\" type=\"text\" class=\"textfield\" /></td></tr>
      <tr><td></td><td><input type=\"submit\" value=\"Submit\" class=\"myButton\"/></td></tr>
      </table>
</form>
";


?>