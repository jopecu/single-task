<html>
<body>
	<h1>All Tasks</h1>
	<?php
	//Connect to the database
	$link = mysql_connect('localhost', 'single-task', 'fleyelir', 'single_task');
	if (!$link) {
    die('Could not connect: ' . mysql_error());
	}
	mysql_query("USE single_task", $link);

	$result = mysql_query("SELECT * FROM tasklist", $link);
	$num_rows = mysql_num_rows($result);

	echo "There are $num_rows Tasks on your list in total.<br/><br/>";
	?>

<?php
$result = mysql_query("SELECT * FROM tasklist");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
$yourArray = array($result);

$index = 0;
while($row = mysql_fetch_assoc($result)) // loop to give you the data in an associative array so you can use it however.
{
     $yourArray[$index] = $row;
     $index++;
	 echo "<li>" . $row['title'] . "</li>";
}


?>
<br/>
<br/>
<a href="index.php">Home</a>
<br/>
<a href="add.php">Add a Task</a>
<br/>
<a href="settings.php">Settings</a>
<br/>
<a href="tasks.php">Show All Tasks</a>
<br/>
<a href="stats.php">Stats</a>
</body>
</html>