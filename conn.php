<?php

$dbc=mysql_connect("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error());

$db=mysql_select_db("result",$dbc) or die ('I cannot connect to the database because: ' . mysql_error());

$vpath=" ";

$prev="tb_";

$dotcom="Demo";

$website_name="";

$err="Could Not Connect To The Database";

//session_start();

ob_start();

?>