<?php

$ismaint = 'false';

        if ($ismaint == "true") {
            header("location: maintenance.html");
        }
        if ($isipban == "true") {
            header("location: ipbanned.html");
            
        }
?>
