

<?php  
include("config.php");

  include("$directory/includes/config/auth.php");
  include("$directory/includes/misc/include.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Info</title>
        <link href="loginmodule.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <div id="banner">
            <h1>Info</h1>

            <?php
            include("$directory/includes/misc/clock.php");
            echo "</div>";

            include("$directory/includes/menus/newmenu.php");

            echo "<div id=\"main\">";
            include("$directory/includes/misc/resource.php");

            include("$directory/includes/misc/infomsg.php");
            include("$directory/includes/misc/count.php");
            $id = $_SESSION['SESS_MEMBER_ID'];
            $unitid = $_GET['unitid'];
            
$memcache = new Memcache;
$memcache->connect('127.0.0.1', 65000) or die ("Could not connect");
 

$key = md5("SELECT * FROM units WHERE id = '$unitid'");
$get_result = array();
$get_result = $memcache->get($key);
 
if ($get_result) {
 $unitname = $get_result['name'];
 $unithit = $get_result['hit'];
 $unitdef = $get_result['defense'];
 $unitdescription = $get_result['description'];
 $unitimage = $get_result['image'];
 $debug1 = "Debug: Loaded from memcache.";
 $debug2 = "Debug: Memcache refresh every $memtimeout seconds.";

 
    
} else {
        // Run the query and get the data from the database then cache it
        $query="SELECT * FROM units WHERE id = '$unitid'";
        $result = mysql_query($query, $db);
 
        $row = mysql_fetch_array($result);
 $unitname = $row['name'];
 $unithit = $row['hit'];
 $unitdef = $row['defense'];
 $unitdescription = $row['description'];
 $unitimage = $row['image'];
 $debug1 = "Debug: Loaded from database.";
 $debug2 = "Debug: Timeout set to $memtimeout seconds.";
        $memcache->set($key, $row, MEMCACHE_COMPRESSED, $memtimeout); // Store the result of the query for 20 seconds
 
        mysql_free_result($result);
}




echo "<table>";
echo "<tr><td>$unitimage</td></tr>";
echo "<tr><td>Name: $unitname</td></tr>";
echo "<tr><td>Hit: $unithit</td></tr>";
echo "<tr><td>Defense: $unitdef</td></tr>";
echo "<tr><td>Description: $unitdescription</td></tr>";
echo "</table>";
//echo "$debug1<br>$debug2";


?>

            
           
                    
