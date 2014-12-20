<?php     
include('/home/mcbride/public_html/micronationsgame/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$admin_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
while ($admin_row = mysql_fetch_array($admin_sql))
    if ($admin_row[25] < 4) {
        header("location: ../member-index.php");
    }


echo "<html>";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />";
echo "<title>Admin: Edit User</title>";
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
echo "<h3>";
$memberid = $_GET['id'];
$namesql = mysql_query("SELECT login FROM members WHERE member_id = '$memberid'", $db);


while ($namerow = mysql_fetch_array($namesql)) {
    $name = $namerow[0];
}
echo "Editing $name qeues.</h3><br>";

echo "<table>";
echo "<tr><th>User ID</th><th>Tanks</th><th>Spies</th><th>Infantry</th><th>Mercs</th><th>Mines</th></tr>";
$finish = "
    
<form id=\"loginForm\" name=\"name\" method=\"get\" action=\"edit.php\">
      
      <input name=\"id\" type=\"hidden\"/>
      <td><input type=\"submit\" value=\"Finish Qeue\" /></td>
</form>";
$training_sql = mysql_query("SELECT * FROM training WHERE member_id = '$memberid'", $db);
$trainmines_sql = mysql_query("SELECT * FROM trainmines WHERE member_id = '$memberid'", $db);
while ($trainmines_row = mysql_fetch_array($trainmines_sql)) {
    $mines = $trainmines_row['mines'];
    echo "<tr><td>$memberid</td><td>0</td><td>0</td><td>0</td><td>0</td><td>$mines</td>$finish</tr>";
}
while ($training_row = mysql_fetch_array($training_sql)) {
    $qeue = $training_row['id'];
       $member_id = $training_row['member_id'];
    $spies = $training_row['spies'];
    $infantry = $training_row['troops'];
    $tanks = $training_row['tanks'];
    $mercs = $training_row['mercs'];
    
    
    $finish = "
    
<form id=\"loginForm\" name=\"name\" method=\"get\" action=\"finishqeue.php\">
      
      <input name=\"id\" type=\"hidden\" value=\"$qeue\"/>
          <input name=\"memberid\" type=\"hidden\" value=\"$member_id\"/>
          <input name=\"infantry\" type=\"hidden\" value=\"$infantry\"/>
          <input name=\"tanks\" type=\"hidden\" value=\"$tanks\"/>
          <input name=\"mercs\" type=\"hidden\" value=\"$mercs\"/>
          <input name=\"spies\" type=\"hidden\" value=\"$spies\"/>

      <td><input type=\"submit\" value=\"Finish Qeue\" /></td>
</form>";


    echo "<tr><td>$member_id</td><td>$tanks</td><td>$pies</td><td>$infantry</td><td>$mercs</td><td>0</td>$finish</tr>";
}



echo "</table>";
?>
