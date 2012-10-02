<?php
        include('/home/nations/public_html/beta/config.php');

	require_once("$directory/includes/config/auth.php");
        include("$directory/includes/misc/include.php");

$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$firstname = mysql_real_escape_string($_GET['firstname']);
$lastname = mysql_real_escape_string($_GET['lastname']);
$email = mysql_real_escape_string($_GET['email']);
$language = mysql_real_escape_string($_GET['language']);
$war = mysql_real_escape_string($_GET['war']);
$news = mysql_real_escape_string($_GET['news']);


$_SESSION['SESS_LANG'] = $language;

//Update the user settings
mysql_query("UPDATE members SET firstname = '$firstname', lastname = '$lastname', email = '$email', language = '$language' WHERE member_id='$id'", $db);
mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', 'You changed account settings. Fist name to $firstname. Last name to $lastname. Email to $email.', Now())", $logdb);
mysql_query("UPDATE msettings SET warreports = '$war', news = '$news' WHERE member_id = '$id'", $db);
echo "$result";
header("location: ../../account.php");

?>
