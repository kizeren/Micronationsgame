

  <?php
  //This is for phpfreechat.
  
  include("./includes/config/auth.php");
  include("config.php");
  include("./includes/misc/include.php");
  $name = mysql_real_escape_string($_SESSION['SESS_LOGIN']);
  $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
  $alliance = $_SESSION['SESS_ALLIANCE'];
  $langid = $_SESSION['SESS_LANG'];
$language_sql = mysql_query("SELECT * FROM chat WHERE lang = '$langid'", $langdb);
while ($langrow = mysql_fetch_array($language_sql)) {
    $l1 = $langrow['1'];
    $l2 = $langrow['2'];
    $l3 = $langrow['3'];
    $l4 = $langrow['4'];
    $l5 = $langrow['5'];

}
  require_once "chat/src/phpfreechat.class.php"; // adjust to your own path
  $params["serverid"] = md5(__FILE__);
  $params["nick"]     = "$name"; // it can be useful to take nicks from a database
  $params["title"] = "MicroNations";
  $params["frozen_nick"] = true;
  $params["admins"] = array('username' => 'password', 'username' => 'password');
  $params["theme"]       = "msn";
  if ($alliance = "")
  {
  $params["channels"] = array("$l1-" . $world, "$l2-" . $world, "$l3-" . $world, $alliance-$world, "$l4-" . $langid, "$l5");
  }
  else 
  {
  $params["channels"] = array("$l1-" . $world, "$l2-" . $world, "$l3-" . $world, "$l4-" . $world, "$l5");

  }
  $chat = new phpFreeChat($params);
  ?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <title>Chat</title>
    </head><link href="loginmodule.css" rel="stylesheet" type="text/css" />
      <h1>MicroNation Chat</h1>

    <body>
      <?php $chat->printChat(); ?>

                    
    </body>
  </html>
