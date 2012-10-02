<?php
        require_once('auth.php');
        include('config.php');
include("include.php");

        $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $name = mysql_real_escape_string($_SESSION['SESS_ALLIANCE']);


                $leaveally = mysql_query("UPDATE members SET alliance = '' WHERE member_id = '$id'", $db);
                $delete = mysql_query("UPDATE alliance SET member_id = '' WHERE member_id = '$id' AND name = '$name'", $db);
                
                $errmsg_arr[] = 'Left guild!';
                unset($_SESSION['SESS_ALLIANCE']);
	        $errflag = true;





                if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: findally.php");
		exit();

                }
?>

