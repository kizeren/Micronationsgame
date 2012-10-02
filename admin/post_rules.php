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

include("../functions.php");
$rules = mysql_real_escape_string($_GET['rules']);

mysql_query("UPDATE rules SET rules = '$rules'");
                $errmsg_arr[] = 'Rules Posted.';
		$errflag = true;
            if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: index.php");
		exit();

                }
?>