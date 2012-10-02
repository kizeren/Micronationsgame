<?php
        require_once('auth.php');
        include('config.php');
include("include.php");

        $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $result = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
        $name = $_GET['alliance'];
        while($row = mysql_fetch_array($result))
        {


                $joinally = mysql_query("UPDATE members SET alliance = '$name' WHERE member_id = '$id'", $db);
                

                $_SESSION['SESS_ALLIANCE'] = $name;
                $errmsg_err = 'Joined Guild!';

	        $errflag = true;

               if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ally.php");
                
		exit();

                }
             }
?>


