<?php
include('/home/mcbride/public_html/micronationsgame/config.php');

	require_once("$directory/includes/config/auth.php");
        include("$directory/includes/misc/include.php");

      $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
      $flag_id = mysql_real_escape_string($_GET['id']);
      $flag_sql = mysql_query("SELECT * FROM flags WHERE id = '$flag_id'", $db);
      while($flag_row = mysql_fetch_array($flag_sql))
      {
      $select_flag = mysql_query("UPDATE members SET flag = '$flag_row[1]' WHERE member_id = '$id'", $db);
      }
      $errmsg_arr[] = 'Flag updated.';
      $errflag = true;


	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../settings.php");
		exit();
	}
?>
