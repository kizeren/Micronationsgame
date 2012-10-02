<?php        include('/home/nations/public_html/beta/config.php');

        require_once("$directory/includes/config/auth.php");
include("$directory/includes/misc/include.php");

                $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
        $admin_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);
        while($admin_row = mysql_fetch_array($admin_sql))
                if($admin_row[25] < 4)
                {
                    header("location: ../member-index.php");
                }


echo "<html>";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />";
echo "<title>Admin: Multi-Hunt</title>";
echo "<link href=\"../loginmodule.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "</head>";
echo "<body><div id\"banner\">";
echo "<h1>Welcome";
echo $_SESSION['SESS_LOGIN'];
echo " to ";
echo $game_name; 
echo "<img src=\"http://mcbride.homelinux.net/~nations/flags/beta_icon.gif\"></h1>";
include("../clock.php");
echo "</div>";
include("newmenu.php");
echo "<div id=\"main\">";
include("infomsg.php");
echo "<h3>Mutli-Hunt.</h3><br>";
?>

        <form id="loginForm" name="name" method="get" action="multi.php">
            <table>
                <tr><td colspan="2">Check Logs for Whom? </td></tr>
                <tr><td><input name="name" type="text" class="textfield" id="name" /></td>
                    <td><input type="submit" value="Submit" /></td></tr>
            </table>
        </form>

        <table>
            <form id="loginForm" name="ip" method="get" action="multiip.php">
                <tr><td colspan="2">Check IP address. </td></tr>
                <tr><td><input name="name" type="text" class="textfield" id="name" /></td>
                    <td><input type="submit" value="Submit" /></td></tr>
            </form>

        </table>
        <table>
            <form id="loginForm" name="ip" method="get" action="ban.php">
                <tr><td colspan="2">Ban IP. </td></tr>
                <tr><td><input name="ip" type="text" class="textfield" id="ip" /></td>
                    <td><input type="submit" value="Submit" /></td></tr>
            </form>

        </table>
        <?php
        echo "<table>";


        $name = mysql_real_escape_string($_GET['name']);
        $multi_sql = mysql_query("SELECT * FROM members WHERE login = '$name'", $db);



        while ($multi_row = mysql_fetch_array($multi_sql)) {
            $tbl_name = "nationlog";
            $adjacents = 3;


            $query = "SELECT COUNT(*) as num FROM $tbl_name WHERE nationid = '$multi_row[0]'";
            $total_pages = mysql_fetch_array(mysql_query($query, $logdb));
            $total_pages = $total_pages[num];


            $targetpage = "multi.php?name=$name";  //your file name  (the name of this file)
            $limit = 15;         //how many items to show per page
            $page = $_GET['page'];
            if ($page)
                $start = ($page - 1) * $limit;    //first item to display on this page
            else
                $start = 0;        //if no page var is given, set start to 0

            /* Get data. */
            $sql = "SELECT * FROM $tbl_name WHERE nationid = '$multi_row[0]' ORDER BY date DESC LIMIT $start, $limit";
            $result = mysql_query($sql, $logdb);

            /* Setup page vars for display. */
            if ($page == 0)
                $page = 1;     //if no page var is given, default to 1.
            $prev = $page - 1;       //previous page is page - 1
            $next = $page + 1;       //next page is page + 1
            $lastpage = ceil($total_pages / $limit);  //lastpage is = total pages / items per page, rounded up.
            $lpm1 = $lastpage - 1;      //last page minus 1

            /*
              Now we apply our rules and draw the pagination object.
              We're actually saving the code to a variable in case we want to draw it more than once.
             */
            $pagination = "";
            if ($lastpage > 1) {
                $pagination .= "<div class=\"pagination\">";
                //previous button
                if ($page > 1)
                    $pagination.= "<a href=\"$targetpage&page=$prev\"> previous </a>";
                else
                    $pagination.= "<span class=\"disabled\">previous</span>";

                //pages
                if ($lastpage < 7 + ($adjacents * 2)) { //not enough pages to bother breaking it up
                    for ($counter = 1; $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\"> $counter </span>";
                        else
                            $pagination.= "<a href=\"$targetpage&page=$counter\"> $counter </a>";
                    }
                }
                elseif ($lastpage > 5 + ($adjacents * 2)) { //enough pages to hide some
                    //close to beginning; only hide later pages
                    if ($page < 1 + ($adjacents * 2)) {
                        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                            if ($counter == $page)
                                $pagination.= "<span class=\"current\"> $counter </span>";
                            else
                                $pagination.= "<a href=\"$targetpage&page=$counter\"> $counter </a>";
                        }
                        $pagination.= "...";
                        $pagination.= "<a href=\"$targetpage&page=$lpm1\"> $lpm1 </a>";
                        $pagination.= "<a href=\"$targetpage&page=$lastpage\"> $lastpage </a>";
                    }
                    //in middle; hide some front and some back
                    elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                        $pagination.= "<a href=\"$targetpage&page=1\"> 1 </a>";
                        $pagination.= "<a href=\"$targetpage&page=2\"> 2 </a>";
                        $pagination.= "...";
                        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                            if ($counter == $page)
                                $pagination.= "<span class=\"current\"> $counter </span>";
                            else
                                $pagination.= "<a href=\"$targetpage&page=$counter\"> $counter </a>";
                        }
                        $pagination.= "...";
                        $pagination.= "<a href=\"$targetpage&page=$lpm1\"> $lpm1 </a>";
                        $pagination.= "<a href=\"$targetpage&page=$lastpage\"> $lastpage </a>";
                    }
                    //close to end; only hide early pages
                    else {
                        $pagination.= "<a href=\"$targetpage&page=1\"> 1 </a>";
                        $pagination.= "<a href=\"$targetpage&page=2\"> 2 </a>";
                        $pagination.= "...";
                        for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                            if ($counter == $page)
                                $pagination.= "<span class=\"current\"> $counter </span>";
                            else
                                $pagination.= "<a href=\"$targetpage&page=$counter\"> $counter </a>";
                        }
                    }
                }

                //next button
                if ($page < $counter - 1)
                    $pagination.= "<a href=\"$targetpage&page=$next\"> next </a>";
                else
                    $pagination.= "<span class=\"disabled\"> next </span>";
                $pagination.= "</div>\n";
            }

            while ($row = mysql_fetch_array($result)) {
                echo "<tr><td>$row[3]</td><td>$row[2]</td></tr>";
            }
            echo "</table>";
        }
        ?>
        <?= $pagination ?>

        <?php
        include("../online.php");
        echo "</div>";
        include("../count.php");
 include("../footer.php");
        ?>