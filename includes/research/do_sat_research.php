
<?php    
include('/home/mcbride/public_html/micronationsgame/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

        $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $result = mysql_query("SELECT * FROM resource_cost WHERE id = 5", $db);
        $result2 = mysql_query("SELECT * FROM military WHERE member_id = '$id'", $db);
        $result3 = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);
        while($res_row = mysql_fetch_array($result3))
        {
        while($costrow = mysql_fetch_array($result))
        {
            while($resrow = mysql_fetch_array($result2))
            {

                $costfood = $costrow[2] * ($resrow[9] +1) *3;
                $costcult = $costrow[3] * ($resrow[9] +1) *1.6;
                $costgoods = $costrow[4] * ($resrow[9] +1) *4;
               if($res_row[2] < $costfood)
                {
                $errmsg_arr[] = 'You do not have enough food to research.';
		$errflag = true;
                }
               if($res_row[3] < $costcult)
                {
                $errmsg_arr[] = 'You do not have enough culture to research.';
		$errflag = true;
                }
               if($res_row[4] < $costgoods)
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
                $start_research = mysql_query("UPDATE military SET issatresearch = 1 WHERE member_id = '$id'", $db);
                $cost_research = mysql_query("UPDATE resources SET food = food - '$costfood', culture = culture - '$costcult', goods = goods - '$costgoods' WHERE member_id = '$id'", $db);
                $result3 = mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', 'You started research on satllite level $resrow[8].', Now())", $logdb);
                $errmsg_arr[] = "You started research on satllite level $resrow[8].";
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


