<html>
<body>
<h1 align="center">Settings Page</h1>
<div align="center">
<?php
//Connect to database and set database to be used
$link = mysql_connect('localhost', 'single-task', 'fleyelir', 'single_task');
	if (!$link) {
    die('Could not connect: ' . mysql_error());
	}
	mysql_query("USE single_task", $link);


//test query to return a value
$query = "SELECT batches_of , hours_per_day_avail , include_sat_sun FROM settings WHERE ID=0;";

$result = mysql_query($query,$link);

while ($row = mysql_fetch_assoc($result)) {
	echo "Here are the current settings: <br /><br />";
    echo "You would like to work in batches of: " . $row['batches_of'] . "<br/>";
    echo "Hours you have put aside for tasks per day: " . $row['hours_per_day_avail'] . "<br/>";
    if ($row['include_sat_sun'] == 1) {
        echo "You have chose TO include Saturday and Sunday.<br/>";
    }
    else {
    echo "You have chosen NOT to include Saturday and Sunday.<br/>";
    }
    echo "<br/><a href='settings-change.php'>Change Settings</a><br/>";
}

?>
<br/>
<a href="index.php">Home</a> | <a href="add.php">Add a Task</a> | <a href="settings.php">Settings</a> | <a href="tasks.php">Show All Tasks</a> | <a href="stats.php">Stats</a> | <a href="update-date-scores.php">Update Scores</a>
<br />
</div>
</body>
</html>