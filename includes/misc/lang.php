<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    $lang = $_SESSION['SESS_LANG'];

    $langtemp = "SELECT * FROM lang WHERE lang = '$lang'";
    $langsql = $pdo->query($langtemp);
?>
