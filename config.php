<?php

//Game Defeines
//Connection for game
$host = '127.0.0.1';
$dbuser = 'username';
$dbpass = 'userpass';
$database = 'nations';

//language database
$langhost = '127.0.0.1';
$languser = 'username';
$langpass = 'userpass';
$langdata = 'nations_lang';



//Connection for logging don't use if you don't need it just turn off global logging.
//Experimental.  Does really do what I want it to do.
$loghost = '127.0.0.1';
$loguser = 'username';
$logpass = 'userpass';
$logdata = 'nations_log';

//Connection for forums
$forumhost = '127.0.0.1';
$forumuser = 'username';
$forumpass = 'userpass';
$forumdata = 'nationsforum';


//Memcache connection
$host = '127.0.0.1';
$port = '65000';

//Exploring a logall feature to log everything in the game.        
$logall = 1;


//Database link for main game
$db = mysql_connect($host, $dbuser, $dbpass);
if (!$db) {
//    die('Failed to connect to server: ' . mysql_error());
 
    header("location:maintenance.html");
    
}
//Database link for logging
$logdb = mysql_connect($loghost, $loguser, $logpass);
if (!$logdb) {
   echo 'Failed to connect to the log server: ' . mysql_error();
}
//Database link for language
$langdb = mysql_connect($langhost, $languser, $langpass);
if (!$langdb) {
   echo 'Failed to connect to the language server: ' . mysql_error();
}
//Database link for forum
$forumdb = mysql_connect($forumhost, $forumuser, $forumpass);
if (!$forumdb) {
   echo 'Failed to connect to the forum server: ' . mysql_error();
}

//Select database for main game
mysql_select_db($database, $db);
if (!$database) {
    die("Unable to select database");
}
//Select database for logs
mysql_select_db($logdata, $logdb);
if (!$logdata) {
    echo "Unable to select log database";
}
//select language database
mysql_select_db($langdata, $langdb);
if (!$langdata) {
    echo "Unable to select language database";
}
//select forum database
mysql_select_db($forumdata, $forumdb);
if (!$forumdata) {
    echo "Unable to select forum database";
}


//Start maintenance mode 
$maint_sql = "SELECT * FROM maintenance";
$maint_row = mysql_query($maint_sql, $db);
while ($maint = mysql_fetch_array($maint_row)) {
    if ($maint[0] == "1") {
        $ismaint = "true";
    }
    else
    {
        $ismaint = "false";
    }
}
//End Maintenance mode   
//Start Check for IP bans
$ip = $_SERVER['REMOTE_ADDR'];

$result = mysql_query("SELECT * FROM ipbans WHERE ip='$ip'", $db);
if ($result) {
    if (mysql_num_rows($result) > 0) {
        $isipban = "true";
    }
    if (mysql_num_rows($result) == 0)
    {
        $isipban = "false";
    }
}

//End IP bans check

//Game Variables.
$game_name = "MicroNations";
$world = "beta";
$max_farm = '1000';
$max_commercial = '1000';
$max_industry = '1000';
$max_home = '8000';
$max_warehouse = '1000';
$max_barracks = '2';
$max_hangers = '2';
$max_qeues = '2';
$max_gold_mine = '1';
$max_land = '12000';
$personfarm = '1';
$personcomm = '2';
$personindustry = '5';
$max_gold_level = '200';
/*
Not using max levels on these yet.
$max_lvl_tech = " ";
$max_lvl_farm = "";
$max_lvl_goods =  "";
 $max_lvl_culture = "";
 * 


*/

//Military hit, defense and carry
$infantryhit = 1;
$infantrydef = 2;
$infantrycarry = 10;
$tankhit = 10;
$tankdef = 10;
$tankcarry = 1;
$merchit = 1;
$mercdef = 0;
$merccarry = 0;
$minehit = 0;
$minedef = 3;
$transhit = 0;
$transdef= 5;
$transcarry = 1000;
$f16hit=50;
$f16def=25;
$ac130hit=150;
$ac130def=200;
//memcached tests

$memtimeout = 3600;

$directory = "/home/nations/public_html/$world";



    @mysql_free_result($result);
    @mysql_free_result($maint_sql);
?>