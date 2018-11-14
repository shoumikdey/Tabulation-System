<?php
session_start();

if(!isset($_SESSION[ 'logged']) || $_SESSION[ 'logged' ] != 1) {
	header('Refresh: 5; URL=index.php?redirect='  .$_SERVER['PHP_SELF']);
        echo '<p> You will be redirected to the login page in 5 seconds. </p>';
        die();
     }
?>