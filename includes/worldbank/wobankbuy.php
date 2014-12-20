
<?php     

   include('/home/mcbride/public_html/micronationsgame/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");
      $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
      $landpreg = mysql_real_escape_string($_GET['land']);
      $foodpreg = mysql_real_escape_string($_GET['food']);
      $culturepreg = mysql_real_escape_string($_GET['culture']);
      $goodspreg = mysql_real_escape_string($_GET['goods']);
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
               if($food > $bank_row[2])
               {
                $errmsg_arr[] = 'The World Organization does not have that much food to spare.';
		$errflag = true;
                }

               if($culture > $bank_row[3])
                {
                $errmsg_arr[] = 'The World Organization does not have that much culture to spare.';
		$errflag = true;
                }
               if($goods > $bank_row[4])
                {
                $errmsg_arr[] = 'The World Organization does not have that much goods to spare.';
		$errflag = true;
                }
               if($land > $bank_row[5])
                {
                $errmsg_arr[] = 'The World Organization does not have that much land for sale.';
		$errflag = true;
                }
               if($food > $sell_row[14])
               {
                $errmsg_arr[] = 'You do not have enough money to purchase food.';
		$errflag = true;
                }

               if(($culture * 4) > $sell_row[14])
                {
                $errmsg_arr[] = 'You do not have enough money to purchase culture.';
		$errflag = true;
                }
               if(($goods * 2)> $sell_row[14])
                {
                $errmsg_arr[] = 'You do not have enough money to purchase goods.';
		$errflag = true;
                }
                if(($land * 1000)> $sell_row[14])
                {
                $errmsg_arr[] = 'You do not have enough money to purchase land.';
		$errflag = true;
                }
      	        if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../wobank.php");
		exit();

                }

                $money_sql = mysql_query("UPDATE members SET money = money - ('$food' + ('$culture' * 5) + ('$goods' * 3) + ('$land' * 1000 )), land = land + '$land' WHERE member_id = '$id'", $db);
                $food_sql = mysql_query("UPDATE resources SET food = food + '$food' WHERE member_id = '$id'", $db);
                $culture_sql = mysql_query("UPDATE resources SET culture = culture + '$culture' WHERE member_id = '$id'", $db);
                $goods_sql = mysql_query("UPDATE resources SET goods = goods + '$goods' WHERE member_id = '$id'", $db);
                $bank_sql = mysql_query("UPDATE worldbank SET food = food - '$food', culture = culture - '$culture', goods = goods - '$goods', money = money + ('$food' + ('$culture' * 5) + ('$goods' * 3)), land = land - '$land' WHERE id = 1", $db);
                $log = mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', 'You bought '" . number_format($food) . "' food, '" . number_format($culture) . "' culture, '" . number_format($goods) . "' land ', Now())", $logdb);
                $errmsg_arr[] = 'You bought ' . number_format($food) . ' food, ' . number_format($culture) . ' culture, ' . number_format($goods) . ' goods and ' . number_format($land) . 'land.';
                
                $quest_sql = mysql_query("SELECT * FROM user_quests WHERE member_id = '$id'", $db);
                while($quest_row = mysql_fetch_array($quest_sql))
                {
                    if($land >= 200 && $quest_row['quest_id'] == 1 && $quest_row['active'] == 1)
                        {
                          mysql_query("UPDATE user_quests SET active = 0, finished = 1 WHERE member_id = '$id' AND " . $quest_row['quest_id'] . " = 1", $db);
                                          $errmsg_arr[] = 'You finished a quest!';

                        }
                    
                }
                
                
                
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
