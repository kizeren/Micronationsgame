<?php
        require_once('auth.php');
        include('config.php');
        include("include.php");

        $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $name = mysql_real_escape_string($_GET['alliance']);
                if($_GET['alliance'] == '')
                {
                    $errmsg_arr[] = 'You did not specify a name';
                    $errflag = true;
                }

               if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ally.php");
		exit();
                }






        $result = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
        while($row = mysql_fetch_array($result))
        {



               if($row[14] < 10000000)
                {
                $errmsg_arr[] = 'You do not have enough money.';
		$errflag = true;
                }

                if($name =='')
                {
                    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                    header("location: ally.php");
                }

      	        if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ally.php");
		exit();

                }
                mysql_query("INSERT INTO alliance (member_id, isleader, name, description) VALUES ( '$id', '1', '$name', '<br><center><h1>This alliance has no info!</h1></center><br>')", $db);
                mysql_query("UPDATE members SET alliance = '$name', money = money - 10000000 WHERE member_id = '$id'", $db);
                mysql_query("INSERT INTO allyname (name) VALUES ('$name')", $db);
                $_SESSION['SESS_ALLIANCE'] = $name;
                $errmsg_err = 'Guild created!';

	        $errflag = true;

               if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ally.php");
		exit();

                }
             }
?>


