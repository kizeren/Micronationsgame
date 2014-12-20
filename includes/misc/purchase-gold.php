
<?php
include('/home/mcbride/public_html/micronationsgame/config.php');

include("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");
      $gold = 1;
      $goldt = 1000000;
      $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
      $result = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);



      while ($row = mysql_fetch_array($result))
 {


/*      if ((($row[18] * 2) + ($row[19] * 5) + $row[20]) > $row[17])
      {
                $errmsg_arr[] = 'You need more houses. You cannot have more workers then there are places to live.';
		$errflag = true;
                }
*/

      if ($goldt > $row[14])
      {
                $errmsg_arr[] = 'You need more money.';
		$errflag = true;
      }
      $gold_sql = mysql_query("SELECT * FROM structures WHERE member_id = '$id'", $db);
      while($goldrow = mysql_fetch_array($gold_sql))
      {
          if($goldrow[2] > 0)
          {
              $errmsg_arr[] = 'You already own a gold mine.';
              $errflag = true;
          }
      }

       if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../buy.php");
		exit();

                }




      $result1 = mysql_query("UPDATE structures SET gold_mine = 1 WHERE member_id = '$id'", $db);
      $result2 = mysql_query("UPDATE members SET  money = money - 1000000 WHERE member_id = '$id'", $db);
      $pointresult = mysql_query("UPDATE points SET points = points + 1000 WHERE member_id = '$id'", $db);

      $goldtlog = number_format($goldt);
      $goldlog = number_format($gold);
      $result3 = mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', 'You bought a gold mine for $1,000,000', CURRENT_TIMESTAMP)", $logdb);

      $errmsg_arr[] = 'You bought a gold mine for $1,000,000.';
      $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
      header("location: ../../buy.php");

 }


?>


