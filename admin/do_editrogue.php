<?php    
include('/home/mcbride/public_html/micronationsgame/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $admin_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
        while($admin_row = mysql_fetch_array($admin_sql))
                if($admin_row[25] < 1)
                {
                    header("location: ../member-index.php");
                }
$id = mysql_real_escape_string($_GET['id']);
$name = mysql_real_escape_string($_GET['name']);
$flag = mysql_real_escape_string($_GET['flag']);
$food = mysql_real_escape_string($_GET['food']);
$culture = mysql_real_escape_string($_GET['culture']);
$goods = mysql_real_escape_string($_GET['goods']);
$lat = mysql_real_escape_string($_GET['lat']);
$lon = mysql_real_escape_string($_GET['lon']);
$infantry = mysql_real_escape_string($_GET['infantry']);
$level = mysql_real_escape_string($_GET['level']);
                


mysql_query("UPDATE roguenations SET name = '$name', flag = '$flag', food = '$food', culture = '$culture', goods = '$goods', lat = '$lat', lon = '$lon', level = '$level', infantry = '$infantry' WHERE id = '$id'", $db);

                $errmsg_arr[] = 'Rogue nation added.';
		$errflag = true;
            if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: editrogue.php");
		exit();

                }



?>
