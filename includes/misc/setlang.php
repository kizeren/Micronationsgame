<?php
session_start();

$_SESSION['SESS_LANG'] = $_GET['language'];
session_write_close();
echo $_SESSION['SESS_LANG'];
echo $_GET['language'];
header("location: ../../index.php");
?>
