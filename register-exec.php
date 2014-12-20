<?php
	//Start session
	session_start();
	
	//Include database connection details
  include("config.php");
  include("./includes/misc/include.php");
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$fname = clean($_POST['fname']);
	$lname = clean($_POST['lname']);
	$login = clean($_POST['login']);
	$password = clean($_POST['password']);
	$cpassword = clean($_POST['cpassword']);
	$nation = clean($_POST['nation']);
        $email = clean($_POST['email']);
        $language = clean($_POST['language']);
	//Input Validations
	if($fname == '') {
		$errmsg_arr[] = 'First name missing';
		$errflag = true;
	}
	if($lname == '') {
		$errmsg_arr[] = 'Last name missing';
		$errflag = true;
	}
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
        if($email == '') {
		$errmsg_arr[] = 'Email missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
	}
		if($nation == '') {
		$errmsg_arr[] = 'Nation missing';
		$errflag = true;
	}
        //Check for duplicate Email address for multiplaying
        	if($email != '') {
		$qry = "SELECT * FROM members WHERE email='$email'";
		$result = mysql_query($qry, $db);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'Provided email address was found on another account.';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}
	//Check for duplicate login ID
	if($login != '') {
		$qry = "SELECT * FROM members WHERE login='$login'";
		$result = mysql_query($qry, $db);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'Login ID already in use';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: register-form.php");
		exit();
	}

	//Create INSERT query
	$qry = "INSERT INTO members(firstname, lastname, login, passwd, datetime, nation, flag, money, housing, farm, popcount, tax, first_login, email, language) VALUES('$fname','$lname','$login','".md5($_POST['password'])."', Now(), '$nation', './flags/Nauru.png', '20000', '100', '100', '100', '2', '1', '$email', '$language')";
        
        $result = @mysql_query($qry, $db);
mysql_query("INSERT INTO minibbtable_users (username, user_password, user_regdate)VALUES('$login', '".md5($_POST['password'])."', NOW())", $forumdb);

        //include("defaults.php");
	//Check whether the query was successful or not
	if($result) {
            $subject = 'MicroNationsGame.com';
            $message = "
<html>
<body>            
Thank you for signing up to try MicroNations Game.<br>
The game is still in beta phase.  Just means game is buggy and doesn't<br>
always work like it should at times.<br>
<br>
<br>
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
		header("location: register-success.php");
		exit();
	}else {
		die("Query failed");
	}
?>

