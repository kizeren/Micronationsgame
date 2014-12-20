<?php  
include('/home/mcbride/public_html/micronationsgame/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");
       
       $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$gold = mysql_real_escape_string($_GET['gold']);
$farm = mysql_real_escape_string($_GET['farm']);
$satelite = mysql_real_escape_string($_GET['satelite']);
$commercial = mysql_real_escape_string($_GET['commercial']);
$industry = mysql_real_escape_string($_GET['industry']);
$tech = mysql_real_escape_string($_GET['tech']);
$warehouse = mysql_real_escape_string($_GET['warehouse']);
$militarytraining = mysql_real_escape_string($_GET['militarytraining']);
$gold_sql = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);
while($gold_row = mysql_fetch_array($gold_sql))
{
    if($gold_row[17] < 10)
    {
        $errmsg_arr[] = 'You do not have enough gold.';
	$errflag = true;
    }
}

      	        if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../research.php");
		exit();
                }
                
if ($gold > 0)
{
    mysql_query("UPDATE research SET isgoldresearch = 0, goldtick = 0, goldlvl = goldlvl + 1 WHERE member_id = '$id'", $db);
    mysql_query("UPDATE resources SET gold = gold - 10 WHERE member_id = '$id'", $db);
    $errmsg_arr[] = 'Gold research has been finished.';
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    header("location: ../../research.php");
    exit();
    
}
if ($farm > 0)
{
    mysql_query("UPDATE resources SET isfarmresearch = 0, farmtick = 0, farmlvl = farmlvl + 1 WHERE member_id = '$id'", $db);
    mysql_query("UPDATE resources SET gold = gold - 10 WHERE member_id = '$id'", $db);
    $errmsg_arr[] = 'Farm research has been finished.';
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    header("location: ../../research.php");
    exit();
    
}
if ($warehouse> 0)
{
    mysql_query("UPDATE resources SET isstorageresearch = 0, storagetick = 0, storagelvl = storagelvl + 1 WHERE member_id = '$id'", $db);
    mysql_query("UPDATE resources SET gold = gold - 10 WHERE member_id = '$id'", $db);
    $errmsg_arr[] = 'Storage research has been finished.';
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    header("location: ../../research.php");
    exit();
    
}
if ($industry > 0)
{
    mysql_query("UPDATE resources SET isindustryresearch = 0, industrytick = 0, industrylvl = industrylvl + 1 WHERE member_id = '$id'", $db);
    mysql_query("UPDATE resources SET gold = gold - 10 WHERE member_id = '$id'", $db);
    $errmsg_arr[] = 'Industrial research has been finished.';
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    header("location: ../../research.php");
    exit();
    
}
if ($commercial > 0)
{
    mysql_query("UPDATE resources SET iscultureresearch = 0, culturetick = 0, culturelvl = culturelvl + 1 WHERE member_id = '$id'", $db);
    mysql_query("UPDATE resources SET gold = gold - 10 WHERE member_id = '$id'", $db);
    $errmsg_arr[] = 'Culture research has been finished.';
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    header("location: ../../research.php");
    exit();
    
}
if ($tech > 0)
{
    mysql_query("UPDATE research SET istechresearch = 0, techtick = 0, techlvl = techlvl + 1 WHERE member_id = '$id'", $db);
    mysql_query("UPDATE resources SET gold = gold - 10 WHERE member_id = '$id'", $db);
    $errmsg_arr[] = 'Tech research has been finished.';
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    header("location: ../../research.php");
    exit();
    
}
if ($satelite > 0)
{
    mysql_query("UPDATE military SET issatresearch = 0, satrestick = 0, satlvl = satlvl + 1 WHERE member_id = '$id'", $db);
    mysql_query("UPDATE resources SET gold = gold - 10 WHERE member_id = '$id'", $db);
    $errmsg_arr[] = 'Satelite research has been finished.';
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    header("location: ../../research.php");
    exit();
    
}
if ($militarytraining > 0)
{
    mysql_query("UPDATE research SET ismiltrain = 0, miltraintick = 0, miltrainlvl = miltrainlvl + 1 WHERE member_id = '$id'", $db);
    mysql_query("UPDATE resources SET gold = gold - 10 WHERE member_id = '$id'", $db);
    $errmsg_arr[] = 'Military Training research has been finished.';
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    header("location: ../../research.php");
    exit();
    
}
