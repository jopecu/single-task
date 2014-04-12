<?php
	//Connect to the database
	$link = mysql_connect('localhost', 'single-task', 'fleyelir', 'single_task');
	if (!$link) {
    die('Could not connect: ' . mysql_error());
	}
	mysql_query("USE single_task", $link);
if(isset($_POST['delete_id'] && !empty($_POST['delete_id'])) {
  mysql_query("DELETE FROM KeepScores WHERE `id`=".mysql_real_escape_string($delete_id));
  header('Location: tasks.php');
}