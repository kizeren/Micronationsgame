<?php
$unixtime = time();
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
include("config.php");

if (isset($_SERVER['REQUEST_URI'])) {
    die("Access denied");
}
echo "maintence check";
//Check for maintnence mode and set the field to zero.
$maint_sql = mysql_query("SELECT * FROM maintenance", $db);
while ($maint = mysql_fetch_array($maint_sql)) {
    if ($maint[0] > 0) {
        mysql_query("UPDATE maintenance SET maint = 0", $db);
    }
}
echo "Population update";
$rand1 = rand(1, 10);
$rand2 = rand(10, 20);
$rand3 = rand(20, 30);
$rand4 = rand(30, 40);
$rand5 = rand(40, 50);
$rand6 = rand(50, 60);
$rand7 = rand(60, 70);
$rand8 = rand(70, 80);
$rand9 = rand(80, 90);
$rand10 = rand(90, 100);

// Tax and population
mysql_query("UPDATE members SET popcount = popcount + '$rand1' WHERE tax BETWEEN 90 AND 100", $db);
mysql_query("UPDATE members SET popcount = popcount + '$rand2' WHERE tax BETWEEN 80 AND 89", $db);
mysql_query("UPDATE members SET popcount = popcount + '$rand3' WHERE tax BETWEEN 70 AND 79", $db);
mysql_query("UPDATE members SET popcount = popcount + '$rand4' WHERE tax BETWEEN 60 AND 69", $db);
mysql_query("UPDATE members SET popcount = popcount + '$rand5' WHERE tax BETWEEN 50 AND 59", $db);
mysql_query("UPDATE members SET popcount = popcount + '$rand6' WHERE tax BETWEEN 40 AND 49", $db);
mysql_query("UPDATE members SET popcount = popcount + '$rand7' WHERE tax BETWEEN 30 AND 39", $db);
mysql_query("UPDATE members SET popcount = popcount + '$rand8' WHERE tax BETWEEN 20 AND 29", $db);
mysql_query("UPDATE members SET popcount = popcount + '$rand9' WHERE tax BETWEEN 10 AND 19", $db);
mysql_query("UPDATE members SET popcount = popcount + '$rand10' WHERE tax BETWEEN 1 AND 9", $db);

echo "Misc";
//Time to deletetion, money and misc updates.
mysql_query("UPDATE members SET ttd = ttd + 1, online = 0 ", $db);
mysql_query("UPDATE members SET money = money + (((working * 10) * tax) / 100)", $db);
mysql_query("UPDATE members SET homeless = popcount - housing", $db);
mysql_query("UPDATE members SET jobless = popcount - working", $db);
mysql_query("UPDATE members SET jobless = 0 WHERE jobless < 0", $db);
mysql_query("UPDATE members SET homeless = 0 WHERE homeless < 0", $db);
mysql_query("UPDATE members SET working = work_ind + work_comm + work_farm", $db);

echo "World Stats update";
//world statistics
$sum_pop = mysql_query("UPDATE population SET stat_number = (SELECT SUM( popcount) FROM members) WHERE id = 1", $db);
$sum_nat = mysql_query("UPDATE population SET stat_number = (SELECT COUNT( member_id ) FROM members) WHERE id = 2", $db);
$sum_homeless = mysql_query("UPDATE population SET stat_number = (SELECT SUM( homeless ) FROM members) WHERE id = 3", $db);
$sum_jobless = mysql_query("UPDATE population SET stat_number = (SELECT SUM( jobless ) FROM members) WHERE id = 4", $db);
$sum_acre = mysql_query("UPDATE population SET stat_number = (SELECT SUM( land ) FROM members) WHERE id = 5", $db);
$bank_increase = mysql_query("UPDATE worldbank SET money = money + 100000, food = food + 100000, culture = culture + 100000, goods = goods + 10000", $db);


//Resources


echo "Resources update";
$members_sql = mysql_query("SELECT * FROM members", $db);
$resoures_sql = mysql_query("SELECT * FROM resources", $db);

while ($members_row = mysql_fetch_array($members_sql)) {

    $food_tick = $members_row[33] * 10;
    $food_upkeep = $members_row[12] * 2;
    $foodupdate = $food_tick - $food_upkeep;
    $cultureupdate = $members_row[32] * 5;
    $goodsupdate = $members_row[31] * 3;
//original.  Upkeep for pop turned off 
    $resource_query = mysql_query("UPDATE resources SET food = food + (farmlvl * 1000) + ($members_row[33] * 10) WHERE member_id = '$members_row[0]' AND farmlvl > 0", $db);

    $positivefood = mysql_query("UPDATE resources SET food = 0 WHERE food < 0", $db);
    $culture_sql2 = mysql_query("UPDATE resources SET culture = culture + ('$cultureupdate' + (culturelvl * 500)) WHERE member_id = '$members_row[0]' AND culturelvl > 0", $db);
    $goods_sql2 = mysql_query("UPDATE resources SET goods = goods + ('$goodsupdate' + (industrylvl * 100)) WHERE member_id = '$members_row[0]' AND industrylvl > 0 ", $db);
    $test = (($foodupdate + ($foodupdate * 2) / 100));
    $troopupkeep = mysql_query("SELECT * FROM military WHERE member_id = '$members_row[0]'", $db);
    while ($tupkeep = mysql_fetch_array($troopupkeep)) {
        $troopupkeep2 = mysql_query("UPDATE resources SET food = food - '$tupkeep[2]' WHERE member_id = '$members_row[0]' AND '$tupkeep[2]' > 0", $db);
    }
    $gold_sql = mysql_query("SELECT * FROM research WHERE member_id = '$members_row[0]'", $db);
    $gold_str = mysql_query("SELECT * FROM structures WHERE member_id = '$members_row[0]' AND gold_mine > 0", $db);
    while ($struc = mysql_fetch_array($gold_str)) {
        while ($gold = mysql_fetch_array($gold_sql)) {
            $gold = mysql_query("UPDATE resources SET gold = gold + ('$gold[6]' * 0.001) WHERE member_id = '$members_row[0]' AND $gold[6] > 0", $db);
        }
    }
    
    $oil_sql = mysql_query("SELECT * FROM oil_well WHERE member_id = '$members_row[0]'", $db);
        while ($oil = mysql_fetch_array($oil_sql)) {
          mysql_query("UPDATE resources SET oil = oil + ('$oil[1]' * 0.001) WHERE member_id = '$members_row[0]' AND $oil[1] > 0", $db);
        }
    
}

echo "Research Update";
//Research
$researchmem_sql = mysql_query("SELECT * FROM members", $db);
while ($researchmem = mysql_fetch_array($researchmem_sql)) {
    $id = $researchmem['member_id'];
    $researchlevel_sql = mysql_query("SELECT * FROM research", $db);
    while ($researchlevel = mysql_fetch_array($researchlevel_sql)); {



        mysql_query("UPDATE research SET techtick = 0, istechresearch = 0, techlvl = techlvl + 1 WHERE techtick >= techlvl AND member_id ='$id'", $db);

        mysql_query("UPDATE research SET goldtick = 0, isgoldresearch = 0, goldlvl = goldlvl + 1 WHERE goldtick >= goldlvl AND member_id ='$id'", $db);
        mysql_query("UPDATE research SET miltraintick = 0, ismiltrain = 0, miltrainlvl = miltrainlvl + 1 WHERE miltraintick >= miltrainlvl AND member_id ='$id'", $db);
//Protection
//Newb Protection
//military
    }
}
$researchlevel_sql = mysql_query("SELECT * FROM members", $db);
while ($researchlevel = mysql_fetch_array($researchlevel_sql)) {
    $id = $researchlevel['member_id'];
    $research2_sql = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);
    while ($research2 = mysql_fetch_array($research2_sql)) {
        mysql_query("UPDATE resources SET farmtick = 0, isfarmresearch = 0, farmlvl = farmlvl + 1 WHERE farmtick >= farmlvl AND member_id ='$id'", $db);
        mysql_query("UPDATE resources SET culturetick = 0, iscultureresearch = 0, culturelvl = culturelvl + 1 WHERE culturetick >= culturelvl AND member_id ='$id'", $db);
        mysql_query("UPDATE resources SET industrytick = 0, isindustryresearch = 0, industrylvl = industrylvl + 1 WHERE industrytick >= industrylvl AND member_id ='$id'", $db);
        mysql_query("UPDATE resources SET storagetick = 0, isstorageresearch = 0, storagelvl = storagelvl + 1 WHERE storagetick >= storagelvl AND member_id ='$id'", $db);
    }
}
$researchlevel_sql = mysql_query("SELECT * FROM members", $db);
while ($researchlevel = mysql_fetch_array($researchlevel_sql)) {
    $id = $researchlevel['member_id'];
    $research2_sql = mysql_query("SELECT * FROM military WHERE member_id = '$id'", $db);
    while ($research2 = mysql_fetch_array($research2_sql)) {
        mysql_query("UPDATE military SET satrestick = 0, issatresearch = 0, satlvl = satlvl + 1 WHERE satrestick >= satlvl AND member_id ='$id'", $db);
    }
}
$researchlevel_sql = mysql_query("SELECT * FROM refinery", $db);
while($researchlevel = mysql_fetch_array($researchlevel_sql)) {
    $id = $researchlevel['member_id'];
    $research2_sql = mysql_query("SELECT * FROM refinery WHERE member_id = '$id'", $db);
    while($research2 = mysql_fetch_array($research2_sql)) {
        mysql_query("UPDATE refinery SET tick = 0, isresearch = 0, level = level + 1 WHERE tick >= level AND member_id = '$id'", $db);
    }
}

$researchlevel_sql = mysql_query("SELECT * FROM oil_well", $db);
while($researchlevel = mysql_fetch_array($researchlevel_sql)) {
    $id = $researchlevel['member_id'];
    $research2_sql = mysql_query("SELECT * FROM oil_well WHERE member_id = '$id'", $db);
    while($research2 = mysql_fetch_array($research2_sql)) {
        mysql_query("UPDATE oil_well SET tick = 0, isresearch = 0, level = level + 1 WHERE tick >= level AND member_id = '$id'", $db);
    }
}

mysql_query("UPDATE refinery SET tick = tick + 1 WHERE isresearch > 0", $db);
mysql_query("UPDATE oil_well SET tick = tick + 1 WHERE isresearch > 0", $db);
mysql_query("UPDATE resources SET farmtick = farmtick + 1 WHERE isfarmresearch > 0", $db);
mysql_query("UPDATE resources SET culturetick = culturetick + 1 WHERE iscultureresearch > 0", $db);
mysql_query("UPDATE resources SET industrytick = industrytick + 1 WHERE isindustryresearch > 0", $db);
mysql_query("UPDATE resources SET storagetick = storagetick + 1 WHERE isstorageresearch > 0", $db);
mysql_query("UPDATE military SET satrestick = satrestick + 1 WHERE issatresearch > 0", $db);
mysql_query("UPDATE research SET techtick = techtick + 1 WHERE istechresearch > 0", $db);
mysql_query("UPDATE research SET goldtick = goldtick + 1 WHERE isgoldresearch > 0", $db);
mysql_query("UPDATE research SET miltraintick = miltraintick + 1 WHERE ismiltrain > 0", $db);
mysql_query("UPDATE military SET protick = protick + 1 WHERE protection >= 3", $db);
mysql_query("UPDATE newb_prot SET tick = tick + 1 WHERE isnewb > 0", $db);
mysql_query("UPDATE satellites SET sattick = sattick + 1 WHERE satrep = 1", $db);
mysql_query("UPDATE newb_prot SET isnewb = 0, tick = 0 WHERE tick >= 2016", $db);
mysql_query("UPDATE military SET protection = 0, protick = 0 WHERE protick > 288", $db);
mysql_query("UPDATE satellites SET sattick = 0, satrep = 0 WHERE sattick > 288", $db);




echo "Rogue nations update";

//Rogue nations
$random = round(rand(0, 100) * 2 + 123);
$food = round(rand(10000, 100000) * 1.1 + 543);
$culture = round(rand(5000, 10000) * 1.1 + 34);
$goods = round(rand(1000, 10000) * 1.1 + 68);




//mysql_query("UPDATE roguenations SET food = food + 10000, culture = culture + 1000, goods = goods + 500, infantry = infantry + 100 WHERE level > 2", $db);
mysql_query("UPDATE roguenations SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', infantry = infantry + '$random' WHERE level = 1 AND infantry < 100", $db);
mysql_query("UPDATE roguenations SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', infantry = infantry + '$random' WHERE level = 2 AND infantry < 1000", $db);
mysql_query("UPDATE roguenations SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', infantry = infantry + '$random' WHERE level = 3 AND infantry < 10000", $db);
mysql_query("UPDATE roguenations SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', infantry = infantry + '$random', mercs = mercs + '$random' WHERE level = 4 AND infantry < 50000", $db);
mysql_query("UPDATE roguenations SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', infantry = infantry + '$random', mercs = mercs + '$random'  WHERE level = 5 AND infantry < 70000", $db);
mysql_query("UPDATE roguenations SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', infantry = infantry + '$random', mercs = mercs + '$random', mines = mines + '$random', tanks = tanks + '$random'  WHERE level = 6 AND infantry < 90000", $db);
mysql_query("UPDATE roguenations SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', infantry = infantry + '$random', mercs = mercs + '$random', mines = mines + '$random', tanks = tanks + '$random' WHERE level = 7 AND infantry < 100000", $db);
mysql_query("UPDATE roguenations SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', infantry = infantry + '$random', mercs = mercs + '$random', mines = mines + '$random', tanks = tanks + '$random' WHERE level = 8 AND infantry < 130000", $db);
mysql_query("UPDATE roguenations SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', infantry = infantry + '$random', mercs = mercs + '$random', mines = mines + '$random', tanks = tanks + '$random' WHERE level = 9 AND infantry < 160000", $db);
mysql_query("UPDATE roguenations SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', infantry = infantry + '$random', mercs = mercs + '$random', mines = mines + '$random', tanks = tanks + '$random' WHERE level = 10 AND infantry < 190000", $db);
mysql_query("UPDATE roguenations SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', infantry = infantry + '$random', mercs = mercs + '$random', mines = mines + '$random', tanks = tanks + '$random' WHERE level = 11 AND infantry < 220000", $db);
mysql_query("UPDATE roguenations SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', infantry = infantry + '$random', mercs = mercs + '$random', mines = mines + '$random', tanks = tanks + '$random' WHERE level = 12 AND infantry < 260000", $db);
mysql_query("UPDATE roguenations SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', infantry = infantry + '$random', mercs = mercs + '$random', mines = mines + '$random', tanks = tanks + '$random' WHERE level = 13 AND infantry < 300000", $db);
mysql_query("UPDATE roguenations SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', infantry = infantry + '$random', mercs = mercs + '$random', mines = mines + '$random', tanks = tanks + '$random' WHERE level = 14 AND infantry < 350000", $db);
mysql_query("UPDATE roguenations SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', infantry = infantry + '$random', mercs = mercs + '$random', mines = mines + '$random', tanks = tanks + '$random' WHERE level = 15 AND infantry < 400000", $db);
mysql_query("UPDATE roguenations SET food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', infantry = infantry + '$random', mercs = mercs + '$random', mines = mines + '$random', tanks = tanks + '$random' WHERE level = 0", $db);



// Greater then 2016 email sent reminding members to log in!



$mail_sql = mysql_query("SELECT * FROM members WHERE ttd > 2016", $db);
while ($mail = mysql_fetch_array($mail_sql)) {
    $name = $mail['login'];
    $member = $mail['member_id'];
    $email = $mail['email'];


    $ttdmaillookup = mysql_query("SELECT * FROM ttdmail WHERE member_id = '$member'", $db);
    while ($ttdmailrow = mysql_fetch_array($ttdmaillookup)) {
        if ($ttdmailrow[1] == '0') {
            $to = $email;
            $subject = 'MicroNationsGame.com';
            $message = "
<html>
<body>            
We have not seen you log in for a week now.<br>
We hope everything is okay and wish to see you return!<br>
In 7 more days you account will be deleted.<br>
Hope to see you soon!<br>
Name: $name <br>
World: $world <br>
<a href=\"http://$world.micronationsgame.com\"> Login to $world now! </a>
</body>
</html>
            ";
            $headers = "From: nations@micronationsgame.com \r\n";
            $headers .= "Reply-To: nations@micronationsgame.com \r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($to, $subject, $message, $headers);
            mysql_query("UPDATE ttdmail SET mailsent = 1 WHERE member_id = '$member'", $db);
        }
    }
}




// Greater then 4036 ticks and not logged in get deleted.
// changed for beta world.
echo "deletion update";
$deletion = mysql_query("SELECT * FROM members WHERE ttd > 40000", $db);
while ($deletion_row = mysql_fetch_array($deletion)) {
    $bank_sql = mysql_query("SELECT * FROM worldbank", $db);
    while ($bank = mysql_fetch_array($bank_sql)) {
        $id = $deletion_row[0];
        $res_sql = mysql_query("SELECT * FROM resources WHERE member_id = '$id'", $db);
        while ($res = mysql_fetch_array($res_sql)) {
                        $to = $deletion['email'];
                        $name = $deletion['login'];
            $subject = 'MicroNationsGame.com';
            $message = "
<html>
<body>            
Your account has been deleted due to lack of logins.<br>
The account can not be recovered.<br>
<br>
Hope to see you return!<br>
Name: $name <br>
World: $world <br>
<a href=\"http://$world.micronationsgame.com\"> Login to $world now! </a>
</body>
</html>
            ";
            $headers = "From: nations@micronationsgame.com \r\n";
            $headers .= "Reply-To: nations@micronationsgame.com \r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($to, $subject, $message, $headers);
            
            $money = $deletion_row['money'];
            $food = $res['food'];
            $culture = $res['culture'];
            $goods = $res['goods'];
            $land = $deletion_row['land'];
            mysql_query("UPDATE worldbank SET money = money + '$money', food = food + '$food', culture = culture + '$culture', goods = goods + '$goods', land = land + '$land'", $db);
            mysql_query("DELETE FROM alliance WHERE member_id = '$deletion_row[0]' ", $db);
            mysql_query("DELETE FROM bills WHERE member_id = '$deletion_row[0]' ", $db);
            mysql_query("DELETE FROM connection_log WHERE member_id = '$deletion_row[0]' ", $db);
            mysql_query("DELETE FROM military  WHERE member_id = '$deletion_row[0]' ", $db);
            mysql_query("DELETE FROM resources  WHERE member_id = '$deletion_row[0]'", $db);
            mysql_query("DELETE FROM satellites  WHERE member_id = '$deletion_row[0]' ", $db);

            mysql_query("DELETE FROM nationlog WHERE nationid = '$deletion_row[0]'", $db);
            mysql_query("DELETE FROM messages WHERE user = '$deletion_row[3]'", $db);
            mysql_query("DELETE FROM bills WHERE member_id= '$deletion_row[0]'", $db);
            mysql_query("DELETE FROM members WHERE member_id = '$deletion_row[0]'", $db);
            mysql_query("DELETE FROM research WHERE member_id = '$deletion_row[0]'", $db);
            mysql_query("DELETE FROM structures WHERE member_id = '$deletion_row[0]'", $db);
            mysql_query("DELETE FROM map_coords WHERE member_id = '$deletion_row[0]'", $db);
            mysql_query("DELETE FROM points WHERE member_id = '$deletion_row[0]'", $db);
            mysql_query("DELETE FROM newb_prot WHERE member_id = '$deletion_row[0]'", $db);
        }
    }
}

echo "Training update";
//Training
$training_sql = mysql_query("SELECT * FROM training", $db);
while ($train = mysql_fetch_array($training_sql)) {
    $troops = $train['troops'];
    $troopid = $train['member_id'];
    $research_sql = mysql_query("SELECT * FROM research WHERE member_id = '$troopid'", $db);
    while ($research = mysql_fetch_array($research_sql)) {
        //Now that we have the array loaded we need to associate the array so member ids can be match to lvl.
        $train2_sql = mysql_query("SELECT * FROM training WHERE member_id = '$troopid'", $db);
        while ($train2 = mysql_fetch_array($train2_sql)) {
            $trainlevel = $train2['lvl'];
        }
        if ($troops < 0) {
            mysql_query("DELETE FROM training WHERE troops <= 0 AND spies <= 0 AND tanks <= 0 mercs <= 0", $db);
        }
        if ($troops < $trainlevel || $troops == $trainlevel) {
            $message = "You finished training troops.";
            mysql_query("UPDATE military SET infantry = infantry + '$troops' WHERE member_id = '$troopid'", $db);
            //   mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$troopid', '$message', Now())", $logdb);
            mysql_query("UPDATE training SET troops = troops - '$troops' WHERE member_id = '$troopid' AND troops = '$troops'", $db);
            mysql_query("DELETE FROM training WHERE troops = 0 AND spies = 0 AND tanks = 0 AND mercs = 0", $db);
        }
        if ($troops > $trainlevel) {

            mysql_query("UPDATE training SET troops = troops - '$trainlevel' WHERE member_id = '$troopid' AND troops = '$troops'", $db);
            mysql_query("UPDATE points SET points = points + '$trainlevel' WHERE member_id = '$troopid'", $db);
            mysql_query("UPDATE military SET infantry = infantry + '$trainlevel' WHERE member_id = '$troopid'", $db);
        }
    }
}
//Training
$training_sql = mysql_query("SELECT * FROM training", $db);
while ($train = mysql_fetch_array($training_sql)) {
    $spies = $train['spies'];
    $troopid = $train['member_id'];
    $research_sql = mysql_query("SELECT * FROM research WHERE member_id = '$troopid'", $db);
    while ($research = mysql_fetch_array($research_sql)) {
        $trainlevel = $research['miltrainlvl'];
    }
    if ($spies < 0) {
        mysql_query("DELETE FROM training WHERE spies < 0 AND troops < 0 AND tanks < 0 AND mercs < 0", $db);
    }
    if ($spies < $trainlevel || $spies == $trainlevel) {
        $message = "You finished training spies.";
        mysql_query("UPDATE military SET spies = spies + '$spies' WHERE member_id = '$troopid'", $db);
        // mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$troopid', '$message', Now())", $logdb);
        mysql_query("UPDATE training SET spies = spies - '$spies' WHERE member_id = '$troopid' AND spies = '$spies'", $db);
        mysql_query("DELETE FROM training WHERE spies = 0 AND troops = 0 AND tanks = 0 AND mercs = 0", $db);
    }
    if ($spies > $trainlevel) {

        mysql_query("UPDATE training SET spies = spies - '$trainlevel' WHERE member_id = '$troopid' AND spies = '$spies'", $db);
        mysql_query("UPDATE military SET spies = spies + '$trainlevel' WHERE member_id = '$troopid'", $db);
        mysql_query("UPDATE points SET points = points + '$trainlevel' WHERE member_id = '$troopid'", $db);
    }
}
$training_sql = mysql_query("SELECT * FROM training", $db);
while ($train = mysql_fetch_array($training_sql)) {
    $tanks = $train['tanks'];
    $troopid = $train['member_id'];
    $research_sql = mysql_query("SELECT * FROM research WHERE member_id = '$troopid'", $db);
    while ($research = mysql_fetch_array($research_sql)) {
        $trainlevel = round($research['miltrainlvl'] / 10);
    }
    if ($tanks < 0) {
        mysql_query("DELETE FROM training WHERE tanks < 0 AND troops < 0 AND spies < 0 AND mercs < 0", $db);
    }
    if ($tanks < $trainlevel || $tanks == $trainlevel) {
        $message = "You finished training tanks.";
        mysql_query("UPDATE military SET tanks = tanks + '$tanks' WHERE member_id = '$troopid'", $db);
        // mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$troopid', '$message', Now())", $logdb);
        mysql_query("UPDATE training SET tanks = tanks - '$tanks' WHERE member_id = '$troopid' AND tanks = '$tanks'", $db);
        mysql_query("DELETE FROM training WHERE tanks = 0 AND troops = 0 AND spies = 0 AND mercs = 0", $db);
    }
    if ($tanks > $trainlevel) {

        mysql_query("UPDATE training SET tanks = tanks - '$trainlevel' WHERE member_id = '$troopid' AND tanks = '$tanks'", $db);
        mysql_query("UPDATE military SET tanks = tanks + '$trainlevel' WHERE member_id = '$troopid'", $db);
        mysql_query("UPDATE points SET points = points + '$trainlevel' WHERE member_id = '$troopid'", $db);
    }
}
$training_sql = mysql_query("SELECT * FROM training", $db);
while ($train = mysql_fetch_array($training_sql)) {
    $mercs = $train['mercs'];
    $troopid = $train['member_id'];
    $research_sql = mysql_query("SELECT * FROM research WHERE member_id = '$troopid'", $db);
    while ($research = mysql_fetch_array($research_sql)) {
        $trainlevel = round($research['miltrainlvl']);
    }
    if ($mercs < 0) {
        mysql_query("DELETE FROM training WHERE tanks < 0 AND troops < 0 AND spies < 0 AND mercs < 0", $db);
    }
    if ($mercs < $trainlevel || $mercs == $trainlevel) {
        $message = "You finished training mercs.";
        mysql_query("UPDATE military SET mercs = mercs + '$mercs' WHERE member_id = '$troopid'", $db);
        // mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$troopid', '$message', Now())", $logdb);
        mysql_query("UPDATE training SET mercs = mercs - '$mercs' WHERE member_id = '$troopid' AND mercs = '$mercs'", $db);
        mysql_query("DELETE FROM training WHERE tanks = 0 AND troops = 0 AND spies = 0 AND mercs = 0", $db);
    }
    if ($mercs > $trainlevel) {

        mysql_query("UPDATE training SET mercs = mercs - '$trainlevel' WHERE member_id = '$troopid' AND mercs = '$mercs'", $db);
        mysql_query("UPDATE military SET mercs = mercs + '$trainlevel' WHERE member_id = '$troopid'", $db);
        mysql_query("UPDATE points SET points = points + '$trainlevel' WHERE member_id = '$troopid'", $db);
    }
}
$training_sql = mysql_query("SELECT * FROM trainmines", $db);
while ($train = mysql_fetch_array($training_sql)) {
    $mines = $train['mines'];
    $troopid = $train['member_id'];
    $trainlevel = $train['lvl'];

    if ($mines <= 0) {
        mysql_query("DELETE FROM trainmines WHERE mines <= 0", $db);
    }
    if ($mines < $trainlevel || $mines == $trainlevel) {
        $message = "You finished training mercs.";
        mysql_query("UPDATE military SET mines = mines + '$mines' WHERE member_id = '$troopid'", $db);
        // mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$troopid', '$message', Now())", $logdb);
        mysql_query("UPDATE trainmines SET mines = mines - '$mines' WHERE member_id = '$troopid' AND mines = '$mines'", $db);
        mysql_query("DELETE FROM trainmines WHERE mines = 0", $db);
    }
    if ($mines > $trainlevel) {

        mysql_query("UPDATE trainmines SET mines = mines - '$trainlevel' WHERE member_id = '$troopid' AND mines = '$mines'", $db);
        mysql_query("UPDATE military SET mines = mines + '$trainlevel' WHERE member_id = '$troopid'", $db);
        mysql_query("UPDATE points SET points = points + '$trainlevel' WHERE member_id = '$troopid'", $db);
    }
}
$training_sql = mysql_query("SELECT * FROM traintrans", $db);
while ($train = mysql_fetch_array($training_sql)) {
    $transports = $train['transports'];
    $troopid = $train['member_id'];
    $trainlevel = $train['lvl'];

    if ($transports <= 0) {
        mysql_query("DELETE FROM traintrans WHERE transports <= 0", $db);
    }
    if ($transports < $trainlevel || $mines == $trainlevel) {
        $message = "You finished training transports.";
        mysql_query("UPDATE military SET transports = transports + '$transports' WHERE member_id = '$troopid'", $db);
        // mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$troopid', '$message', Now())", $logdb);
        mysql_query("UPDATE traintrans SET transports = transports - '$transports' WHERE member_id = '$troopid' AND transports = '$transports'", $db);
        mysql_query("DELETE FROM traintrans WHERE transports = 0", $db);
    }
    if ($transports > $trainlevel) {

        mysql_query("UPDATE traintrans SET transports = transports - '$trainlevel' WHERE member_id = '$troopid' AND transports = '$transports'", $db);
        mysql_query("UPDATE military SET transports = transports + '$trainlevel' WHERE member_id = '$troopid'", $db);
        mysql_query("UPDATE points SET points = points + '$trainlevel' WHERE member_id = '$troopid'", $db);
    }
}
/*
$training_sql = mysql_query("SELECT * FROM trainf16", $db);
while ($train = mysql_fetch_array($training_sql)) {
    $f16 = $train['f16'];
    $troopid = $train['member_id'];
    $trainlevel = $train['lvl'];

    if ($f16 <= 0) {
        mysql_query("DELETE FROM trainf16 WHERE f16 <= 0", $db);
    }
    if ($f16 < $trainlevel) {
        $message = "You finished training f16.";
        mysql_query("UPDATE military SET f16 = f16 + '$f16' WHERE member_id = '$troopid'", $db);
        // mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$troopid', '$message', Now())", $logdb);
        mysql_query("UPDATE trainf16 SET f16 = f16 - '$f16' WHERE member_id = '$troopid' AND f16 = '$f16'", $db);
        mysql_query("DELETE FROM trainf16 WHERE f16 = 0", $db);
    }
    if ($f16 > $trainlevel || $f16 === $trainlevel) {

        mysql_query("UPDATE trainf16 SET f16 = f16 - '$trainlevel' WHERE member_id = '$troopid' AND f16 = '$f16'", $db);
        mysql_query("UPDATE military SET f16 = f16 + '$trainlevel' WHERE member_id = '$troopid'", $db);
        mysql_query("UPDATE points SET points = points + ('$trainlevel' * 100) WHERE member_id = '$troopid'", $db);
    }
}
*/

// New qeues
$training_sql = mysql_query("SELECT * FROM trainf16 WHERE timestamp < UNIX_TIMESTAMP()", $db);
while ($train = mysql_fetch_array($training_sql)) {
    $troopid = $train['member_id'];
    $f16 = $train['f16'];
    $timestamp = $train['timestamp'];
    $trainlevel = $train['lvl'];


        mysql_query("UPDATE military SET f16 = f16 + '$f16' WHERE member_id = '$troopid'", $db);
        mysql_query("DELETE FROM trainf16 WHERE f16 = '$f16' && member_id = '$troopid' && timestamp < UNIX_TIMESTAMP()", $db);
   
}
$training_sql = mysql_query("SELECT * FROM trainac130 WHERE timestamp < UNIX_TIMESTAMP()", $db);
while ($train = mysql_fetch_array($training_sql)) {
    $troopid = $train['member_id'];
    $ac130 = $train['ac130'];
    $timestamp = $train['timestamp'];
    $trainlevel = $train['lvl'];


        mysql_query("UPDATE military SET ac130 = ac130 + '$ac130' WHERE member_id = '$troopid'", $db);
        mysql_query("DELETE FROM trainac130 WHERE ac130 = '$ac130' && member_id = '$troopid' && timestamp < UNIX_TIMESTAMP()", $db);

}    
    
    

//tick stuff
$now = new DateTime;
$clone = $now;        //this doesnot clone so:
$clone->modify('+5 Minutes');

$date = $now->format('d/m/Y g:i:00 A');
mysql_query("UPDATE date SET date = '$date'", $db);

//end tick stuff
//For beta testing remove when done!!
//$result7 = mysql_query("UPDATE members SET money = money + 10000");

$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
echo 'Update for ' . $world . ' generated in ' . $total_time . ' seconds.' . "\n";
?>
