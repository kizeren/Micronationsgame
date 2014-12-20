<?php    
include('/home/mcbride/public_html/micronationsgame/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

                $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $admin_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
        while($admin_row = mysql_fetch_array($admin_sql))
                if($admin_row[25] < 4)
                {
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
echo "<h3>Edit a user.</h3><br>";
?>
<table>
<form id="loginForm" name="name" method="get" action="edit.php">
      <tr><td>Please enter a user name to edit.</td></tr>
      <tr><td><input name="name" type="text" class="textfield" id="name" /></td>
      <td><input type="submit" value="Submit" /></td></tr>
</form>

    <form id="loginForm" name="name" method="get" action="qeues.php">
      <tr><td> Please enter a user id to edit qeues.</td></tr>
      <tr><td><input name="id" type="text" class="textfield" id="name" /></td>
      <td><input type="submit" value="Submit" /></td></tr>
</form>
    
    
</table>



<?php
$name = mysql_real_escape_string($_GET['name']);
$edit_sql = mysql_query("SELECT * FROM members WHERE login = '$name'", $db);
while($edit_row = mysql_fetch_array($edit_sql))
{
    //general infomation
  echo "<table>";
  echo "<tr><td>Editing:</td><td bgcolor=\"silver\"><b>$name</b></td></tr>";
  echo "<form action=\"do_edit.php\" method=\"get\"><br>";
  echo "<tr><td>User ID: </td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[0]\" name=\"edit_id\" /></td></tr>";
  echo "<tr><td>First name: </td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[1]\" name=\"firstname\" /></td></tr>";
  echo "<tr><td>Last Name: </td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[2]\" name=\"lastname\" /></td></tr>";
  echo "<tr><td>Email Address: </td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[35]\" name=\"email\" /></td></tr>";
  echo "<tr><td>Nation:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[5]\" name=\"nation\" /></td></tr>";
  echo "<tr><td>Motto:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[6]\" name=\"motto\" /></td></tr>";
  echo "<tr><td>Monetary:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[7]\" name=\"monetary\" /></td></tr>";
  echo "<tr><td>Tree:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[8]\" name=\"tree\" /></td></tr>";
  echo "<tr><td>Plant:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[9]\" name=\"plant\" /></td></tr>";
  echo "<tr><td>Flag:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[10]\" name=\"flag\" /></td></tr>";
  echo "<tr><td>Religion:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[26]\" name=\"religion\" /></td></tr>";
  echo "<tr><td>Alliance:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[37]\" name=\"alliance\" /></td></tr>";
  //resources and buildings
  
  echo "<tr><td bgcolor=\"silver\" colspan=\"2\"><b>Population and Buildings</b></td></tr>";
  echo "<tr><td>Population:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[12]\" name=\"popcount\" /></td></tr>";
  echo "<tr><td>Money:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[14]\" name=\"money\" /></td></tr>";
  echo "<tr><td>Tax:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[15]\" name=\"tax\" /></td></tr>";
  echo "<tr><td>Housing:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[17]\" name=\"housing\" /></td></tr>";
  echo "<tr><td>Industrial:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[18]\" name=\"industrial\" /></td></tr>";
  echo "<tr><td>Commercial:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[19]\" name=\"commercial\" /></td></tr>";
  echo "<tr><td>Farm:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[20]\" name=\"farm\" /></td></tr>";
  echo "<tr><td>Warehouse:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[38]\" name=\"warehouse\" /></td></tr>";
  

  

          $res_sql = mysql_query("SELECT * FROM resources WHERE member_id = '$edit_row[0]'", $db);
          while($res_row = mysql_fetch_array($res_sql))
          {
              
              echo "<tr><th bgcolor=\"silver\" colspan=\"2\">Resources</th></tr>";
              echo "<tr><td>Food:</td><td><input class=\"textfield\" type=\"text\" value=\"$res_row[2]\" name=\"food\" /></td></tr>";
              echo "<tr><td>Culture:</td><td><input class=\"textfield\" type=\"text\" value=\"$res_row[3]\" name=\"culture\" /></td></tr>";
              echo "<tr><td>Goods:</td><td><input class=\"textfield\" type=\"text\" value=\"$res_row[4]\" name=\"goods\" /></td></tr>";
              echo "<tr><td>FarmLVL:</td><td><input class=\"textfield\" type=\"text\" value=\"$res_row[5]\" name=\"farmlvl\" /></td></tr>";
              echo "<tr><td>CultLVL:</td><td><input class=\"textfield\" type=\"text\" value=\"$res_row[8]\" name=\"culturelvl\" /></td></tr>";
              echo "<tr><td>GoodLVL:</td><td><input class=\"textfield\" type=\"text\" value=\"$res_row[11]\" name=\"industrylvl\" /></td></tr>";
              echo "<tr><td>WareLVL:</td><td><input class=\"textfield\" type=\"text\" value=\"$res_row[14]\" name=\"warehouselvl\" /></td></tr>";




          }

          $admin_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
          while($admin_row = mysql_fetch_array($admin_sql))
                if($admin_row[25] == 5)
                {

                //admin info
                
                echo "<tr><th bgcolor=\"silver\" colspan=\"2\">Do not change login name!</th></tr>";
                echo "<tr><td>UserLevel:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[25]\" name=\"userlevel\" /></td></tr>";
                echo "<tr><td>Login:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[3]\" name=\"login\" /></td></tr>";
                
                }
   // Admin but viewable by all
  
  echo "<tr><th BGCOLOR=\"red\" colspan=\"3\">Do not edit below.</th></tr>";
  echo "<tr><td>Signup Date:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[11]\" name=\"signupdate\" /></td></tr>";
  echo "<tr><td>TTD:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[13]\" name=\"ttd\" /></td></tr>";
  echo "<tr><td>Homeless:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[16]\" name=\"homeless\" /></td></tr>";
  echo "<tr><td>Jobless:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[27]\" name=\"jobless\" /></td></tr>";
  echo "<tr><td>Intro:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[29]\" name=\"first_login\" /></td></tr>";
  echo "<tr><td>Working:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[30]\" name=\"working\" /></td></tr>";
  echo "<tr><td>Work Farm:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[33]\" name=\"work_farm\" /></td></tr>";
  echo "<tr><td>Work Industrial:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[31]\" name=\"work_ind\" /></td></tr>";
  echo "<tr><td>Work Commerical:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[32]\" name=\"work_comm\" /></td></tr>";
  echo "<tr><td>Land:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[34]\" name=\"land\" /></td></tr>";
  echo "<tr><td>Messages:</td><td><input class=\"textfield\" type=\"text\" value=\"$edit_row[36]\" name=\"new_message\" /></td></tr>";

  echo "<tr><th colspan=\"2\" BGCOLOR=\"silver\">Military</td></tr>";

      $editmilitary_sql = mysql_query("SELECT * FROM military WHERE member_id = '$edit_row[0]'", $db);
  while($editmilitary_row = mysql_fetch_array($editmilitary_sql))
  {
      echo "<tr><td>Troops:</td><td><input class=\"textfield\" type=\"text\" value=\"$editmilitary_row[2]\" name=\"infantry\" /></td></tr>";
      echo "<tr><td>Spies:</td><td><input class=\"textfield\" type=\"text\" value=\"$editmilitary_row[5]\" name=\"spies\" /></td></tr>";



  }


  
  echo "<tr><td><input type=\"submit\" value=\"submit\"></td></tr>";
  echo "</form>";
    echo "</table>";


      $editip_sql = mysql_query("SELECT * FROM connectionlog WHERE member_id = '$edit_row[0]' ORDER BY date DESC LIMIT 0,1 ", $db);
  while($editip_row = mysql_fetch_array($editip_sql))
  {
    echo "<br><br>Last IP: $editip_row[2]<br><br>";


  }
}


include("../online.php");
echo "</div>";
include("../count.php");
include("../footer.php");

?>
