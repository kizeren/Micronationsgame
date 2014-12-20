<?php
//TODO Remove plain html programming.  Should be pure php.
include('/home/mcbride/public_html/micronationsgame/config.php');

require_once("$directory/includes/config/auth.php");
        include("$directory/includes/misc/include.php");
      $page = basename($_SERVER['PHP_SELF']);
      $industry = mysql_real_escape_string($_GET['industry']);
      $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
      $result = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);
      //TODO Implement logging for all sql queries.
      if ($logall == 1)
      {
      $log = "SELECT * FROM members WHERE member_id = $id";
      mysql_query("INSERT INTO logall (log, page, date) VALUES ('$log', '$page',  NOW())", $db);
      }
      echo "<br><br><br>";

      while ($row = mysql_fetch_array($result))
 {

     echo "<br><br><br>";
     
      if ($industry > $row[27])
      {
          $errmsg_arr[] = 'You do not have enough jobless people.';
          $errflag = true;
      }
      if ($industry > (($row[18] * 2) - $row[31]))
      {
          $errmsg_arr[] = 'You need to buy more industrys to do that.';
          $errflag = true;
      }
            	        if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../workforce.php");
		exit();
                }
      $result1 = mysql_query("UPDATE members SET work_ind = work_ind + '$industry', jobless = jobless - '$industry' WHERE member_id = '$id'", $db);
      $industrytlog = number_format($industryt);
      $industrylog = number_format($industry);
      $result3 = mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', 'You assigned $industry people to work in your industries.', Now())", $logdb);
      include("count.php");
                $errmsg_arr[] = 'You assigned ' . number_format($industry) . ' to work your industrys.';
		$errflag = true;


      	        if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../workforce.php");
		exit();
                }

 }


?>


