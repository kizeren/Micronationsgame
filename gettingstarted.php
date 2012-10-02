<?php
  include("./includes/config/auth.php");
  include("./includes/config/config.php");
  include("./includes/misc/include.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Getting Started</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="banner">   
<h1>Getting Started</h1>
<?php include("clock.php");
echo "</div>";
include("newmenu.php");
echo "<div id=\"main\">";
include("$directory/includes/misc/resource.php");

include("infomsg.php");

$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$result = mysql_query("SELECT * FROM members WHERE member_id='$id'", $db);

?>

<dl>
    <dt>Creating Your Nation</dt>
    <dd>By clicking on the Update National Information link, you will be able to create your nation. To choose your flag, click on the flag link next to the presented space.</dd>
<dd>Your profile page will show all of your basic nation information.</dd>
<dd>Your home page will show your basic nation information as well as your building updates, population information, food production, and upkeep.</dd>
</dl>

<dt>Building</dt>
<dd>Homes: 1 person per each home</dd>
<dd>Commercial: 5 workers per each commercial</dd>
<dd>Industry: 3 workers per each industry</dd>
<dd>Farms: 1 worker per each farm</dd>
<dd>Land: Each building requires one acre</dd>
<dd>The number of businesses or farms you have can not out number the amount of houses you have. You can not have more workers than household members.</dd>
</dl>
<dt>Research</dt>
<dd>From your home page, you will be able to research farming, culture, and industry. At every level of research, you receive a bonus that will increase the amount of goods, culture, and food your nation produces.</dd>
</dl>
<dt>Ticks</dt>
<dd>Every 5 minutes there is an update. Each tick adds population depending on set tax rate and updates other calculations.</dd>
<dd>The webpages are set to auto refresh every 60 seconds. This may change.</dd>
</dl>
<dt>Workforce</dt>
<dd>By clicking on the Workforce link, you will be able to assign your population to whatever designated jobs you choose. Remember, you can only assign jobs according to the amount of population your nation has accumulated as well as the amount of businesses you have built.</dd>
</dl>
<dt>World Statistics</dt>
<dd>By clicking on the World Stats link, you will be able to view the statistics accumulated by the total amount of nations created within the game. By clicking on the World Organization logo, you will be presented with the option to sell or buy resources. You will also be able to transfer resources to another player.</dd>
</dl>
<dt>Propositions</dt>
<dd>MicroNations offers propositions for nation leaders to vote on. Each proposition you vote on will either benefit your nation or inhibit your nation. So, vote wisely!</dd>
</dl>
<dt>Alliance</dt>
<dd>Soon to come</dd>
</dl>
<dt>General Chat and Help</dt>
<dd>The chat presents 3 tabs. The General chat is for general conversation. In Game RPG is in game chat and you will find a help tab as well. By clicking on this tab, you will be able to inform administration of any in game problems as well as ask any questions you may have or make game suggestions.</dd>
</dl>
<dt>Messaging</dt>
<dd>By clicking the Telegrams link, you will be able to view and send messages to other players.</dd>
</dl>
<dt>News</dt>
<dd>By clicking on the News link, you will be able to view any updated information and additions to the game.</dd>
</dl>
<?php
include("online.php");
include("count.php");
include("footer.php");
?>