<?php        include('/home/nations/public_html/beta/config.php');

	require_once("$directory/includes/config/auth.php");
        include("$directory/includes/misc/include.php");
$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$name = mysql_real_escape_string($_SESSION['SESS_LOGIN']);

$nation = mysql_real_escape_string($_GET['name']);

               if($nation == '')
               {
                   $errmsg_arr[] = 'Please provide a nation name.';
		   $errflag = true;
               }
               if ($name == $nation)
                                  {
                   $errmsg_arr[] = 'Cannot place above your own nation.';
		   $errflag = true;
               }
              if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../sat.php");
		exit();
                }


$nation_sql = mysql_query("SELECT * FROM members WHERE login = '$nation'", $db);
                 if($nation_sql)
                    {
			if(mysql_num_rows($nation_sql) <= 0)
                            {
                              $errmsg_arr[] = 'That nation does not exist.';
                              $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                              header("location: ../..//sat.php");
                              exit();
                            }


			}
while($nation_row = mysql_fetch_array($nation_sql))
{
   
    $sat_sql = mysql_query("SELECT * FROM satellites WHERE id2 = '$nation_row[0]' AND member_id = '$id'", $db);
     
		if($sat_sql)
                    {
			if(mysql_num_rows($sat_sql) > 0)
                            {
                              $errmsg_arr[] = 'There is already a satellite in place above this nation.';
                              $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                              header("location: ../../sat.php");
                              exit();
                            }

                      }

                   $mil_sql = mysql_query("SELECT * FROM military WHERE member_id = '$id'");
                   while($mil_row = mysql_fetch_array($mil_sql))
                   {
                       if($mil_row[6] == 0)
                       {
                              $errmsg_arr[] = 'You have no satellites to use.';
                              $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                              header("location: ../../sat.php");
                              exit();
                       }

                   }
                            $message = "You place a satellite above " . $nation . ".";
                            mysql_query("INSERT INTO nationlog (nationid, message, date) VALUES ( '$id', '$message', Now())", $logdb);
                            mysql_query("INSERT INTO satellites (member_id, id2) VALUES ('$id', '$nation_row[0]')", $db);
                            mysql_query("UPDATE military SET sat = sat - 1 WHERE member_id = '$id'", $db);
                            $errmsg_arr[] = $message;
			    $errflag = true;
                        
              if($errflag)
                {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../../sat.php");
		exit();
                }




}
?>