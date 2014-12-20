<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Form</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php

echo "<h1>Registration</h1>";
include("config.php");
$langid = $_SESSION['SESS_LANG'];

	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<ul class="err">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>'; 
		}
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}
$language_sql = mysql_query("SELECT * FROM lang WHERE lang = '$langid'", $langdb);
while ($langrow = mysql_fetch_array($language_sql)) {

           
?>
 
    
<form id="loginForm" name="loginForm" method="post" action="register-exec.php">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <th><?php echo $langrow['firstname']; ?></th>
      <td><input name="fname" type="text" class="textfield" id="fname" /></td>
    </tr>
    <tr>
      <th><?php echo $langrow['lastname']; ?></th>
      <td><input name="lname" type="text" class="textfield" id="lname" /></td>
    </tr>
    <tr>
      <th width="124"><?php echo $langrow['username']; ?></th>
      <td width="168"><input name="login" type="text" class="textfield" id="login" /></td>
    </tr>
    <tr>
      <th><?php echo $langrow['password']; ?></th>
      <td><input name="password" type="password" class="textfield" id="password" /></td>
    </tr>
    <tr>
      <th><?php echo $langrow['confirmpass']; ?></th>
      <td><input name="cpassword" type="password" class="textfield" id="cpassword" /></td>
    </tr>
       <tr>
      <th><?php echo $langrow['email']; ?></th>
      <td><input name="email" type="text" class="textfield" id="nation" /></td>
    </tr>
        <tr>
      <th><?php echo $langrow['nationname']; ?></th>
      <td><input name="nation" type="text" class="textfield" id="nation" /></td>
    </tr>
        <?php echo "<tr><th>$account1</th><td>               <select name=\"language\" >
                    <option value=\"en\">English</option>
                    <option value=\"es\">Spanish</option>
                    <option value=\"de\">German</option>

                </select> </td></tr>"; ?>
      <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="<?php echo $langrow['register']; ?>" /></td>
    </tr>
  </table>
</form>
<?php 
//end language

echo "$lang";
}
include("$directory/includes/misc/online.php"); ?>
</body>
</html>
