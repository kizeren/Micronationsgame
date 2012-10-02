<?php
	//Start session
	session_start();

	//Include database connection details
        include("config.php");
        include("$directory/includes/misc/include.php");
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
	$login = clean($_POST['login']);
	$password = clean($_POST['password']);
	
	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
        //Check for bans
        $query = mysql_query("SELECT * FROM members WHERE login = '$login'", $db);
        while($row = mysql_fetch_array($query))
        {
        

	if($row[39] == '1') {
		$errmsg_arr[] = 'You have been banned from the game';
		$errflag = true;

	}
        }

	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php");
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM members WHERE login='$login' AND passwd='".md5($_POST['password'])."'";
	$result=mysql_query($qry, $db);
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $member['member_id'];
			$_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
			$_SESSION['SESS_LAST_NAME'] = $member['lastname'];
                        $_SESSION['SESS_LOGIN'] = $member['login'];
                        $_SESSION['SESS_ALLIANCE'] = $member['alliance'];
                        $_SESSION['SESS_LANG'] = $member['language'];
                        
                        $errmsg_arr[] = 'Changes in progress....';
			$errmsg_arr[] = 'Please read the forums for the recent changes.  Game is not working 100% yet.';

                        $errflag = true;
                        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;

			session_write_close();
                        // log the ip addy for pushing
                        $id = $_SESSION['SESS_MEMBER_ID'];
                        $ipaddy = $_SERVER['REMOTE_ADDR'];
                        mysql_query("INSERT INTO connectionlog SET member_id = '$id', ipaddy = '$ipaddy', date = CURDATE(), time = CURTIME()", $db);
			header("location: member-index.php");
 
                        exit();
		}else {
			//Login failed
			header("location: index.php");
			exit();
		}
	}else {
		die("Query failed");
	}
?>
