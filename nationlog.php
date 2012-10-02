<?php  
include("config.php");

  include("$directory/includes/config/auth.php");
  include("$directory/includes/misc/include.php");
include("$directory/includes/misc/count.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>National Log</title>
        <link href="loginmodule.css" rel="stylesheet" type="text/css" />
    </head>
    <body><div id="banner">
            <h1>National Log.</h1>
        <?php include("$directory/includes/misc/clock.php"); ?>
        </div>
        <?php
        include("$directory/includes/menus/newmenu.php");
        echo "<div id=\"main\">";
        include("$directory/includes/misc/resource.php");

        include("$directory/includes/misc/infomsg.php");
        ?>   


        <?php
        echo "<table id=\"table-3\">";
        echo "<tr><th>Date / Time</th><th>Event</th></tr>";
        $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);

        $multi_sql = mysql_query("SELECT * FROM members WHERE member_id = '$id'", $db);



        while ($multi_row = mysql_fetch_array($multi_sql)) {
            $tbl_name = "nationlog";
            $adjacents = 3;


            $query = "SELECT COUNT(*) as num FROM $tbl_name WHERE nationid = '$multi_row[0]'";
            $total_pages = mysql_fetch_array(mysql_query($query, $logdb));
            $total_pages = $total_pages[num];


            $targetpage = "nationlog.php?$name";  //your file name  (the name of this file)
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
        <center>
<?= $pagination ?>
        </center>
        <br>
            <br>
                <br>
                    <br>
                        <?php
                        include("$directory/includes/misc/online.php");
                        echo "</div>";
                        include("$directory/includes/misc/count.php");
                        include("$directory/includes/misc/footer.php");
                        ?>
