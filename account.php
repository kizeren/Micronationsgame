<?php  
include("config.php");
  include("$directory/includes/config/auth.php");
  include("$directory/includes/misc/include.php");
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html>";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
echo "<title>Information Update</title>";
echo "<link href=\"loginmodule.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "</head>";
echo "<body>";
echo "<div id=\"banner\">";
echo "<h1>Update your MicroNation.</h1>";

include("$directory/includes/misc/clock.php"); 
echo "</div>";
include("$directory/includes/menus/newmenu.php");
echo "<div id=\"main\">";
include("$directory/includes/misc/resource.php");

	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<ul class="err">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>';
		}
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}
        $langid = $_SESSION['SESS_LANG'];
$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);

$language_sql = mysql_query("SELECT * FROM lang WHERE lang = '$langid'", $langdb);
while($langrow = mysql_fetch_array($language_sql))
{
    $account1 = $langrow['account1'];
    $password = $langrow['password'];
    $firstname = $langrow['firstname'];
    $lastname = $langrow['lastname'];
    $email = $langrow['email'];
    
    
    
}
$messagesettings_sql = mysql_query("SELECT * FROM msettings WHERE member_id = '$id'", $db);
while($msettings = mysql_fetch_array($messagesettings_sql))
{

 $warreport = $msettings['warreports'];
 $news = $msettings['news'];
    
}        
        
$result = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);


while($row = mysql_fetch_array($result))
{
  echo "<table>";
  echo "<form action=\"./includes/misc/accountapply.php\" method=\"get\"><br>";
  echo "<tr><td>$firstname: </td><td><input class=\"textfield\" type=\"text\" value=\"$row[1]\" name=\"firstname\" /></td></tr>";
  echo "<tr><td>$lastname: </td><td><input class=\"textfield\" type=\"text\" value=\"$row[2]\" name=\"lastname\" /></td></tr>";
  echo "<tr><td>$email: </td><td><input class=\"textfield\" type=\"text\" value=\"$row[35]\" name=\"email\" /></td></tr>";
  echo "<tr><td>$account1 </td><td>               <select name=\"language\" >
                    <option value=\"en\">English (EN)</option>
                    <option value=\"es\">Spanish (ES)</option>
                      <option value=\"de\">German (DE)</option>

                </select> </td></tr>";
  echo "<tr><td>Mssage Settings</td><td></td></tr>";
  echo "<tr><td>War Reports</td><td><select name=\"war\">
                    <option "; 
  if(isset($warreport) && $warreport == "true")
                        {
                        print "selected=\"selected\"";
                        
                        }
  echo ">true</option> <option "; 
  if(isset($warreport) && $warreport == "false")
                        {
                        print "selected=\"selected\"";
                        
                        }
  echo ">false</option></select></td></tr>";
    echo "<tr><td>Game News</td><td><select name=\"news\">
                    <option "; 
  if(isset($news) && $news == "true")
                        {
                        print "selected=\"selected\"";
                        
                        }
  echo ">true</option> <option "; 
  if(isset($news) && $news == "false")
                        {
                        print "selected=\"selected\"";
                        
                        }
  echo ">false</option></select></td></tr>";
  echo "<tr><td><input type=\"submit\" value=\"submit\"></td></tr>";
  echo "</form>";
  echo "<form action=\"newpass.php\" method=\"get\"><br>";
  echo "<tr><td>$password: </td><td><input class=\"textfield\" type=\"password\" name=\"password\" /></td></tr>";
  echo "<tr><td><input type=\"submit\" value=\"submit\"></td></tr>";
 
  echo "</table>";



}
include("$directory/includes/misc/online.php");
echo "</div>";
include("$directory/includes/misc/count.php"); 
include("$directory/includes/misc/footer.php");
echo "</body>";
echo "</html>";
?>