<?php
include('/home/mcbride/public_html/micronationsgame/config.php');

include("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");
      $id = mysql_real_escape_string($_SESSION['SESS_LOGIN']);
      $message = mysql_real_escape_string($_GET['delete']);
      mysql_query("DELETE FROM messages WHERE id = '$message' AND user = '$id'", $db);
      mysql_query("UPDATE members SET new_message = new_message - 1 WHERE login = '$id'", $db);
      $errmsg_arr[] = 'Message deleted.';
      $errflag = true;


	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../messages.php");
		exit();
	}
?>
