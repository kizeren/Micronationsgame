
<?php

include('/home/mcbride/public_html/micronationsgame/config.php');

include("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

$id = mysql_real_escape_string($_SESSION['SESS_LOGIN']);
$subject = mysql_real_escape_string($_GET['subject']);
$user = mysql_real_escape_string($_GET['user']);
$body = mysql_real_escape_string($_GET['body']);

if ($subject == '') {
    $errmsg_arr[] = 'Your forgot to put a subject.';
    $errflag = true;
}
if ($user == '') {
    $errmsg_arr[] = 'Your forgot who its too.';
    $errflag = true;
}
if ($body == '') {
    $errmsg_arr[] = 'Empty message.';
    $errflag = true;
}

if ($user != '') {
    $qry = "SELECT * FROM members WHERE login='$user'";
    $result = mysql_query($qry, $db);
    if ($result) {
        if (mysql_num_rows($result) <= 0) {
            $errmsg_arr[] = 'That user does not exist.';
            $errflag = true;
        }
        @mysql_free_result($result);
    }
}

if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    header("location: ../../new-message.php");
    exit();
}

$message_post = mysql_query("INSERT INTO messages (user, fromuser, subject, body, date) VALUES ('$user', '$id', '$subject', '$body', Now())", $db);
$message_notify = mysql_query("UPDATE members SET new_message = new_message + 1 WHERE login = '$user'", $db);
$errmsg_arr[] = 'Message sent to ' . $user . '.';
$errflag = true;

if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    header("location: ../../messages.php");
    exit();
}

?>


