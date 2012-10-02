
<?php        include('/home/nations/public_html/beta/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");
      $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
      $foodpreg = mysql_real_escape_string($_GET['food']);
      $culturepreg = mysql_real_escape_string($_GET['culture']);
      $goodspreg = mysql_real_escape_string($_GET['goods']);
      $landpreg = mysql_real_escape_string($_GET['land']);
      $bank_sql = mysql_query("SELECT * FROM worldbank", $db);
      $sell_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
      $res_sql = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);
      $food = preg_replace("/[[:^digit:]]/", '', $foodpreg);
      $culture = preg_replace("/[[:^digit:]]/", '', $culturepreg);
      $goods = preg_replace("/[[:^digit:]]/", '', $goodspreg);
      $land = preg_replace("/[[:^digit:]]/", '', $landpreg);
      while($bank_row = mysql_fetch_array($bank_sql))
      {
          while($sell_row = mysql_fetch_array($sell_sql))
          {
              while($res_row = mysql_fetch_array($res_sql))
              {
               if($food > $bank_row[1])
               {
                $errmsg_arr[] = 'The World Organization cannot afford to buy that much food.';
		$errflag = true;
                }

               if(($culture * 4) > $bank_row[1])
                {
                $errmsg_arr[] = 'The World Organization cannot afford to buy that much culture.';
		$errflag = true;
                }
               if(($goods * 2) > $bank_row[1])
                {
                $errmsg_arr[] = 'The World Organization cannot afford to buy that many goods.';
		$errflag = true;
                }
               if(($land * 1000) > $bank_row[5])
                {
                $errmsg_arr[] = 'The World Organization cannot afford to buy that much land.';
		$errflag = true;
                }
               if($food > $res_row[2])
               {
                $errmsg_arr[] = 'You do not have that much food.';
		$errflag = true;
                }

               if($culture > $res_row[3])
                {
                $errmsg_arr[] = 'You do not have that much culture.';
		$errflag = true;
                }
               if($goods > $res_row[4])
                {
                $errmsg_arr[] = 'You do not have that many goods.';
		$errflag = true;
                }
                $freeland = number_format($freeland1 = ($sell_row[34] - ($sell_row[19] + $sell_row[18] + $sell_row[20] + $sell_row[17] + $sell_row[38])));
               if($land > $freeland)
                {
                $errmsg_arr[] = 'You do not have that much free land.';
		$errflag = true;
                }
      	        if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../wobank.php");
		exit();

                }

                $money_sql = mysql_query("UPDATE members SET money = money + ('$food' + ('$culture' * 4) + ('$goods' * 2) + ('$land' * 1000)), land = land - '$land' WHERE member_id = '$id'", $db);
                $food_sql = mysql_query("UPDATE resources SET food = food - '$food' WHERE member_id = '$id'", $db);
                $culture_sql = mysql_query("UPDATE resources SET culture = culture - '$culture' WHERE member_id = '$id'", $db);
                $goods_sql = mysql_query("UPDATE resources SET goods = goods - '$goods' WHERE member_id = '$id'", $db);
                $bank_sql = mysql_query("UPDATE worldbank SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', land = land + '$land', money = money - ('$food' + ('$culture' * 4) + ('$goods' * 2) + ('$land' * 1000)) WHERE id = 1", $db);

                $errmsg_arr[] = 'You sold ' . number_format($food) . ' food, ' . number_format($culture) . ' culture, ' . number_format($goods) . ' goods and ' . number_format($land) . ' land.';
		$errflag = true;


      	        if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../wobank.php");
		exit();
                }




              }
          }
      }
?>
