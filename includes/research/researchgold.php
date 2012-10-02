<?php        include('/home/nations/public_html/beta/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

        $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $result = mysql_query("SELECT * FROM resource_cost WHERE id = 7", $db);
        $result3 = mysql_query("SELECT * FROM research WHERE member_id = '$id'", $db);
        $result2 = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);
      while($research = mysql_fetch_array($result3))
      {
        while($costrow = mysql_fetch_array($result))
        {
            while($resrow = mysql_fetch_array($result2))
            {

                $costfood = $costrow[2] * ($research[6] + 1) *2;
                $costcult = $costrow[3] * ($research[6] + 1) + 0.8;
                $costgoods = $costrow[4] * ($research[6] + 1) *2;
               if($resrow[2] < $costfood)
                {
                $errmsg_arr[] = 'You do not have enough food to research.';
		$errflag = true;
                }
               if($result3 > $max_gold_level) {
                $errmsg_arr[] = 'Max research already achieved.';
		$errflag = true;
               }
               if($resrow[3] < $costcult)
                {
                $errmsg_arr[] = 'You do not have enough culture to research.';
		$errflag = true;
                }
               if($resrow[4] < $costgoods)
                {
                $errmsg_arr[] = 'You do not have enough goods to research.';
		$errflag = true;
                }


      	        if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../research.php");
		exit();

                }
                $start_research = mysql_query("UPDATE research SET isgoldresearch = 1 WHERE member_id = '$id'", $db);
                $cost_research = mysql_query("UPDATE resources SET food = food - '$costfood', culture = culture - '$costcult', goods = goods - '$costgoods' WHERE member_id = '$id'", $db);
                $result3 = mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', 'You started research on gold level $ressearch[6].', Now())", $logdb);
                $errmsg_arr[] = "You started research on gold level $research[6].";
	        $errflag = true;

               if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../research.php");
		exit();

                }
            }

        }
        }
?>


