<?php

include('/home/mcbride/public_html/micronationsgame/config.php');
require_once("$directory/includes/config/auth.php");


$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);


$housingpreg = mysql_real_escape_string($_GET['housing']);
$farmspreg = mysql_real_escape_string($_GET['farms']);
$industrypreg = mysql_real_escape_string($_GET['industry']);
$warehousepreg = mysql_real_escape_string($_GET['warehouse']);
$commercialpreg = mysql_real_escape_string($_GET['commercial']);
$barrackspreg = mysql_real_escape_string($_GET['barracks']);
$hangerspreg = mysql_real_escape_string($_GET['hangers']);

$housing = preg_replace("/[[:^digit:]]/", '', $housingpreg);
$farms = preg_replace("/[[:^digit:]]/", '', $farmspreg);
$industry = preg_replace("/[[:^digit:]]/", '', $industrypreg);
$warehouse = preg_replace("/[[:^digit:]]/", '', $warehousepreg);
$commercial = preg_replace("/[[:^digit:]]/", '', $commercialpreg);
$barracks = preg_replace("/[[:^digit:]]/", '', $barrackspreg);
$hangers = preg_replace("/[[:^digit:]]/", '', $hangerspreg);

$housing_cost_sql = mysql_query("SELECT * FROM resource_cost WHERE id = '1'", $db);
$farms_cost_sql = mysql_query("SELECT * FROM resource_cost WHERE id = '2'", $db);
$industry_cost_sql = mysql_query("SELECT * FROM resource_cost WHERE id = '3'", $db);
$commercial_cost_sql = mysql_query("SELECT * FROM resource_cost WHERE id = '4'", $db);
$warehouse_cost_sql = mysql_query("SELECT * FROM resource_cost WHERE id = '5'", $db);
$city_res_sql = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);
$city_building_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);


while ($city_build_row = mysql_fetch_assoc($city_building_sql)) {
    while ($city_res_row = mysql_fetch_assoc($city_res_sql)) {
        $freeland = ($city_build_row['land'] - ($city_build_row['housing'] + $city_build_row['industrial'] + $city_build_row['commercial'] + $city_build_row['warehouse'] + $city_build_row['farm']));

//Housing Purchase
        if ($housing > 0) {
            while ($housingcost = mysql_fetch_array($housing_cost_sql)) {

                $housingtotal = $housing * 100;
                // echo "$housingtotal, $housing, $housingcost[2]";
                if ($housing + $city_build_row['housing'] > $max_home) {
                    $errmsg_arr[] = "You can't have more then $max_home homes.";
                    $errflag = true;
                }
//Money
                if ($housingtotal > $city_build_row['money']) {
                    $errmsg_arr[] = 'You do not have enough money.';
                    $errflag = true;
                }
//Land
                if ($housing > $freeland) {
                    $errmsg_arr[] = 'You do not have enough free land for houses.';
                    $errflag = true;
                }
//10k limit    
                //           if ($housing + $city_build_row[4] > 10001) {
                //               $errmsg_arr[] = 'You cannot have more then 10,000 of any structure.';
                //              $errflag = true;
                //         }
                //Redirect if error
                if ($errflag) {
                    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                    header("location: ../../buy.php");
                    exit();
                }
                //Buildings
                $message = "You bought " . number_format($housing) . " homes for $" . number_format($housingtotal) . ".";
                mysql_query("UPDATE members SET housing = housing + '$housing' WHERE member_id = '$id'", $db);
//Money
                mysql_query("UPDATE members SET  money = money - '$housingtotal' WHERE member_id = '$id'", $db);
//Points
                mysql_query("UPDATE points SET points = points + '$housing' WHERE member_id = '$id'", $db);
                //log
                mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', '$message', Now())", $logdb);

                $errmsg_arrg[] = $message;
            }
        }

//Farm Purchase
        if ($farms > 0) {
            while ($farmscost = mysql_fetch_array($farms_cost_sql)) {

                $farmstotal = $farms * 100;
                $housingtotal = $housing * 100;
                // echo "$housingtotal, $housing, $housingcost[2]";
                if ($farms + $city_build_row['farm'] > $max_farm) {
                    $errmsg_arr[] = "You can't have more then $max_farm farms.";
                    $errflag = true;
                }
//Money
                if ($farmstotal > $city_build_row['money']) {
                    $errmsg_arr[] = 'You do not have enough money.';
                    $errflag = true;
                }
//Land
                if ($farms > $freeland) {
                    $errmsg_arr[] = 'You do not have enough free land for farms.';
                    $errflag = true;
                }
//10k limit    
//            if ($farms + $city_build_row[4] > 10001) {
//                $errmsg_arr[] = 'You cannot have more then 10,000 of any structure.';
//                $errflag = true;
                //           }
                //Redirect if error
                if ($errflag) {
                    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                    header("location: ../../buy.php");
                    exit();
                }
                //Buildings
                $message = 'You bought ' . number_format($farms) . ' farms for $' . number_format($farmstotal) . '.';
                mysql_query("UPDATE members SET farm = farm + '$farms' WHERE member_id = '$id'", $db);
//Money
                mysql_query("UPDATE members SET  money = money - '$farmstotal' WHERE member_id = '$id'", $db);
//Points
                mysql_query("UPDATE points SET points = points + '$farms' WHERE member_id = '$id'", $db);
                mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', '$message', Now())", $logdb);

                $errmsg_arrg[] = $message;
            }
        }
//industry Purchase
        if ($industry > 0) {
            while ($industrycost = mysql_fetch_array($industry_cost_sql)) {

                $industrytotal = $industry * 300;
                $housingtotal = $housing * 100;
                // echo "$housingtotal, $housing, $housingcost[2]";
                if ($industry + $city_build_row['industrial'] > $max_industry) {
                    $errmsg_arr[] = "You can't have more then $max_industry industrial.";
                    $errflag = true;
                }
//Money
                if ($industrytotal > $city_build_row['money']) {
                    $errmsg_arr[] = 'You do not have enough money.';
                    $errflag = true;
                }
//Land
                if ($industry > $freeland) {
                    $errmsg_arr[] = 'You do not have enough free land for industry.';
                    $errflag = true;
                }
//10k limit    
                //           if ($industry + $city_build_row[4] > 10001) {
                //               $errmsg_arr[] = 'You cannot have more then 10,000 of any structure.';
                //               $errflag = true;
                //           }
                //Redirect if error
                if ($errflag) {
                    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                    header("location: ../../buy.php");
                    exit();
                }
                //Buildings
                $message = 'You bought ' . number_format($industry) . ' indsutrial for $' . number_format($industrytotal) . '.';
                mysql_query("UPDATE members SET industrial = industrial + '$industry' WHERE member_id = '$id'", $db);
//Money
                mysql_query("UPDATE members SET  money = money - '$industrytotal' WHERE member_id = '$id'", $db);
//Points
                mysql_query("UPDATE points SET points = points + '$industry' WHERE member_id = '$id'", $db);
                mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', '$message', Now())", $logdb);

                $errmsg_arrg[] = $message;
            }
        }
        //commercial Purchase
        if ($commercial > 0) {
            while ($commercialcost = mysql_fetch_array($commercial_cost_sql)) {

                $commercialtotal = $commercial * 500;
                $housingtotal = $housing * 100;
                // echo "$housingtotal, $housing, $housingcost[2]";
                if ($commercial + $city_build_row['commercial'] > $max_commercial) {
                    $errmsg_arr[] = "You can't have more then $max_commercial commercial.";
                    $errflag = true;
                }
//Money
                if ($commercialtotal > $city_build_row['money']) {
                    $errmsg_arr[] = 'You do not have enough money.';
                    $errflag = true;
                }
//Land
                if ($commercial > $freeland) {
                    $errmsg_arr[] = 'You do not have enough free land for commercials.';
                    $errflag = true;
                }
//10k limit    
                //           if ($commercial + $city_build_row[4] > 10001) {
                //               $errmsg_arr[] = 'You cannot have more then 10,000 of any structure.';
                //               $errflag = true;
                //           }
                //Redirect if error
                if ($errflag) {
                    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                    header("location: ../../buy.php");
                    exit();
                }
                //Buildings
                $message = 'You bought ' . number_format($commercial) . ' commercial for $' . number_format($commercialtotal) . '.';
                mysql_query("UPDATE members SET commercial = commercial + '$commercial' WHERE member_id = '$id'", $db);
//Money
                mysql_query("UPDATE members SET  money = money - '$commercialtotal' WHERE member_id = '$id'", $db);
//Points
                mysql_query("UPDATE points SET points = points + '$commercial' WHERE member_id = '$id'", $db);
                mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', '$message', Now())", $logdb);

                $errmsg_arrg[] = $message;
            }
        }
        //warehouse Purchase
        if ($warehouse > 0) {
            while ($warehousecost = mysql_fetch_array($warehouse_cost_sql)) {

                $warehousetotal = $warehouse * 100;

                if ($warehouse + $city_build_row['warehouse'] > $max_warehouse) {
                    $errmsg_arr[] = "You can't have more then $max_warehouse warehouses.";
                    $errflag = true;
                }
//Money
                if ($warehousetotal > $city_build_row['money']) {
                    $errmsg_arr[] = 'You do not have enough money.';
                    $errflag = true;
                }
//Land
                if ($warehouse > $freeland) {
                    $errmsg_arr[] = 'You do not have enough free land for warehouses.';
                    $errflag = true;
                }
//10k limit    
                //         if ($warehouse + $city_build_row[4] > 10001) {
                //             $errmsg_arr[] = 'You cannot have more then 10,000 of any structure.';
                //             $errflag = true;
                //         }
                //Redirect if error
                if ($errflag) {
                    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                    header("location: ../../buy.php");
                    exit();
                }
                //Buildings
                $message = 'You bought ' . number_format($warehouse) . ' warehouses for $' . number_format($warehousetotal) . '.';
                mysql_query("UPDATE members SET warehouse = warehouse + '$warehouse' WHERE member_id = '$id'", $db);
//Money
                mysql_query("UPDATE members SET  money = money - '$warehousetotal' WHERE member_id = '$id'", $db);
//Points
                mysql_query("UPDATE points SET points = points + '$warehouse' WHERE member_id = '$id'", $db);
                mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', '$message', Now())", $logdb);

                $errmsg_arrg[] = $message;
            }
        }

        $structures_sql = mysql_query("SELECT * FROM structures WHERE member_id = '$id'", $db);
        while ($struct = mysql_fetch_array($structures_sql)) {
            if ($barracks > 0) {


                $barrackstotal = $barracks * 10000;
 
                if ($barracks + $struct['barracks'] > $max_barracks) {
                    $errmsg_arr[] = "You can't have more then $max_barracks barracks.";
                    $errflag = true;
                }
//Money
                if ($barrackstotal > $city_build_row['money']) {
                    $errmsg_arr[] = 'You do not have enough money.';
                    $errflag = true;
                }
//Land
                if ($barracks > $freeland) {
                    $errmsg_arr[] = 'You do not have enough free land for barrackss.';
                    $errflag = true;
                }

                //Redirect if error
                if ($errflag) {
                    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                    header("location: ../../buy.php");
                    exit();
                }
                //Buildings
                $message = 'You bought ' . number_format($barracks) . ' barracks for $' . number_format($barrackstotal) . '.';
                mysql_query("UPDATE structures SET barracks = barracks + '$barracks' WHERE member_id = '$id'", $db);
//Money
                mysql_query("UPDATE members SET  money = money - '$barrackstotal' WHERE member_id = '$id'", $db);
//Points
                mysql_query("UPDATE points SET points = points + '$barracks' WHERE member_id = '$id'", $db);
                mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', '$message', Now())", $logdb);

                $errmsg_arrg[] = $message;
            }
                       if ($hangers > 0) {


                $hangerstotal = $hangers * 10000;
 
                if ($hangers + $struct['hangers'] > $max_hangers) {
                    $errmsg_arr[] = "You can't have more then $max_hangers hangers.";
                    $errflag = true;
                }
//Money
                if ($hangerstotal > $city_build_row['money']) {
                    $errmsg_arr[] = 'You do not have enough money.';
                    $errflag = true;
                }
//Land
                if ($hangers > $freeland) {
                    $errmsg_arr[] = 'You do not have enough free land for hangers.';
                    $errflag = true;
                }

                //Redirect if error
                if ($errflag) {
                    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                    header("location: ../../buy.php");
                    exit();
                }
                //Buildings
                $message = 'You bought ' . number_format($hangers) . ' hangers for $' . number_format($hangerstotal) . '.';
                mysql_query("UPDATE structures SET hangers = hangers + '$hangers' WHERE member_id = '$id'", $db);
//Money
                mysql_query("UPDATE members SET  money = money - '$hangerstotal' WHERE member_id = '$id'", $db);
//Points
                mysql_query("UPDATE points SET points = points + '$hangers' WHERE member_id = '$id'", $db);
                mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', '$message', Now())", $logdb);

                $errmsg_arrg[] = $message;
            }
        }
    }
}
$_SESSION['ERRMSG_ARRG'] = $errmsg_arrg;
header("location: ../../buy.php");
?>

