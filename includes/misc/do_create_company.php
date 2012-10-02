<?php
include("../../config.php");

require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

        $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $name = mysql_real_escape_string($_GET['name']);
        $type = mysql_real_escape_string($_GET['type']);
                if($_GET['name'] == '')
                {
                    $errmsg_arr[] = 'You did not specify a name';
                    $errflag = true;
                }

               if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../createcompany.php");
		exit();
                }

                mysql_query("INSERT INTO company (member_id, name, type) VALUES ( '$id', '$name', '$type')", $db);
                $errmsg_err = 'Company created!';

	        $errflag = true;

               if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../company.php");
		exit();

                
             }
?>


