
<?php        include('/home/nations/public_html/beta/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");
      $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
      $from = $_SESSION['SESS_LOGIN'];
      $name = mysql_real_escape_string($_GET['name']);
      $foodpreg = mysql_real_escape_string($_GET['food']);
      $culturepreg = mysql_real_escape_string($_GET['culture']);
      $goodspreg = mysql_real_escape_string($_GET['goods']);
      $bank_sql = mysql_query("SELECT * FROM worldbank", $db);
      $sell_sql = mysql_query("SELECT * FROM members WHERE login = '$name'", $db);
      $res_sql = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);
      $food = preg_replace("/[[:^digit:]]/", '', $foodpreg);
      $culture = preg_replace("/[[:^digit:]]/", '', $culturepreg);

      $goods = preg_replace("/[[:^digit:]]/", '', $goodspreg);

      if($name != '') {
		$qry = "SELECT * FROM members WHERE login='$name'";
		$result = mysql_query($qry, $db);
		if($result) {
			if(mysql_num_rows($result) <= 0) {
				$errmsg_arr[] = 'That user does not exist.';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
             }

            if($_GET['name'] == '')
                {
                    $errmsg_arr[] = 'You did not specify a name';
                    $errflag = true;
                }

             if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../wobank.php");
		exit();

                }
      while($bank_row = mysql_fetch_array($bank_sql))
      {
          

          while($sell_row = mysql_fetch_array($sell_sql))

          {

              while($res_row = mysql_fetch_array($res_sql))
              {

               if($food > $res_row[2])
               {
                $errmsg_arr[] = 'Not enough food.';
		$errflag = true;
                }

               if($culture > $res_row[3])
                {
                $errmsg_arr[] = 'Not enough culture.';
		$errflag = true;
                }
               if($goods> $res_row[4])
                {
                $errmsg_arr[] = 'Not enough goods.';
		$errflag = true;
                }
                if($name == $from)
                {
                    $errmsg_arr[] = 'You cannot send to yourself. Please check the username and try again.';
                    $errflag = true;
                }

      	        if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../wobank.php");
		exit();

                }

    
                $food_sql = mysql_query("UPDATE resources SET food = food - '$food', culture = culture - '$culture', goods = goods - '$goods' WHERE member_id = '$id'", $db);
                $culture_sql = mysql_query("UPDATE resources SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods' WHERE member_id  = '$sell_row[0]'", $db);

                $subject = "Foreign Aid";
                $body = "<center><img height=\"150px\" width=\"300px\" src=\"icons/wo.gif\"></center><br>
                         <center>You have recieved a gracious amount of resources in the amount of $food food, $culture culture and $goods goods.</center><br>
                         <center>From: <img width=\"40px\" height=\"20px\" src=\"$sell_row[10]\">$nbsp$nbsp $from</center>";
                $message1 = "You sent " . number_format($food) . " food, " . number_format($culture) . " culture, " . number_format($goods) . " goods to $name.";
                $message2 = "You recieved foreign aid " . number_format($food) . " food, " . number_format($culture) . " culture, " . number_format($goods) . " goods from $from.";
                $log = mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', '$message1', Now())", $logdb);
                $log = mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$sell_row[0]', '$message2', Now())", $logdb);
                $message = mysql_query("INSERT INTO messages (user, fromuser, subject, body, date) VALUES ( '$name', 'World Organization', '$subject', '$body', Now())", $db);
                $new_message = mysql_query("UPDATE members SET new_message = new_message + 1 WHERE member_id = '$sell_row[0]'", $db);
                $errmsg_arr[] = $message1;

                $errflag = true;


      	        if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                header("location: ../../wobank.php");
                }



              }
          }
      }
?>