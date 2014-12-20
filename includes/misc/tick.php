<?php
include("/home/mcbride/public_html/micronationsgame/config.php");
include("$directory/includes/config/auth.php");
$datesql = mysql_query("SELECT * FROM date", $db);
while ($daterow = mysql_fetch_array($datesql)) {
    $date = $daterow[0];
}
?>
<script language="JavaScript">
 <?php 
 /*
Author: Robert Hashemian
http://www.hashemian.com/

You can use this code in any manner so long as the author's
name, Web address and this disclaimer is kept intact.
********************************************************
  * 
  */
 ?>
    TargetDate = "<?php echo $date; ?>";
    BackColor = "white";
    ForeColor = "black";
    CountActive = true;
    CountStepper = -1;
    LeadingZero = true;
    DisplayFormat = "%%M%%:%%S%%";
    FinishMessage = "Tick in progress";
    function calcage(secs, num1, num2) {
        s = ((Math.floor(secs/num1))%num2).toString();
        if (LeadingZero && s.length < 2)
            s = "0" + s;
        return "<b>" + s + "</b>";
    }
    
    function CountBack(secs) {
        if (secs < 0) {
            document.getElementById("cntdwn").innerHTML = FinishMessage;
            return;
        }
        DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs,86400,100000));
        DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
        DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
        DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));
        
        document.getElementById("cntdwn").innerHTML = DisplayStr;
        if (CountActive)
            setTimeout("CountBack(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
    }
    
    function putspan(backcolor, forecolor) {
        document.write("<span id='cntdwn' style='background-color:" + backcolor + 
            "; color:" + forecolor + "'></span>");
    }
    
    if (typeof(BackColor)=="undefined")
        BackColor = "white";
    if (typeof(ForeColor)=="undefined")
        ForeColor= "black";
    if (typeof(TargetDate)=="undefined")
        TargetDate = "12/31/2020 5:00 AM";
    if (typeof(DisplayFormat)=="undefined")
        DisplayFormat = "%%M%%:%%S%%";
    if (typeof(CountActive)=="undefined")
        CountActive = true;
    if (typeof(FinishMessage)=="undefined")
        FinishMessage = "";
    if (typeof(CountStepper)!="number")
        CountStepper = -1;
    if (typeof(LeadingZero)=="undefined")
        LeadingZero = true;
    
    
    CountStepper = Math.ceil(CountStepper);
    if (CountStepper == 0)
        CountActive = false;
    var SetTimeOutPeriod = (Math.abs(CountStepper)-1)*1000 + 990;
    putspan(BackColor, ForeColor);
    var dthen = new Date(TargetDate);
    var dnow = new Date("<?= strftime('%d/%m/%G %I:%M:%S %p') ?>"); 
    
    if(CountStepper>0)
        ddiff = new Date(dnow-dthen);
    else
        ddiff = new Date(dthen-dnow);
    gsecs = Math.floor(ddiff.valueOf()/1000);
    CountBack(gsecs);
    
</script>
