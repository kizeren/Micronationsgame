<?php        include('/home/nations/public_html/beta/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $admin_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
        while($admin_row = mysql_fetch_array($admin_sql))
                if($admin_row[25] < 3)
                {
                    header("location: ../member-index.php");
                }
$money = mysql_real_escape_string($_GET['money']);
$food = mysql_real_escape_string($_GET['food']);
$culture = mysql_real_escape_string($_GET['culture']);
$goods = mysql_real_escape_string($_GET['goods']);
$land = mysql_real_escape_string($_GET['land']);
                


mysql_query("UPDATE worldbank SET money = '$money', food = '$food', culture = '$culture', goods = '$goods', land = '$land'", $db);

                $errmsg_arr[] = 'Bank updated.';
		$errflag = true;
            if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: bank.php");
		exit();

                }



?>