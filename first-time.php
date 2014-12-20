<?php  
include("config.php");

  include("$directory/includes/config/auth.php");
  include("$directory/includes/misc/include.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Account Creation.</title>
        <link href="loginmodule.css" rel="stylesheet" type="text/css" />
        <link href="button.css" rel="stylesheet" type="text/css" />

    </head>
    <body><div id="banner">
            <h1>Welcome <?php echo $_SESSION['SESS_LOGIN']; ?> to <?php echo $game_name; ?>!</h1>
            <?php include("$directory/includes/misc/clock.php"); ?>
        </div>

        <?php
        include("$directory/includes/menus/newmenu.php");
        echo "<div id=\"main\">";
        include("$directory/includes/misc/infomsg.php");
?>

        <br>
        <p>Welcome to the MicroNations!!!</p>
        <p>The game is still in its early stages of development.</p>
        <p>Please have a look at the menu on the left.  You will find all the tools to run your nation.</p>
            <p>Please select the quests as soon as you hit the dismiss button below.</p>
        Hitting the dismiss button will give you the following to start your new nation. Please follow the quests!
               <br>
            <br>
                <form action="./includes/account/firsttime-remove.php" method="get">
                <input type="hidden" name="firstlogin" value="firstlogin">
                   <input type="submit" name="dismiss" value="Dismiss" />


<?php include("$directory/includes/misc/online.php"); 
        echo "</div>";
        include("$directory/includes/misc/count.php"); include("$directory/includes/misc/footer.php"); ?>
</body>
</html>
