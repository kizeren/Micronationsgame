
<?php
        require_once('auth.php');
include('/home/mcbride/public_html/micronationsgame/config.php');

        include('functions.php');
include("include.php");
        $id = mysql_real_escape_string($_SESSION['SESS_LOGIN']);
        $ally = mysql_real_escape_string($_SESSION['SESS_ALLIANCE']);
        $descr = mysql_real_escape_string($_GET['description']);
/**
 * Remove HTML tags, including invisible text such as style and
 * script code, and embedded objects.  Add line breaks around
 * block-level tags to prevent word joining after tag removal.
 */
$description =  strip_html_tags( $descr );


               if($description == '')
                {
                $errmsg_arr[] = 'Your forgot to put a description.';
		$errflag = true;
                }


      	        if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ally.php");
		exit();

                }

        $message_notify = mysql_query("UPDATE alliance SET description = '$description' WHERE name = '$ally'", $db);
        $errmsg_arr[] = 'Alliance info updated.';
	$errflag = true;

        if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ally.php");
		exit();

                }

        include("count.php");
        include("online.php");
        include("footer.php");
?>
