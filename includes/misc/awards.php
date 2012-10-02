<?php

    $award = mysql_query("SELECT * FROM awards WHERE id = '$row[21]'", $db);
    while ($awards = mysql_fetch_array($award))
    {
        
        echo $awards[1];
    }



?>
