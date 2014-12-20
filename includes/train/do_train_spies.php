<?php


   include('/home/mcbride/public_html/micronationsgame/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

      $spies = mysql_real_escape_string($_GET['spies']);
      $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
      $result = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);
      $result2 = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);




      while ($row = mysql_fetch_array($result))
 {


      if ($spies > $row[27])
      {
                $errmsg_arr[] = 'You do not have enough jobless to train.';
		$errflag = true;
       }
             if ($spies > $row[14])
      {
                $errmsg_arr[] = 'You do not have enough money to train.';
		$errflag = true;
       }
while($res = mysql_fetch_array($result2))
{
      if (($spies * 1000) > $res[3])
      {
                $errmsg_arr[] = 'You do not have enough culture to train.';
		$errflag = true;
       }

             if (($spies * 1000 ) > $res[4])
      {
                $errmsg_arr[] = 'You do not have enough goods to train.';
		$errflag = true;
       }
}
      if ($spies * 50000 > $row[14])
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
      $culture = $spies * 1000;
      $goods = $spies * 1000;
      $spies_t = $spies * 50000;
            //date time for finished troops
                  $research_sql = mysql_query("SELECT * FROM research WHERE member_id='$id'", $db);
            while ($research = mysql_fetch_array($research_sql)) {
                
            $lvl = $research['miltrainlvl'];
  $ticks = round(($spies / $lvl) * 5);
  $now   = new DateTime;
  $clone = $now;        //this doesnot clone so:
  $clone->modify( '+' . $ticks . ' Minutes' );
 
  $date = $now->format( 'm/d/Y g:i:s A' );
            }
     // $result2 = mysql_query("UPDATE military SET spies = spies + '$spies' WHERE member_id = '$id'", $db);
            mysql_query("INSERT INTO training ( member_id, spies, done, lvl ) VALUES ('$id', '$spies', '$date', '$lvl')" , $db);

      $money = mysql_query("UPDATE members SET money = money - '$spies_t', popcount = popcount - '$spies' WHERE member_id = '$id'", $db);
      $res_cost = mysql_query("UPDATE resources SET culture = culture - '$culture', goods = goods - '$goods' WHERE member_id = '$id'", $db);
      $result3 = mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', 'You trained $spies for $spies_t $row[7], $culture culture and $goods goods.', Now())", $logdb);

      $errmsg_arr[] = 'You trained ' . $spies . ' for '. $spies_t . ' ' . $row[7] . ',' . $culture . 'culture, ' . $goods . 'goods.';
      $errflag = true;
            if($errflag)
           {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../military.php");
		exit();
           }


 }


?>

