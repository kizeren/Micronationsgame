<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MicroNations</title>

        <link href="loginmodule.css" rel="stylesheet" type="text/css" />
        <link href="button.css" rel="stylesheet" type="text/css" />
        <?php
        include("config.php");
        include("$directory/includes/misc/include.php");
        session_start();

        if($_SESSION['SESS_LANG'] == '')
        {
            $_SESSION['SESS_LANG'] = "en";
        }
        $lang = $_SESSION['SESS_LANG'];
        echo "<h1>$game_name <img src=\"http://mcbride.homelinux.net/~nations/flags/beta_icon.gif\"></h1>";
        ?>
        <a href="register-form.php">Register for free!</a>
    </head>

    <body>

        <p>&nbsp;</p>
                <center>
            <form method="get" action="./includes/misc/setlang.php" >
                <select name="language" >
                    <option value="en">English(EN)</option>
                    <option value="es">Spanish(ES)</option>
                    <option value="de">German (DE)</option>
                </select>
                <input type="submit" value="Lang Select" />
            </form>
        </center>
               <?php 
       
       $lang_sql = mysql_query("SELECT * FROM lang WHERE lang = '$lang'", $langdb);
       while($langrow = mysql_fetch_array($lang_sql))
       
       
       
       { ?>
        <form id="loginForm" name="loginForm" method="post" action="login-exec.php">
            <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
                     <tr>
                        <td width="112"><b><?php echo $langrow['world']; ?>: </b></td>
                        <td width="188"><?php echo "$world" ?></td>
                    </tr>
                    <tr>
                        <td width="112"><b><?php echo $langrow['username']; ?>:</b></td>
                        <td width="188"><input name="login" type="text" class="textfield" id="login" /></td>
                    </tr>    

                    <tr>
                        <td><b><?php echo $langrow['password']; ?>:</b></td>
                        <td><input name="password" type="password" class="textfield" id="password" /></td>
                    </tr>

                    

                    <td colspan="3"><input type="submit" name="Submit" value="<?php echo $langrow['login']; ?>" class="myButton"/><a href="http://www.micronationsgame.com" class="myButton"><?php echo $langrow['login3']; ?></a></td>
                
            </table>
        </form>
                ** We are looking for translators.  Speak another language?  Send an email to nations@micronationsgame.com  and let us know what languages you can speak!

        <br />
        <?php echo $langrow['login1']; ?>
        <br />
        <br />
<?php

$result = mysql_query("SELECT * FROM members ORDER BY member_id DESC LIMIT 0,10" , $db);

while ($row = mysql_fetch_array($result)) {

    echo "<img width=\"40px\" height=\"40px\" src=\"$row[10]\">&nbsp&nbsp&nbsp<a href=\"./public_profile.php?id=$row[0]\">$row[5]</a><br>";
}
echo"<br><br><br>";
echo $langrow['login2'];
echo "<br>";
$top_money_sql = mysql_query("SELECT * FROM members ORDER BY money DESC LIMIT 0,5", $db);
while ($top_money_row = mysql_fetch_array($top_money_sql)) {
    $top_money = number_format($top_money_row[14]);

    echo "<img width=\"40px\" height=\"40px\" src=\"$top_money_row[10]\">&nbsp&nbsp&nbsp<a href=\"./public_profile.php?id=$top_money_row[0]\">$top_money_row[5]</a> $$top_money $top_money_row[7]<br>";
}
       }
?>
    </body>
</html>
