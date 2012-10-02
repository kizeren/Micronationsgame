<?php
//TODO Remove plain html programming.  Should be pure php.       
include('/home/nations/public_html/beta/config.php');

	require_once("$directory/includes/config/auth.php");
        include("$directory/includes/misc/include.php");

      $commercial = mysql_real_escape_string($_GET['commercial']);
      $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
      $result = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);

      echo "<br><br><br>";

      while ($row = mysql_fetch_array($result))
 {

     echo "<br><br><br>";

      if ($commercial > $row[27])
      {
          $errmsg_arr[] = 'You do not have enough jobless people.';
          $errflag = true;
      }
      if ($commercial > (($row[19] * 5) - $row[32]))
      {
          $errmsg_arr[] = 'You need to buy more commercial to do that.';
          $errflag = true;
      }
            	        if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../workforce.php");
		exit();
                }
      $result1 = mysql_query("UPDATE members SET work_comm = work_comm + '$commercial', jobless = jobless - '$commercial' WHERE member_id = '$id'", $db);
      $commercialtlog = number_format($commercialt);
      $commerciallog = number_format($commercial);
      $result3 = mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', 'You assigned $commercial people to work in your commercial market.', Now())", $logdb);
      include("count.php");
                $errmsg_arr[] = 'You assigned ' . number_format($commercial) . ' to work your commercial.';
		$errflag = true;


      	        if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../workforce.php");
		exit();
                }
 }


?>


