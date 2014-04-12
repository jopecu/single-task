<?php
$dbc = mysql_connect('localhost', 'single-task', 'fleyelir', 'single_task')
OR die(mysqli_connect_error());
mysqli_set_charset($dbc,'UTF8');
?>