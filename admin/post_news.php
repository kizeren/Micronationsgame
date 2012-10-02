<?php        include('/home/nations/public_html/beta/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

        $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $admin_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'");
        $adminname = mysql_real_escape_string($_SESSION['SESS_LOGIN']);
        $title = mysql_real_escape_string($_GET['title']);
        $body = mysql_real_escape_string($_GET['body']);
        while($admin_row = mysql_fetch_array($admin_sql))
                if($admin_row[25] < 5)
                {
                    header("location: ../member-index.php");
                }


         $massmail = mysql_query("SELECT * FROM members", $db);
         while($mmrow = mysql_fetch_array($massmail))
         {
             $login = $mmrow['login'];
             $member_id = $mmrow['member_id'];
             $to = $mmrow['email'];
        mysql_query("INSERT INTO messages (user, fromuser, subject, body, date) VALUES ('$login', '$adminname', '$title', '$body', Now())", $db);
        mysql_query("UPDATE members SET new_message = new_message + 1 WHERE login = '$login'", $db);

        $newsmailsql = mysql_query("SELECT * FROM msettings WHERE member_id = '$member_id' AND news = 'true'", $db);
        {
         
            $subject = 'MicroNationsGame.com';
            $message = "
<html>
<body>
$login,<br>
 <br>           
$title<br>
$body
<br>
<br>
<br>
News for World: $world <br>
This was an automated message.  To turn this off login using the link below.  Go to account and set \"news\" to false.<br>
<a href=\"http://$world.micronationsgame.com\"> Login to $world now! </a><br>
</body>
</html>
            ";
            $headers = "From: nations@micronationsgame.com \r\n";
            $headers .= "Reply-To: nations@micronationsgame.com \r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($to, $subject, $message, $headers);  
            
            
            
            
         }
         }
        $user = mysql_real_escape_string($_SESSION['SESS_LOGIN']);

        $news_sql = mysql_query("INSERT INTO news (title, body, name, datetime) VALUES ('$title', '$body', '$user', Now())", $db);
                $errmsg_arr[] = 'News Posted.';
		$errflag = true;
            if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: index.php");
		exit();

                }
?>
