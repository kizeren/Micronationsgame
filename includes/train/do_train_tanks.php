<?php        include('/home/nations/public_html/beta/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");






$tanks = mysql_real_escape_string($_GET['tanks']);
$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$result = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);
$result2 = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);




while ($row = mysql_fetch_array($result)) {

    /*
      if ($tanks > $row[27])
      {
      $errmsg_arr[] = 'You do not have enough jobless to train.';
      $errflag = true;
      }
     */

    if ($tanks > $row[14]) {
        $errmsg_arr[] = 'You do not have enough money to train.';
        $errflag = true;
    }
    while ($res = mysql_fetch_array($result2)) {
        if (($tanks * 500) > $res[3]) {
            $errmsg_arr[] = 'You do not have enough culture to train.';
            $errflag = true;
        }

        if (($tanks * 500 ) > $res[4]) {
            $errmsg_arr[] = 'You do not have enough goods to train.';
            $errflag = true;
        }
    }
    if ($tanks * 1000 > $row[14]) {
        $errmsg_arr[] = 'You do not have enough money to train.';
        $errflag = true;
    }

    if ($errflag) {
        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        header("location: ../../military.php");
        exit();
    }
    $culture = $tanks * 500;
    $goods = $tanks * 500;
    $tanks_t = $tanks * 1000;
    $message = "You are training " . $tanks . " troops for " . number_format($tanks_t) . " " . $row[7] . ", " . number_format($culture) . " culture and " . number_format($goods) . " goods.";

    //$result2 = mysql_query("UPDATE military SET tanks = tanks + '$tanks' WHERE member_id = '$id'", $db);
    $tq_sql = mysql_query("SELECT * FROM training WHERE member_id = '$id'", $db);
    $mq_sql = mysql_query("SELECT * FROM trainmines WHERE member_id = '$id'", $db);
    $ts_sql = mysql_query("SELECT * FROM traintrans WHERE member_id = '$id'", $db);
    
    
    $tqresult = mysql_num_rows($tq_sql);
    $mqresult = mysql_num_rows($mq_sql);
    $tsresult = mysql_query($ts_sql);
    $numresult = $tqresult + $mqresult + $tsresult;
    $structure_sql = mysql_query("SELECT * FROM structures WHERE member_id = '$id'", $db);
    while ($struct = mysql_fetch_array($structure_sql)) {
        if ($numresult >= $struct['barracks']) {

            $errmsg_arr[] = 'You cannot have more queus.';
            $errflag = true;
        }
                if ($struct['barracks'] == '0')
        {
            $errmsg_arr[] = 'You no barracks.';
            $errflag = true;
            
        }
        if ($errflag) {
            $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
            header("location: ../../military.php");
            exit();
        }
    }
    //date time for finished troops
    $research_sql = mysql_query("SELECT * FROM research WHERE member_id='$id'", $db);
    while ($research = mysql_fetch_array($research_sql)) {

        $lvl = round($research['miltrainlvl'] / 10);
        $ticks = round(($tanks / $lvl) * 10);
        $now = new DateTime;
        $clone = $now;        //this doesnot clone so:
        $clone->modify('+' . $ticks . ' Minutes');

        $date = $now->format('m/d/Y g:i:s A');
    }


    //Add troops to qeues.

    mysql_query("INSERT INTO training ( member_id, tanks, done, lvl ) VALUES ('$id', '$tanks', '$date', '$lvl')", $db);
    mysql_query("UPDATE members SET money = money - '$tanks_t' WHERE member_id = '$id'", $db);
    $res_cost = mysql_query("UPDATE resources SET culture = culture - '$culture', goods = goods - '$goods' WHERE member_id = '$id'", $db);
    $result3 = mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', '$message', Now())", $logdb);
    $errmsg_arr[] = ' ' . $message . ' ';
    $errflag = true;
    if ($errflag) {
        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        header("location: ../../military.php");
        exit();
    }
}
?>

