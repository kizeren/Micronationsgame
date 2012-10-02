<?php
//TODO Remove plain html programming.  Should be pure php.
        include("/home/nations/public_html/beta/config.php");

	include("$directory/includes/config/auth.php");
        include("$directory/includes/misc/include.php");

      $farm = mysql_real_escape_string($_GET['farm']);
      $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
      $result = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);

      echo "<br><br><br>";

      while ($row = mysql_fetch_array($result))
 {

     echo "<br><br><br>";

      if ($farm > $row[27])
      {
          $errmsg_arr[] = 'You do not have enough jobless people.';
          $errflag = true;
      }
      if ($farm > ($row[20] - $row[33]))
      {
          
          $errmsg_arr[] = 'You need to buy more farms to do that.';
          $errflag = true;

       }



      	        if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../workforce.php");
		exit();
                }
      $result1 = mysql_query("UPDATE members SET work_farm = work_farm + '$farm', jobless = jobless - '$farm' WHERE member_id = '$id'", $db);
      $farmtlog = number_format($farmt);
      $farmlog = number_format($farm);
      $result3 = mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', 'You assigned $farm people to work in your farms.', Now())", $logdb);
      include("$directory/includes/misc/count.php");
                $errmsg_arr[] = 'You assigned ' . number_format($farm) . ' to work your farms.';
		$errflag = true;


      	        if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../workforce.php");
		exit();
                }

 }


?>


