<?php
include("/home/nations/public_html/beta/includes/config/config.php");
include("$directory/includes/config/auth.php");
$datesql = mysql_query("SELECT * FROM date", $db);
while ($daterow = mysql_fetch_array($datesql)) {
    $date = $daterow[0];
}
?>




<script language="JavaScript">

TargetDate = "<?php echo $date ?>";
BackColor = "palegreen";
ForeColor = "navy";
CountActive = true;
CountStepper = -1;
LeadingZero = true;
DisplayFormat = "%%M%%:%%S%%";
FinishMessage = "Tick in progress.";
</script>
<script language="JavaScript" src="http://scripts.hashemian.com/js/countdown.js"></script>
