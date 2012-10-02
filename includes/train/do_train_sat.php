<?php        include('/home/nations/public_html/beta/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

      $sat = mysql_real_escape_string($_GET['sat']);
      $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
      $result = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);
      $result2 = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);




      while ($row = mysql_fetch_array($result))
 {


      if ($sat > $row[27])
      {
                $errmsg_arr[] = 'You do not have enough jobless to train.';
		$errflag = true;
       }
             if ($sat > $row[14])
      {
                $errmsg_arr[] = 'You do not have enough money to train.';
		$errflag = true;
       }
while($res = mysql_fetch_array($result2))
{
      if (($sat * 1000000) > $res[3])
      {
                $errmsg_arr[] = 'You do not have enough culture to train.';
		$errflag = true;
       }

             if (($sat * 1000000 ) > $res[4])
      {
                $errmsg_arr[] = 'You do not have enough goods to train.';
		$errflag = true;
       }
}
      if ($sat * 5000000 > $row[14])
      {
                $errmsg_arr[] = 'You do not have enough money to train.';
		$errflag = true;

      }

      if($errflag)
           {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../military.php");
		exit();
           }
      $culture = $sat * 1000000;
      $goods = $sat * 1000000;
      $sat_t = $sat * 5000000;
      $message = 'You trained ' . number_format($sat) . ' for '. number_format($sat_t) . ' ' . number_format($row[7]) . ',' . number_format($culture) . 'culture, ' . number_format($goods) . 'goods.';
      $result2 = mysql_query("UPDATE military SET sat = sat + '$sat' WHERE member_id = '$id'", $db);
      $money = mysql_query("UPDATE members SET money = money - '$sat_t', popcount = popcount - '$sat' WHERE member_id = '$id'", $db);
      $res_cost = mysql_query("UPDATE resources SET culture = culture - '$culture', goods = goods - '$goods' WHERE member_id = '$id'", $db);
      $result3 = mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', '$message', Now())", $logdb);

      $errmsg_arr[] = "$message";
      $errflag = true;
            if($errflag)
           {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../military.php");
		exit();
           }


 }


?>

