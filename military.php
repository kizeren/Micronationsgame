<?php
include("config.php");
include("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Military</title>
        <link href="loginmodule.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <div id="banner">
            <h1>Military</h1>

            <?php
            include("$directory/includes/misc/clock.php");
            echo "</div>";

            include("$directory/includes/menus/newmenu.php");

            echo "<div id=\"main\">";
            include("$directory/includes/misc/resource.php");

            include("$directory/includes/misc/infomsg.php");
            include("$directory/includes/misc/count.php");
            $id = $_SESSION['SESS_MEMBER_ID'];
            $perticksql = mysql_query("SELECT * FROM research WHERE member_id = '$id'", $db);
            while ($pertick = mysql_fetch_array($perticksql)) {
                $millvl = $pertick['miltrainlvl'];
            }
            $mercs = $millvl;
            $infantry = $millvl;
            $spies = $millvl;
            $tanks = round($millvl / 10);
            $mines = $millvl;
            $trans = round($millvl / 5);
            $f16 = round($millvl / 20);
            $ac130 = round($millvl / 20);
            ?>
            <td class="spacer"></td>
            <td>

                <table><tr><td>
                <table>
                <form id="loginForm" name="purchase" method="get" action="./includes/train/do_train_mercs.php">
                <tr><td colspan="2">  <a href="javascript:void(0);" onmouseover="return overlib('Per tick: <?php echo $mercs; ?>', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '150');" onmouseout="return nd();" textstyle="none">Mercinaries</a></td></tr>
                                    <tr><td><input name="mercs" type="text" class="textfield" id="housing" />
                                            <input type="submit" name="Submit" value="Train" /></td></tr>
                                    <tr><td><img src="" height="17px" width="17px" onmouseover="return overlib('Money', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">$50
                                                <img src="../icons/vinyl-record-icon.jpg" height="17px" width="17px" onmouseover="return overlib('Culture', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();"  style="height:14px;">10
                                                    <img src="../icons/e84ba8be.png" height="17px" width="17px" onmouseover="return overlib('Goods', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">10</td></tr>

                                                        </form>
                                                        </table></td><td>
                                                            <table>
                                                                <form id="loginForm" name="purchase" method="get" action="./includes/train/do_train_tanks.php">
                                                                    <tr><td colspan="2"><a href="javascript:void(0);" onmouseover="return overlib('Per tick: <?php echo $tanks; ?>', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '150');" onmouseout="return nd();" textstyle="none">Tanks</a></td></tr>
                                                                    <tr><td><input name="tanks" type="text" class="textfield" id="housing" />
                                                                            <input type="submit" name="Submit" value="Train" /></td></tr>
                                                                    <tr><td><img src="" height="17px" width="17px" onmouseover="return overlib('Money', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">$5,000
                                                                                <img src="../icons/vinyl-record-icon.jpg" height="17px" width="17px" onmouseover="return overlib('Culture', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();"  style="height:14px;">1,000
                                                                                    <img src="../icons/e84ba8be.png" height="17px" width="17px" onmouseover="return overlib('Goods', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">1,000</td></tr>

                                                                                        </form>
                                                                                        </table></td><td>

                                                                                            <table>
                                                                                                <form id="loginForm" name="purchase" method="get" action="./includes/train/do_train_f16.php">
                                                                                                    <tr><td colspan="2"><a href="javascript:void(0);" onmouseover="return overlib('Per tick: <?php echo $f16; ?>', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '150');" onmouseout="return nd();" textstyle="none">F16 -- DOES NOT WORK YET!!</a></td></tr>
                                                                                                    <tr><td><input name="f16" type="text" class="textfield" id="housing" />
                                                                                                            <input type="submit" name="Submit" value="Train" /></td></tr>
                                                                                                    <tr><td><img src="" height="17px" width="17px" onmouseover="return overlib('Money', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">$50,000
                                                                                                                <img src="../icons/vinyl-record-icon.jpg" height="17px" width="17px" onmouseover="return overlib('Culture', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();"  style="height:14px;">10,000
                                                                                                                    <img src="../icons/e84ba8be.png" height="17px" width="17px" onmouseover="return overlib('Goods', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">10,000
                                                                                                                        <img src="../icons/Gold-Bar-icon.png" width="17px" height="17px" onmouseover="return overlib('Gold', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" >1</td></tr>
                                                                                                                            </form>
                                                                                                                            </table>


                                                                                                                            <td>                           <table>
                                                                                                                                    <form id="loginForm" name="purchase" method="get" action="./includes/train/do_train_mines.php">
                                                                                                                                        <tr><td colspan="2"><a href="javascript:void(0);" onmouseover="return overlib('Per tick: <?php echo $mines; ?>', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '150');" onmouseout="return nd();" textstyle="none">Mines</a></td></tr>
                                                                                                                                        <tr><td><input name="mines"" type="text" class="textfield" id="housing" />
                                                                                                                                                <input type="submit" name="Submit" value="Train" /></td></tr>
                                                                                                                                        <tr><td><img src="" height="17px" width="17px" onmouseover="return overlib('Money', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">$100
                                                                                                                                                    <img src="../icons/e84ba8be.png" height="17px" width="17px" onmouseover="return overlib('Goods', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">1000</td></tr>

                                                                                                                                                        </form>
                                                                                                                                                        </table> </td></tr>
                                                                                                                                                        <tr><td>
                                                                                                                                                                <table>
                                                                                                                                                                    <form id="loginForm" name="purchase" method="get" action="./includes/train/do_train.php">
                                                                                                                                                                        <tr><td colspan="2"><a href="javascript:void(0);" onmouseover="return overlib('Per tick: <?php echo $infantry; ?>', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '150');" onmouseout="return nd();" textstyle="none">Infantry</a></td></tr>
                                                                                                                                                                        <tr><td><input name="infantry" type="text" class="textfield" id="housing" />
                                                                                                                                                                                <input type="submit" name="Submit" value="Train" /></td></tr>
                                                                                                                                                                        <tr><td><img src="" height="17px" width="17px" onmouseover="return overlib('Money', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">$100
                                                                                                                                                                                    <img src="../icons/vinyl-record-icon.jpg" height="17px" width="17px" onmouseover="return overlib('Culture', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();"  style="height:14px;">50
                                                                                                                                                                                        <img src="../icons/e84ba8be.png" height="17px" width="17px" onmouseover="return overlib('Goods', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">50</td></tr>

                                                                                                                                                                                            </form>
                                                                                                                                                                                            </table></td><td>
                                                                                                                                                                                                <table>
                                                                                                                                                                                                    <form id="loginForm" name="purchase" method="get" action="./includes/train/do_train_trans.php">
                                                                                                                                                                                                        <tr><td colspan="2"><a href="javascript:void(0);" onmouseover="return overlib('Per tick: <?php echo $trans; ?>', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '150');" onmouseout="return nd();" textstyle="none">Transports</a></td></tr>
                                                                                                                                                                                                        <tr><td><input name="transports" type="text" class="textfield" id="housing" />
                                                                                                                                                                                                        <input type="submit" name="Submit" value="Train" /></td></tr>
                                                                                                                                                                                                        <tr><td><img src="" height="17px" width="17px" onmouseover="return overlib('Money', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">$5,000
                                                                                                                                                                                                        <img src="../icons/vinyl-record-icon.jpg" height="17px" width="17px" onmouseover="return overlib('Culture', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();"  style="height:14px;">1,000
                                                                                                                                                                                                        <img src="../icons/e84ba8be.png" height="17px" width="17px" onmouseover="return overlib('Goods', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">1,000</td></tr>

                                                                                                                                                                                                        </form>
                                                                                                                                                                                                        </table><td>                                                            
                                                                                                                                                                                                        <table>
                                                                                                                                                                                                        <form id="loginForm" name="purchase" method="get" action="./includes/train/do_train_ac130.php">
                                                                                                                                                                                                        <tr><td colspan="2"><a href="javascript:void(0);" onmouseover="return overlib('Per tick: <?php echo $ac130; ?>', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '150');" onmouseout="return nd();" textstyle="none">AC130 -- DOES NOT WORK YET!!</a></td></tr>
                                                                                                                                                                                                        <tr><td><input name="ac130" type="text" class="textfield" id="housing" />
                                                                                                                                                                                                        <input type="submit" name="Submit" value="Train" /></td></tr>
                                                                                                                                                                                                        <tr><td><img src="" height="17px" width="17px" onmouseover="return overlib('Money', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">$50,000
                                                                                                                                                                                                        <img src="../icons/vinyl-record-icon.jpg" height="17px" width="17px" onmouseover="return overlib('Culture', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();"  style="height:14px;">10,000
                                                                                                                                                                                                        <img src="../icons/e84ba8be.png" height="17px" width="17px" onmouseover="return overlib('Goods', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">10,000
                                                                                                                                                                                                        <img src="../icons/Gold-Bar-icon.png" width="17px" height="17px" onmouseover="return overlib('Gold', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" >1</td></tr>
                                                                                                                                                                                                        </form>
                                                                                                                                                                                                        </table></td><td>

                                                                                                                                                                                                        <table>
                                                                                                                                                                                                        <form id="loginForm" name="purchase" method="get" action="./includes/train/do_train_sat.php">
                                                                                                                                                                                                        <tr><td colspan="2"><a href="javascript:void(0);" onmouseover="return overlib('Per tick: Instant', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '150');" onmouseout="return nd();" textstyle="none">Spy Satellites</a></td></tr>
                                                                                                                                                                                                        <tr><td><input name="sat" type="text" class="textfield" id="housing" />
                                                                                                                                                                                                        <input type="submit" name="Submit" value="Train" /></td></tr>
                                                                                                                                                                                                        <tr><td><img src="" height="17px" width="17px" onmouseover="return overlib('Money', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">$5,000,000
                                                                                                                                                                                                        <img src="../icons/vinyl-record-icon.jpg" height="17px" width="17px" onmouseover="return overlib('Culture', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();"  style="height:14px;">1,000,000
                                                                                                                                                                                                        <img src="../icons/e84ba8be.png" height="17px" width="17px" onmouseover="return overlib('Goods', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">1,000,000</td></tr>

                                                                                                                                                                                                        </form>
                                                                                                                                                                                                        </table>

                                                                                                                                                                                                        </td></tr>

                                                                                                                                                                                                        <table>
                                                                                                                                                                                                        <form id="loginForm" name="purchase" method="get" action="./includes/train/do_train_spies.php">
                                                                                                                                                                                                        <tr><td colspan="2"><a href="javascript:void(0);" onmouseover="return overlib('Per tick: <?php echo $spies; ?>', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '150');" onmouseout="return nd();" textstyle="none">Spies</a></td></tr>
                                                                                                                                                                                                        <tr><td><input name="spies" type="text" class="textfield" id="housing" />
                                                                                                                                                                                                        <input type="submit" name="Submit" value="Train" /></td></tr>
                                                                                                                                                                                                        <tr><td><img src="" height="17px" width="17px" onmouseover="return overlib('Money', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">$200
                                                                                                                                                                                                        <img src="../icons/vinyl-record-icon.jpg" height="17px" width="17px" onmouseover="return overlib('Culture', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();"  style="height:14px;">50
                                                                                                                                                                                                        <img src="../icons/e84ba8be.png" height="17px" width="17px" onmouseover="return overlib('Goods', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3, WIDTH, '18');" onmouseout="return nd();" style="height:14px;">50</td></tr>

                                                                                                                                                                                                        </form>
                                                                                                                                                                                                        </table>






                                                                                                                                                                                                        </td></tr></table>    </td></tr></table>
                                                                                                                                                                                                        <script type="text/javascript" src="./overlib/overlib.js"><!-- overLIB (c) Erik Bosrup --></script>

<?php
echo "<table id=\"troopq\">";


$research_sql = mysql_query("SELECT * FROM research WHERE member_id='$id'", $db);
    echo "<tr><th colspan=\"5\">You produce $trooplevel in each barrack per tick.
                <a href=\"http://wiki.micronationsgame.com/index.php/military\" target=\"_blank\" >
                <img src=\"/icons/questionmark.png\" alt=\"help\" title=\"Help\"></a>
                </th></tr>";
    echo "<tr><th>Barrack</th><th>Amount</th><th>Type</th><th>Estimated Completetion</th><th></th></tr>";
    $qeue = "0";
while ($research = mysql_fetch_array($research_sql)) {
    $trooplevel = number_format($research['miltrainlvl']);
}
    $train_sql = mysql_query("SELECT * FROM training WHERE member_id='$id'", $db);
    while ($train = mysql_fetch_array($train_sql)) {


        $troops = number_format($train['troops']);
        $spies = number_format($train['spies']);
        $tanks = number_format($train['tanks']);
        $mercs = number_format($train['mercs']);

        $date = $train['done'];
        if ($train_sql) {
            if (mysql_num_rows($train_sql) < 0) {
                echo "";
            } 
            //else {
                if ($spies > 0) {
                    $qeue = $qeue + "1";
                    echo "<tr><td>$qeue</td><td>$spies</td><td><img src=\"/icons/p5compct.gif\" height=\"35px\" width=\"42px\" onmouseover=\"return overlib('Spies', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3);\" onmouseout=\"return nd()\";></td><td>$date</td><td>";
                    ?>

                                                                                                                                                                                                                            <script language="JavaScript">
                    <?php
                    /*
                      Author: Robert Hashemian
                      http://www.hashemian.com/

                      You can use this code in any manner so long as the author's
                      name, Web address and this disclaimer is kept intact.
                     * *******************************************************
                     * 
                     */
                    ?>
                                                                                                                                                                     
                                                                                                                                                                                                                            TargetDate = "<?php echo $date; ?>";
                                                                                                                                                                                                                            BackColor = "white";
                                                                                                                                                                                                                            ForeColor = "black";
                                                                                                                                                                                                                            CountActive = true;
                                                                                                                                                                                                                            CountStepper = -1;
                                                                                                                                                                                                                            LeadingZero = true;
                                                                                                                                                                                                                            DisplayFormat<?php echo $qeue; ?> = "Days: %%D%% Hours: %%H%% Minutes: %%M%% Seconds: %%S%%";
                                                                                                                                                                                                                            FinishMessage<?php echo $qeue; ?> = "Qeue free at next tick.";
                                                                                                                                                                                                                            function calcage<?php echo $qeue; ?>(secs, num1, num2) {
                                                                                                                                                                                                                            s = ((Math.floor(secs/num1))%num2).toString();
                                                                                                                                                                                                                            if (LeadingZero && s.length < 2)
                                                                                                                                                                                                                            s = "0" + s;
                                                                                                                                                                                                                            return "<b>" + s + "</b>";
                                                                                                                                                                                                                            }
                                                                                                                                                                    
                                                                                                                                                                                                                            function CountBack<?php echo $qeue; ?>(secs) {
                                                                                                                                                                                                                            if (secs < 0) {
                                                                                                                                                                                                                            document.getElementById("cntdwn<?php echo $qeue; ?>").innerHTML = FinishMessage<?php echo $qeue; ?>;
                                                                                                                                                                                                                            return;
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                            DisplayStr = DisplayFormat<?php echo $qeue; ?>.replace(/%%D%%/g, calcage<?php echo $qeue; ?>(secs,86400,100000));
                                                                                                                                                                                                                            DisplayStr = DisplayStr.replace(/%%H%%/g, calcage<?php echo $qeue; ?>(secs,3600,24));
                                                                                                                                                                                                                            DisplayStr = DisplayStr.replace(/%%M%%/g, calcage<?php echo $qeue; ?>(secs,60,60));
                                                                                                                                                                                                                            DisplayStr = DisplayStr.replace(/%%S%%/g, calcage<?php echo $qeue; ?>(secs,1,60));
                                                                                                                                                                        
                                                                                                                                                                                                                            document.getElementById("cntdwn<?php echo $qeue; ?>").innerHTML = DisplayStr;
                                                                                                                                                                                                                            if (CountActive)
                                                                                                                                                                                                                            setTimeout("CountBack<?php echo $qeue; ?>(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
                                                                                                                                                                                                                            }
                                                                                                                                                                    
                                                                                                                                                                                                                            function putspan<?php echo $qeue; ?>(backcolor, forecolor) {
                                                                                                                                                                                                                            document.write("<span id='cntdwn<?php echo $qeue; ?>' style='font-size: 12px; padding: 4px 7px 2px; vertical-align: top;'></span>");
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
                                                                                                                                                                                                                            putspan<?php echo $qeue; ?>(BackColor, ForeColor);
                                                                                                                                                                                                                            var dthen = new Date(TargetDate);
                                                                                                                                                                                                                            var dnow = new Date(); 
                                                                                                                                                                    
                                                                                                                                                                                                                            if(CountStepper>0)
                                                                                                                                                                                                                            ddiff = new Date(dnow-dthen);
                                                                                                                                                                                                                            else
                                                                                                                                                                                                                            ddiff = new Date(dthen-dnow);
                                                                                                                                                                                                                            gsecs = Math.floor(ddiff.valueOf()/1000);
                                                                                                                                                                                                                            CountBack<?php echo $qeue; ?>(gsecs);
                                                                                                                                                                    
                                                                                                                                                                                                                            </script>




                    <?php
                    echo "</td></tr>";
                }
                if ($troops > 0) {
                    $qeue = $qeue + "1";
                    echo "<tr><td>$qeue</td><td>$troops</td><td><img width=\"82px\" height=\"30px\"src=\"/icons/m16.gif\" onmouseover=\"return overlib('Infantry', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3);\" onmouseout=\"return nd();\"></td><td>$date<td>";
                    ?>

                                                                                                                                                                                                                            <script language="JavaScript">
                    <?php
                    /*
                      Author: Robert Hashemian
                      http://www.hashemian.com/

                      You can use this code in any manner so long as the author's
                      name, Web address and this disclaimer is kept intact.
                     * *******************************************************
                     * 
                     */
                    ?>
                                                                                                                                                                                                                            TargetDate = "<?php echo $date; ?>";
                                                                                                                                                                                                                            BackColor = "white";
                                                                                                                                                                                                                            ForeColor = "black";
                                                                                                                                                                                                                            CountActive = true;
                                                                                                                                                                                                                            CountStepper = -1;
                                                                                                                                                                                                                            LeadingZero = true;
                                                                                                                                                                                                                            DisplayFormat<?php echo $qeue; ?> = "Days: %%D%% Hours: %%H%% Minutes: %%M%% Seconds: %%S%%";
                                                                                                                                                                                                                            FinishMessage<?php echo $qeue; ?> = "Qeue free at next tick.";
                                                                                                                                                                                                                            function calcage<?php echo $qeue; ?>(secs, num1, num2) {
                                                                                                                                                                                                                            s = ((Math.floor(secs/num1))%num2).toString();
                                                                                                                                                                                                                            if (LeadingZero && s.length < 2)
                                                                                                                                                                                                                            s = "0" + s;
                                                                                                                                                                                                                            return "<b>" + s + "</b>";
                                                                                                                                                                                                                            }
                                                                                                                                                                    
                                                                                                                                                                                                                            function CountBack<?php echo $qeue; ?>(secs) {
                                                                                                                                                                                                                            if (secs < 0) {
                                                                                                                                                                                                                            document.getElementById("cntdwn<?php echo $qeue; ?>").innerHTML = FinishMessage<?php echo $qeue; ?>;
                                                                                                                                                                                                                            return;
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                            DisplayStr = DisplayFormat<?php echo $qeue; ?>.replace(/%%D%%/g, calcage<?php echo $qeue; ?>(secs,86400,100000));
                                                                                                                                                                                                                            DisplayStr = DisplayStr.replace(/%%H%%/g, calcage<?php echo $qeue; ?>(secs,3600,24));
                                                                                                                                                                                                                            DisplayStr = DisplayStr.replace(/%%M%%/g, calcage<?php echo $qeue; ?>(secs,60,60));
                                                                                                                                                                                                                            DisplayStr = DisplayStr.replace(/%%S%%/g, calcage<?php echo $qeue; ?>(secs,1,60));
                                                                                                                                                                        
                                                                                                                                                                                                                            document.getElementById("cntdwn<?php echo $qeue; ?>").innerHTML = DisplayStr;
                                                                                                                                                                                                                            if (CountActive)
                                                                                                                                                                                                                            setTimeout("CountBack<?php echo $qeue; ?>(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
                                                                                                                                                                                                                            }
                                                                                                                                                                    
                                                                                                                                                                                                                            function putspan<?php echo $qeue; ?>(backcolor, forecolor) {
                                                                                                                                                                                                                            document.write("<span id='cntdwn<?php echo $qeue; ?>' style='font-size: 12px; padding: 4px 7px 2px; vertical-align: top;'></span>");

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
                                                                                                                                                                                                                            putspan<?php echo $qeue; ?>(BackColor, ForeColor);
                                                                                                                                                                                                                            var dthen = new Date(TargetDate);
                                                                                                                                                                                                                            var dnow = new Date(); 
                                                                                                                                                                    
                                                                                                                                                                                                                            if(CountStepper>0)
                                                                                                                                                                                                                            ddiff = new Date(dnow-dthen);
                                                                                                                                                                                                                            else
                                                                                                                                                                                                                            ddiff = new Date(dthen-dnow);
                                                                                                                                                                                                                            gsecs = Math.floor(ddiff.valueOf()/1000);
                                                                                                                                                                                                                            CountBack<?php echo $qeue; ?>(gsecs);
                                                                                                                                                                    
                                                                                                                                                                                                                            </script>

                    <?php
                    echo "</td></tr>";
                }
                if ($tanks > 0) {
                    $qeue = $qeue + "1";
                    echo "<tr><td>$qeue</td><td>$tanks</td><td><img width=\"82px\" height=\"32px\" src=\"http://www.sam.hi-ho.ne.jp/t_fukuda/miritari/3totug.gif\" onmouseover=\"return overlib('Tanks', FGCOLOR, '#999999', BGCOLOR, '#333333', TEXTSIZE, 3);\" onmouseout=\"return nd()\";></td><td>$date<td>";
                    ?>

                                                                                                                                                                                                                            <script language="JavaScript">
                    <?php
                    /*
                      Author: Robert Hashemian
                      http://www.hashemian.com/

                      You can use this code in any manner so long as the author's
                      name, Web address and this disclaimer is kept intact.
                     * *******************************************************
                     * 
                     */
                    ?>
                                                                                                                                                                                                                            TargetDate = "<?php echo $date; ?>";
                                                                                                                                                                                                                            BackColor = "white";
                                                                                                                                                                                                                            ForeColor = "black";
                                                                                                                                                                                                                            CountActive = true;
                                                                                                                                                                                                                            CountStepper = -1;
                                                                                                                                                                                                                            LeadingZero = true;
                                                                                                                                                                                                                            DisplayFormat<?php echo $qeue; ?> = "Days: %%D%% Hours: %%H%% Minutes: %%M%% Seconds: %%S%%";
                                                                                                                                                                                                                            FinishMessage<?php echo $qeue; ?> = "Qeue free at next tick.";
                                                                                                                                                                                                                            function calcage<?php echo $qeue; ?>(secs, num1, num2) {
                                                                                                                                                                                                                            s = ((Math.floor(secs/num1))%num2).toString();
                                                                                                                                                                                                                            if (LeadingZero && s.length < 2)
                                                                                                                                                                                                                            s = "0" + s;
                                                                                                                                                                                                                            return "<b>" + s + "</b>";
                                                                                                                                                                                                                            }
                                                                                                                                                                    
                                                                                                                                                                                                                            function CountBack<?php echo $qeue; ?>(secs) {
                                                                                                                                                                                                                            if (secs < 0) {
                                                                                                                                                                                                                            document.getElementById("cntdwn<?php echo $qeue; ?>").innerHTML = FinishMessage<?php echo $qeue; ?>;
                                                                                                                                                                                                                            return;
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                            DisplayStr = DisplayFormat<?php echo $qeue; ?>.replace(/%%D%%/g, calcage<?php echo $qeue; ?>(secs,86400,100000));
                                                                                                                                                                                                                            DisplayStr = DisplayStr.replace(/%%H%%/g, calcage<?php echo $qeue; ?>(secs,3600,24));
                                                                                                                                                                                                                            DisplayStr = DisplayStr.replace(/%%M%%/g, calcage<?php echo $qeue; ?>(secs,60,60));
                                                                                                                                                                                                                            DisplayStr = DisplayStr.replace(/%%S%%/g, calcage<?php echo $qeue; ?>(secs,1,60));
                                                                                                                                                                        
                                                                                                                                                                                                                            document.getElementById("cntdwn<?php echo $qeue; ?>").innerHTML = DisplayStr;
                                                                                                                                                                                                                            if (CountActive)
                                                                                                                                                                                                                            setTimeout("CountBack<?php echo $qeue; ?>(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
                                                                                                                                                                                                                            }
                                                                                                                                                                    
                                                                                                                                                                                                                            function putspan<?php echo $qeue; ?>(backcolor, forecolor) {
                                                                                                                                                                                                                            document.write("<span id='cntdwn<?php echo $qeue; ?>' style='font-size: 12px; padding: 4px 7px 2px; vertical-align: top;'></span>");

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
                                                                                                                                                                                                                            putspan<?php echo $qeue; ?>(BackColor, ForeColor);
                                                                                                                                                                                                                            var dthen = new Date(TargetDate);
                                                                                                                                                                                                                            var dnow = new Date(); 
                                                                                                                                                                    
                                                                                                                                                                                                                            if(CountStepper>0)
                                                                                                                                                                                                                            ddiff = new Date(dnow-dthen);
                                                                                                                                                                                                                            else
                                                                                                                                                                                                                            ddiff = new Date(dthen-dnow);
                                                                                                                                                                                                                            gsecs = Math.floor(ddiff.valueOf()/1000);
                                                                                                                                                                                                                            CountBack<?php echo $qeue; ?>(gsecs);
                                                                                                                                                                    
                                                                                                                                                                                                                            </script>

                    <?php
                    echo "</td></tr>";
                }

                if ($mercs > 0) {
                    $qeue = $qeue + "1";
                    echo "<tr><td>$qeue</td><td>$mercs</td><td>Mercs</td><td>$date<td>";
                    ?>

                                                                                                                                                                                                                            <script language="JavaScript">
                    <?php
                    /*
                      Author: Robert Hashemian
                      http://www.hashemian.com/

                      You can use this code in any manner so long as the author's
                      name, Web address and this disclaimer is kept intact.
                     * *******************************************************
                     * 
                     */
                    ?>
                                                                                                                                                                                                                            TargetDate = "<?php echo $date; ?>";
                                                                                                                                                                                                                            BackColor = "white";
                                                                                                                                                                                                                            ForeColor = "black";
                                                                                                                                                                                                                            CountActive = true;
                                                                                                                                                                                                                            CountStepper = -1;
                                                                                                                                                                                                                            LeadingZero = true;
                                                                                                                                                                                                                            DisplayFormat<?php echo $qeue; ?> = "Days: %%D%% Hours: %%H%% Minutes: %%M%% Seconds: %%S%%";
                                                                                                                                                                                                                            FinishMessage<?php echo $qeue; ?> = "Qeue free at next tick.";
                                                                                                                                                                                                                            function calcage<?php echo $qeue; ?>(secs, num1, num2) {
                                                                                                                                                                                                                            s = ((Math.floor(secs/num1))%num2).toString();
                                                                                                                                                                                                                            if (LeadingZero && s.length < 2)
                                                                                                                                                                                                                            s = "0" + s;
                                                                                                                                                                                                                            return "<b>" + s + "</b>";
                                                                                                                                                                                                                            }
                                                                                                                                                                            
                                                                                                                                                                                                                            function CountBack<?php echo $qeue; ?>(secs) {
                                                                                                                                                                                                                            if (secs < 0) {
                                                                                                                                                                                                                            document.getElementById("cntdwn<?php echo $qeue; ?>").innerHTML = FinishMessage<?php echo $qeue; ?>;
                                                                                                                                                                                                                            return;
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                            DisplayStr = DisplayFormat<?php echo $qeue; ?>.replace(/%%D%%/g, calcage<?php echo $qeue; ?>(secs,86400,100000));
                                                                                                                                                                                                                            DisplayStr = DisplayStr.replace(/%%H%%/g, calcage<?php echo $qeue; ?>(secs,3600,24));
                                                                                                                                                                                                                            DisplayStr = DisplayStr.replace(/%%M%%/g, calcage<?php echo $qeue; ?>(secs,60,60));
                                                                                                                                                                                                                            DisplayStr = DisplayStr.replace(/%%S%%/g, calcage<?php echo $qeue; ?>(secs,1,60));
                                                                                                                                                                                
                                                                                                                                                                                                                            document.getElementById("cntdwn<?php echo $qeue; ?>").innerHTML = DisplayStr;
                                                                                                                                                                                                                            if (CountActive)
                                                                                                                                                                                                                            setTimeout("CountBack<?php echo $qeue; ?>(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
                                                                                                                                                                                                                            }
                                                                                                                                                                            
                                                                                                                                                                                                                            function putspan<?php echo $qeue; ?>(backcolor, forecolor) {
                                                                                                                                                                                                                            document.write("<span id='cntdwn<?php echo $qeue; ?>' style='font-size: 12px; padding: 4px 7px 2px; vertical-align: top;'></span>");

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
                                                                                                                                                                                                                            putspan<?php echo $qeue; ?>(BackColor, ForeColor);
                                                                                                                                                                                                                            var dthen = new Date(TargetDate);
                                                                                                                                                                                                                            var dnow = new Date(); 
                                                                                                                                                                            
                                                                                                                                                                                                                            if(CountStepper>0)
                                                                                                                                                                                                                            ddiff = new Date(dnow-dthen);
                                                                                                                                                                                                                            else
                                                                                                                                                                                                                            ddiff = new Date(dthen-dnow);
                                                                                                                                                                                                                            gsecs = Math.floor(ddiff.valueOf()/1000);
                                                                                                                                                                                                                            CountBack<?php echo $qeue; ?>(gsecs);
                                                                                                                                                                            
                                                                                                                                                                                                                            </script>

                    <?php
                    echo "</td></tr>";
                }
            }
        }
//    }
//}
$minessql = mysql_query("SELECT * FROM trainmines WHERE member_id = '$id'", $db);
while ($mines = mysql_fetch_array($minessql)) {
    $minecount = $mines['mines'];
    $minedate = $mines['date'];
    if ($minecount > 0) {
        $qeue = $qeue + "1";
        echo "<tr><td>$qeue</td><td>$minecount</td><td>Mines</td><td>$minedate<td>";
        ?>

                                                                                                                                                                                                                <script language="JavaScript">
        <?php
        /*
          Author: Robert Hashemian
          http://www.hashemian.com/

          You can use this code in any manner so long as the author's
          name, Web address and this disclaimer is kept intact.
         * *******************************************************
         * 
         */
        ?>
                                                                                                                                                                                                                TargetDate = "<?php echo $minedate; ?>";
                                                                                                                                                                                                                BackColor = "white";
                                                                                                                                                                                                                ForeColor = "black";
                                                                                                                                                                                                                CountActive = true;
                                                                                                                                                                                                                CountStepper = -1;
                                                                                                                                                                                                                LeadingZero = true;
                                                                                                                                                                                                                DisplayFormat<?php echo $qeue; ?> = "Days: %%D%% Hours: %%H%% Minutes: %%M%% Seconds: %%S%%";
                                                                                                                                                                                                                FinishMessage<?php echo $qeue; ?> = "Qeue free at next tick.";
                                                                                                                                                                                                                function calcage<?php echo $qeue; ?>(secs, num1, num2) {
                                                                                                                                                                                                                s = ((Math.floor(secs/num1))%num2).toString();
                                                                                                                                                                                                                if (LeadingZero && s.length < 2)
                                                                                                                                                                                                                s = "0" + s;
                                                                                                                                                                                                                return "<b>" + s + "</b>";
                                                                                                                                                                                                                }
                                                                                                                                                                                    
                                                                                                                                                                                                                function CountBack<?php echo $qeue; ?>(secs) {
                                                                                                                                                                                                                if (secs < 0) {
                                                                                                                                                                                                                document.getElementById("cntdwn<?php echo $qeue; ?>").innerHTML = FinishMessage<?php echo $qeue; ?>;
                                                                                                                                                                                                                return;
                                                                                                                                                                                                                }
                                                                                                                                                                                                                DisplayStr = DisplayFormat<?php echo $qeue; ?>.replace(/%%D%%/g, calcage<?php echo $qeue; ?>(secs,86400,100000));
                                                                                                                                                                                                                DisplayStr = DisplayStr.replace(/%%H%%/g, calcage<?php echo $qeue; ?>(secs,3600,24));
                                                                                                                                                                                                                DisplayStr = DisplayStr.replace(/%%M%%/g, calcage<?php echo $qeue; ?>(secs,60,60));
                                                                                                                                                                                                                DisplayStr = DisplayStr.replace(/%%S%%/g, calcage<?php echo $qeue; ?>(secs,1,60));
                                                                                                                                                                                        
                                                                                                                                                                                                                document.getElementById("cntdwn<?php echo $qeue; ?>").innerHTML = DisplayStr;
                                                                                                                                                                                                                if (CountActive)
                                                                                                                                                                                                                setTimeout("CountBack<?php echo $qeue; ?>(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
                                                                                                                                                                                                                }
                                                                                                                                                                                    
                                                                                                                                                                                                                function putspan<?php echo $qeue; ?>(backcolor, forecolor) {
                                                                                                                                                                                                                document.write("<span id='cntdwn<?php echo $qeue; ?>' style='font-size: 12px; padding: 4px 7px 2px; vertical-align: top;'></span>");

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
                                                                                                                                                                                                                putspan<?php echo $qeue; ?>(BackColor, ForeColor);
                                                                                                                                                                                                                var dthen = new Date(TargetDate);
                                                                                                                                                                                                                var dnow = new Date(); 
                                                                                                                                                                                    
                                                                                                                                                                                                                if(CountStepper>0)
                                                                                                                                                                                                                ddiff = new Date(dnow-dthen);
                                                                                                                                                                                                                else
                                                                                                                                                                                                                ddiff = new Date(dthen-dnow);
                                                                                                                                                                                                                gsecs = Math.floor(ddiff.valueOf()/1000);
                                                                                                                                                                                                                CountBack<?php echo $qeue; ?>(gsecs);
                                                                                                                                                                            
                                                                                                                                                                                                                </script>
        <?php
        echo "</td></tr>";
    }
}
$transsql = mysql_query("SELECT * FROM traintrans WHERE member_id = '$id'", $db);
while ($trans = mysql_fetch_array($transsql)) {
    $transcount = $trans['transports'];
    $transdate = $trans['date'];
    if ($transcount > 0) {
        $qeue = $qeue + "1";
        echo "<tr><td>$qeue</td><td>$transcount</td><td>Transports</td><td>$transdate<td>";
        ?>

                                                                                                                                                                                                                <script language="JavaScript">
        <?php
        /*
          Author: Robert Hashemian
          http://www.hashemian.com/

          You can use this code in any manner so long as the author's
          name, Web address and this disclaimer is kept intact.
         * *******************************************************
         * 
         */
        ?>
                                                                                                                                                                                                                TargetDate = "<?php echo $transdate; ?>";
                                                                                                                                                                                                                BackColor = "white";
                                                                                                                                                                                                                ForeColor = "black";
                                                                                                                                                                                                                CountActive = true;
                                                                                                                                                                                                                CountStepper = -1;
                                                                                                                                                                                                                LeadingZero = true;
                                                                                                                                                                                                                DisplayFormat<?php echo $qeue; ?> = "Days: %%D%% Hours: %%H%% Minutes: %%M%% Seconds: %%S%%";
                                                                                                                                                                                                                FinishMessage<?php echo $qeue; ?> = "Qeue free at next tick.";
                                                                                                                                                                                                                function calcage<?php echo $qeue; ?>(secs, num1, num2) {
                                                                                                                                                                                                                s = ((Math.floor(secs/num1))%num2).toString();
                                                                                                                                                                                                                if (LeadingZero && s.length < 2)
                                                                                                                                                                                                                s = "0" + s;
                                                                                                                                                                                                                return "<b>" + s + "</b>";
                                                                                                                                                                                                                }
                                                                                                                                                                                    
                                                                                                                                                                                                                function CountBack<?php echo $qeue; ?>(secs) {
                                                                                                                                                                                                                if (secs < 0) {
                                                                                                                                                                                                                document.getElementById("cntdwn<?php echo $qeue; ?>").innerHTML = FinishMessage<?php echo $qeue; ?>;
                                                                                                                                                                                                                return;
                                                                                                                                                                                                                }
                                                                                                                                                                                                                DisplayStr = DisplayFormat<?php echo $qeue; ?>.replace(/%%D%%/g, calcage<?php echo $qeue; ?>(secs,86400,100000));
                                                                                                                                                                                                                DisplayStr = DisplayStr.replace(/%%H%%/g, calcage<?php echo $qeue; ?>(secs,3600,24));
                                                                                                                                                                                                                DisplayStr = DisplayStr.replace(/%%M%%/g, calcage<?php echo $qeue; ?>(secs,60,60));
                                                                                                                                                                                                                DisplayStr = DisplayStr.replace(/%%S%%/g, calcage<?php echo $qeue; ?>(secs,1,60));
                                                                                                                                                                                        
                                                                                                                                                                                                                document.getElementById("cntdwn<?php echo $qeue; ?>").innerHTML = DisplayStr;
                                                                                                                                                                                                                if (CountActive)
                                                                                                                                                                                                                setTimeout("CountBack<?php echo $qeue; ?>(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
                                                                                                                                                                                                                }
                                                                                                                                                                                    
                                                                                                                                                                                                                function putspan<?php echo $qeue; ?>(backcolor, forecolor) {
                                                                                                                                                                                                                document.write("<span id='cntdwn<?php echo $qeue; ?>' style='font-size: 12px; padding: 4px 7px 2px; vertical-align: top;'></span>");

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
                                                                                                                                                                                                                putspan<?php echo $qeue; ?>(BackColor, ForeColor);
                                                                                                                                                                                                                var dthen = new Date(TargetDate);
                                                                                                                                                                                                                var dnow = new Date(); 
                                                                                                                                                                                    
                                                                                                                                                                                                                if(CountStepper>0)
                                                                                                                                                                                                                ddiff = new Date(dnow-dthen);
                                                                                                                                                                                                                else
                                                                                                                                                                                                                ddiff = new Date(dthen-dnow);
                                                                                                                                                                                                                gsecs = Math.floor(ddiff.valueOf()/1000);
                                                                                                                                                                                                                CountBack<?php echo $qeue; ?>(gsecs);
                                                                                                                                                                            
                                                                                                                                                                                                                </script>
        <?php
        echo "</td></tr>";
    }
}



echo "<table id=\"troopq\">";



echo "<tr><th colspan=\"5\">You produce $trooplevel in each hanger per tick.
                <a href=\"http://wiki.micronationsgame.com/index.php/military\" target=\"_blank\" >
                <img src=\"/icons/questionmark.png\" alt=\"help\" title=\"Help\"></a>
                </th></tr>";
echo "<tr><th>hanger</th><th>Amount</th><th>Type</th><th>Estimated Completetion</th><th></th></tr>";
$qeue = "0";
$f16_sql = mysql_query("SELECT * FROM trainf16 WHERE member_id='$id'", $db);
while ($train_f16 = mysql_fetch_array($f16_sql)) {


    $f16 = number_format($train_f16['f16']);


    $date = $train_f16['date'];
    if ($f16_sql) {
        if (mysql_num_rows($f16_sql) < 0) {
            echo "";
        } else {
            if ($f16 > 0) {
                $qeue = $qeue + "1";
                echo "<tr><td>$qeue</td><td>$f16</td><td>F16's</td><td>$date</td><td>";
                ?>

                                                                                                                                                                                                                        <script language="JavaScript">
                <?php
                /*
                  Author: Robert Hashemian
                  http://www.hashemian.com/

                  You can use this code in any manner so long as the author's
                  name, Web address and this disclaimer is kept intact.
                 * *******************************************************
                 * 
                 */
                ?>
                                                                                                                                                                                                                        TargetDate = "<?php echo $date; ?>";
                                                                                                                                                                                                                        BackColor = "white";
                                                                                                                                                                                                                        ForeColor = "black";
                                                                                                                                                                                                                        CountActive = true;
                                                                                                                                                                                                                        CountStepper = -1;
                                                                                                                                                                                                                        LeadingZero = true;
                                                                                                                                                                                                                        DisplayFormata<?php echo $qeue; ?> = "Days: %%D%% Hours: %%H%% Minutes: %%M%% Seconds: %%S%%";
                                                                                                                                                                                                                        FinishMessagea<?php echo $qeue; ?> = "Qeue free at next tick.";
                                                                                                                                                                                                                        function calcagea<?php echo $qeue; ?>(secs, num1, num2) {
                                                                                                                                                                                                                        s = ((Math.floor(secs/num1))%num2).toString();
                                                                                                                                                                                                                        if (LeadingZero && s.length < 2)
                                                                                                                                                                                                                        s = "0" + s;
                                                                                                                                                                                                                        return "<b>" + s + "</b>";
                                                                                                                                                                                                                        }
                                                                                                                                                                                            
                                                                                                                                                                                                                        function CountBacka<?php echo $qeue; ?>(secs) {
                                                                                                                                                                                                                        if (secs < 0) {
                                                                                                                                                                                                                        document.getElementById("hanger<?php echo $qeue; ?>").innerHTML = FinishMessagea<?php echo $qeue; ?>;
                                                                                                                                                                                                                        return;
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                        DisplayStr = DisplayFormata<?php echo $qeue; ?>.replace(/%%D%%/g, calcagea<?php echo $qeue; ?>(secs,86400,100000));
                                                                                                                                                                                                                        DisplayStr = DisplayStr.replace(/%%H%%/g, calcagea<?php echo $qeue; ?>(secs,3600,24));
                                                                                                                                                                                                                        DisplayStr = DisplayStr.replace(/%%M%%/g, calcagea<?php echo $qeue; ?>(secs,60,60));
                                                                                                                                                                                                                        DisplayStr = DisplayStr.replace(/%%S%%/g, calcagea<?php echo $qeue; ?>(secs,1,60));
                                                                                                                                                                                                
                                                                                                                                                                                                                        document.getElementById("hanger<?php echo $qeue; ?>").innerHTML = DisplayStr;
                                                                                                                                                                                                                        if (CountActive)
                                                                                                                                                                                                                        setTimeout("CountBacka<?php echo $qeue; ?>(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
                                                                                                                                                                                                                        }
                                                                                                                                                                                            
                                                                                                                                                                                                                        function putspana<?php echo $qeue; ?>(backcolor, forecolor) {
                                                                                                                                                                                                                        document.write("<span id='hanger<?php echo $qeue; ?>' style='font-size: 12px; padding: 4px 7px 2px; vertical-align: top;'></span>");

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
                                                                                                                                                                                                                        putspana<?php echo $qeue; ?>(BackColor, ForeColor);
                                                                                                                                                                                                                        var dthen = new Date(TargetDate);
                                                                                                                                                                                                                        var dnow = new Date(); 
                                                                                                                                                                                            
                                                                                                                                                                                                                        if(CountStepper>0)
                                                                                                                                                                                                                        ddiff = new Date(dnow-dthen);
                                                                                                                                                                                                                        else
                                                                                                                                                                                                                        ddiff = new Date(dthen-dnow);
                                                                                                                                                                                                                        gsecs = Math.floor(ddiff.valueOf()/1000);
                                                                                                                                                                                                                        CountBacka<?php echo $qeue; ?>(gsecs);
                                                                                                                                                                                    
                                                                                                                                                                                                                        </script>
                <?php
                echo "</td></tr>";
            }
        }
    }
}

    $train_sql = mysql_query("SELECT * FROM trainac130 WHERE member_id = '$id'", $db);
    while ($train = mysql_fetch_array($train_sql)) {


        $ac130 = number_format($train['ac130']);


        $date = $train['date'];
        if ($train_sql) {
            if (mysql_num_rows($train_sql) < 0) {
                echo "<tr><td>Empty</td></tr>";
            } else {
                if ($ac130 > 0) {
                    $qeue = $qeue + "1";
                    echo "<tr><td>$qeue</td><td>$ac130</td><td>AC130's</td><td>$date</td><td>";
                    ?>

                                                                                                                                                                                                                            <script language="JavaScript">
                    <?php
                    /*
                      Author: Robert Hashemian
                      http://www.hashemian.com/

                      You can use this code in any manner so long as the author's
                      name, Web address and this disclaimer is kept intact.
                     * *******************************************************
                     * 
                     */
                    ?>
                                                                                                                                                                                                                            TargetDate = "<?php echo $date; ?>";
                                                                                                                                                                                                                            BackColor = "white";
                                                                                                                                                                                                                            ForeColor = "black";
                                                                                                                                                                                                                            CountActive = true;
                                                                                                                                                                                                                            CountStepper = -1;
                                                                                                                                                                                                                            LeadingZero = true;
                                                                                                                                                                                                                            DisplayFormata<?php echo $qeue; ?> = "Days: %%D%% Hours: %%H%% Minutes: %%M%% Seconds: %%S%%";
                                                                                                                                                                                                                            FinishMessagea<?php echo $qeue; ?> = "Qeue free at next tick.";
                                                                                                                                                                                                                            function calcagea<?php echo $qeue; ?>(secs, num1, num2) {
                                                                                                                                                                                                                            s = ((Math.floor(secs/num1))%num2).toString();
                                                                                                                                                                                                                            if (LeadingZero && s.length < 2)
                                                                                                                                                                                                                            s = "0" + s;
                                                                                                                                                                                                                            return "<b>" + s + "</b>";
                                                                                                                                                                                                                            }
                                                                                                                                                                                                
                                                                                                                                                                                                                            function CountBacka<?php echo $qeue; ?>(secs) {
                                                                                                                                                                                                                            if (secs < 0) {
                                                                                                                                                                                                                            document.getElementById("hanger<?php echo $qeue; ?>").innerHTML = FinishMessagea<?php echo $qeue; ?>;
                                                                                                                                                                                                                            return;
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                            DisplayStr = DisplayFormata<?php echo $qeue; ?>.replace(/%%D%%/g, calcagea<?php echo $qeue; ?>(secs,86400,100000));
                                                                                                                                                                                                                            DisplayStr = DisplayStr.replace(/%%H%%/g, calcagea<?php echo $qeue; ?>(secs,3600,24));
                                                                                                                                                                                                                            DisplayStr = DisplayStr.replace(/%%M%%/g, calcagea<?php echo $qeue; ?>(secs,60,60));
                                                                                                                                                                                                                            DisplayStr = DisplayStr.replace(/%%S%%/g, calcagea<?php echo $qeue; ?>(secs,1,60));
                                                                                                                                                                                                    
                                                                                                                                                                                                                            document.getElementById("hanger<?php echo $qeue; ?>").innerHTML = DisplayStr;
                                                                                                                                                                                                                            if (CountActive)
                                                                                                                                                                                                                            setTimeout("CountBacka<?php echo $qeue; ?>(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
                                                                                                                                                                                                                            }
                                                                                                                                                                                                
                                                                                                                                                                                                                            function putspana<?php echo $qeue; ?>(backcolor, forecolor) {
                                                                                                                                                                                                                            document.write("<span id='hanger<?php echo $qeue; ?>' style='font-size: 12px; padding: 4px 7px 2px; vertical-align: top;'></span>");

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
                                                                                                                                                                                                                            putspana<?php echo $qeue; ?>(BackColor, ForeColor);
                                                                                                                                                                                                                            var dthen = new Date(TargetDate);
                                                                                                                                                                                                                            var dnow = new Date(); 
                                                                                                                                                                                                
                                                                                                                                                                                                                            if(CountStepper>0)
                                                                                                                                                                                                                            ddiff = new Date(dnow-dthen);
                                                                                                                                                                                                                            else
                                                                                                                                                                                                                            ddiff = new Date(dthen-dnow);
                                                                                                                                                                                                                            gsecs = Math.floor(ddiff.valueOf()/1000);
                                                                                                                                                                                                                            CountBacka<?php echo $qeue; ?>(gsecs);
                                                                                                                                                                                        
                                                                                                                                                                                                                            </script>
                    <?php
                    echo "</td></tr>";
                }
            }
        }

    }





        echo "</table>";
        include("$directory/includes/misc/online.php");
        echo "</div>";

        include("$directory/includes/misc/footer.php");
        ?>
                                                                                                                                                                                                        </body>
                                                                                                                                                                                                        </html>
