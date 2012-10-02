<?php        include('/home/nations/public_html/beta/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $admin_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'");
        while($admin_row = mysql_fetch_array($admin_sql))
                if($admin_row[25] < 4)
                {
                    header("location: ../member-index.php");
                }
$login = mysql_real_escape_string($_GET['login']);
$firstname = mysql_real_escape_string($_GET['firstname']);
$lastname = mysql_real_escape_string($_GET['lastname']);
$email = mysql_real_escape_string($_GET['email']);
$userlevel = mysql_real_escape_string($_GET['userlevel']);
$nation = mysql_real_escape_string($_GET['nation']);
$motto = mysql_real_escape_string($_GET['motto']);
$monetary = mysql_real_escape_string($_GET['monetary']);
$tree = mysql_real_escape_string($_GET['tree']);
$plant = mysql_real_escape_string($_GET['plant']);
$flag = mysql_real_escape_string($_GET['flag']);
$popcount = mysql_real_escape_string($_GET['popcount']);
$ttd = mysql_real_escape_string($_GET['ttd']);
$money = mysql_real_escape_string($_GET['money']);
$tax = mysql_real_escape_string($_GET['tax']);
$homeless = mysql_real_escape_string($_GET['homeless']);
$housing = mysql_real_escape_string($_GET['housing']);
$industrial = mysql_real_escape_string($_GET['industrial']);
$commercial = mysql_real_escape_string($_GET['commercial']);
$farm = mysql_real_escape_string($_GET['farm']);
$religion = mysql_real_escape_string($_GET['religion']);
$jobless = mysql_real_escape_string($_GET['jobless']);
$working = mysql_real_escape_string($_GET['working']);
$work_ind = mysql_real_escape_string($_GET['work_ind']);
$work_comm = mysql_real_escape_string($_GET['work_comm']);
$work_farm = mysql_real_escape_string($_GET['work_farm']);
$land = mysql_real_escape_string($_GET['land']);
$alliance = mysql_real_escape_string($_GET['alliance']);
$warehouse = mysql_real_escape_string($_GET['warehouse']);
$new_message = mysql_real_escape_string($_GET['new_message']);
$infantry = mysql_real_escape_string($_GET['infantry']);
$edit_id = mysql_real_escape_string($_GET['edit_id']);
$food = mysql_real_escape_string($_GET['food']);
$culture = mysql_real_escape_string($_GET['culture']);
$goods = mysql_real_escape_string($_GET['goods']);
$farmlvl = mysql_real_escape_string($_GET['farmlvl']);
$culturelvl = mysql_real_escape_string($_GET['culturelvl']);
$industrylvl = mysql_real_escape_string($_GET['industrylvl']);
$warehouselvl = mysql_real_escape_string($_GET['warehouselvl']);
$spies = mysql_real_escape_string($_GET['spies']);


$result = mysql_query("UPDATE members SET userlevel = '$userlevel', login = '$login', firstname = '$firstname', lastname = '$lastname', email = '$email',
        nation = '$nation', motto = '$motto', monetary = '$monetary', tree = '$tree', plant = '$plant', flag = '$flag',
        popcount = '$popcount', ttd = '$ttd', money = '$money', tax = '$tax', homeless = '$homeless', housing = '$housing',
        industrial = '$industrial', commercial = '$commercial', farm = '$farm', religion = '$religion', jobless = '$jobless',
        working = '$working', work_ind = '$work_ind', work_comm = '$work_comm', work_farm = '$work_farm', land = '$land',
        alliance = '$alliance', warehouse = '$warehouse', new_message = '$new_message' WHERE login='$login'", $db);
$result = mysql_query("UPDATE military SET infantry = '$infantry', spies = '$spies' WHERE member_id='$edit_id'", $db);
$result = mysql_query("UPDATE resources SET food = '$food', culture = '$culture', goods = '$goods', farmlvl = '$farmlvl', culturelvl = '$culturelvl', industrylvl = '$industrylvl', storagelvl = '$warehouselvl' WHERE member_id='$edit_id'", $db);

echo "$result";
                $errmsg_arr[] = 'User updated.';
		$errflag = true;
            if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: edit.php");
		exit();

                }

?>
