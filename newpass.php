<?php
  include("./includes/config/auth.php");
  include("./includes/config/config.php");
  include("./includes/misc/include.php");
?>

<?php


      $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
      $password = mysql_real_escape_string($_GET['password']);

        if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}

	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: account.php");
		exit();
	}
        $password = mysql_real_escape_string($_GET['password']);
        $result = mysql_query("UPDATE members SET passwd = '".md5($password)."' WHERE member_id = '$id'", $db);
        

        $errmsg_arr[] = 'Password Changed';
        $errflag = true;
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	header("location: account.php");
        ?>
