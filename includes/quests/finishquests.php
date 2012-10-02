<?php
	require_once('auth.php');
        include('config.php');include("include.php");



      $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
      $quest = mysql_real_escape_string($_GET['quest']);
      

      $query = mysql_query("SELECT * FROM user_quests WHERE member_id = '$id' AND id = '$quest'", $db);
      while($queryrow = mysql_fetch_array($query))
      {
          if ($queryrow['active'] == 1 ){
                $errmsg_arr[] = 'You did not finish the qeust.';
		$errflag = true;

      }
        if($queryrow['awarded'] == 1){
                       $errmsg_arr[] = 'You already finished this quest.';
		$errflag = true;     
            
        }
      
      if($errflag)
           {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: quests.php");
		exit();
           }
      }
      $quest_sql = mysql_query("SELECT * FROM quests WHERE id = '$quest'", $db);
      while($quest = mysql_fetch_array($quest_sql))
      {
          $money = $quest['money'];
          $land = $quest['land'];
          $food = $quest['food'];
          $culture = $quest['culture'];
          $goods = $quest['goods'];
          $farms = $quest['farms'];
          $commercial = $quest['commercial'];
          $industry = $quest['industry'];
          $houses = $quest['house'];
          
      }
  mysql_query("UPDATE user_quests SET awarded = 1, datetime = NOW() WHERE member_id = '$id' AND quest_id = '$quest'", $db);
  mysql_query("UPDATE members SET money = money + '$money', land = land + '$land', farm = farm + '$farms', commercial = commerical + '$commercial', industry = industry + '$industry', housing = housing + '$houses' WHERE member_id = '$id'", $db);
  mysql_query("UPDATE resources SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods' WHERE member_id = '$id'", $db);
  mysql_query("UPDATE points SET points = points + '$land' WHERE member_id = '$id'", $db);
  header("location: quests.php")
?>
