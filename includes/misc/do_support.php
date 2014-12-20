<?php
include('/home/mcbride/public_html/micronationsgame/config.php');

include("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$name = mysql_real_escape_string($_GET['name']);
$world = mysql_real_escape_string($_GET['world']);
$description = mysql_real_escape_string($_GET['description']);


	if($name == '') {
		$errmsg_arr[] = 'You forgot your name.';
		$errflag = true;

	}
        
	if($world == '') {
		$errmsg_arr[] = 'You forgot your world.';
		$errflag = true;

	}

	if($description == '') {
		$errmsg_arr[] = 'You forgot to fill out the problem description.';
		$errflag = true;

	}
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: $directory/support.php");
		exit();
	}

mysql_query("INSERT INTO support (name, world, description, datetime) VALUES ('$name', '$world', '$description', NOW())", $logdb);
$ticket = mysql_insert_id();

//Ingame mail
$subject = "Support ticket #" . $ticket;
$body = "Thank you for submitting a ticket.
          We will work as hard as possible to resolve you problem.";
 mysql_query("INSERT INTO messages (user, fromuser, subject, body, date) VALUES ( '$name', 'Support', '$subject', '$body', Now())", $db);
 mysql_query("UPDATE members SET new_message = new_message + 1 WHERE member_id = '$id'", $db);

 //Send email to member
 $member_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
 while($member = mysql_fetch_array($member_sql))
 {
    $to = $member['email'];
    $subject = 'MicroNationsGame.com';
    $message = "Your Support ticket #$ticket.  World: $world. Description: $description"  ;
    $headers = "From: nations@micronationsgame.com";
    $reply = "Reply-To: nations@micronationsgame.com";
          
                
    mail($to, $subject, $message, $headers);
 }
$errmsg_arr[] = 'Support ticket sent. Ticket number ' . $ticket;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
header("location: $directory/support.php");

?>
