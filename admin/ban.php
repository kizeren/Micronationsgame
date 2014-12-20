<?php     
include('/home/mcbride/public_html/micronationsgame/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");


$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $admin_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'");
        while($admin_row = mysql_fetch_array($admin_sql))
                if($admin_row[25] < 5)
                {
                    header("location: ../member-index.php");
                }

$ip = mysql_real_escape_string($_GET['ip']);

$result = mysql_query("INSERT INTO ipbans SET ip = '$ip', date = NOW() ");

                $errmsg_arr[] = 'IP Banned!';
		$errflag = true;
            if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: index.php");
		exit();
                }

?>
