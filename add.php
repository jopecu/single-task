<h1 align="center">Add another task</h1>
<div align="center">	
<?php
if(isset($_POST['update']))
{
$dbhost = 'localhost';
$dbuser = 'single-task';
$dbpass = 'fleyelir';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

$title = $_POST['title'];
$title2 = addslashes($title);
$important = $_POST['important'];
$urgent = $_POST['urgent'];
$chargeable = $_POST['chargeable'];
$duration = $_POST['duration'];


$sql = "INSERT INTO tasklist (title, important, urgent, chargeable, datetime, duration, score) ".
       "VALUES ('$title2', $important, $urgent, $chargeable, now(), $duration, ($important + $urgent + 60/$duration +$chargeable))" ;

mysql_select_db('single_task');
$retval = mysql_query( $sql, $conn);
if(! $retval )
{
  die('Could not update data: ' . mysql_error());
}
echo "Current estimates are that this task will be completed by xxth August 2013<br/><br/>";
echo "<a href='add.php'>Add another?</a><br/><br/>";
echo "<a href='tasks.php'>View all tasks</a><br/><br/>";
echo "<a href='index.php'>View next task</a><br/><br/>";
mysql_close($conn);
}
else
{
?>
<form method="post" action="<?php $_PHP_SELF ?>">
<table width="800" border="0" cellspacing="1" cellpadding="2">
<tr>
<td width="250">Task Title</td>
<td><input name="title" type="text" id="title"> 
</td>
</tr>
<tr>
<td width="250">Particularly important to your goals?</td>
<td><select type="tinyint" name="important" value=1>
<option value="0">No</option>
<option value="5">Yes</option>
</select>
</td>
</tr>
<tr>
<td width="250">Are you being told it is urgent?</td>
<td><select type="tinyint" name="urgent" value=2>
<option value="0">No</option>
<option value="1">Yes but it is less urgent to me</option>
<option value="2">Yes and I agree</option>
<option value="10">Yes and actually to be done right away</option>
</select>
</td>
</tr>
<tr>
<td width="250">Is it chargeable?</td>
<td><select type="tinyint" name="chargeable" value=2>
<option value="5">Yes</option>
<option value="0">No</option>
</select>
</td>
</tr>
<tr>
<td width="250">Task Duration</td>
<td><select name="duration" type="tinyint" id="hours_avail">
<option value="15">Up to 15 mins</option>
<option value="30">Up to 30 mins</option>
<option value="45">Up to 45 mins</option>
<option value="60">Up to 60 mins</option>
<option value="90">Up to 90 mins</option>
<option value="120">Up to 120 hours</option>
</select>
</td>
</tr>
<tr>
<td width="100"> </td>
<td> </td>
</tr>
<tr>
<td width="100"> </td>
<td>
<input name="update" type="submit" id="update" value="Add task">
</td>
</tr>
</table>
</form>
<?php
}
?>
<br/>
<a href="index.php">Home</a> | <a href="add.php">Add a Task</a> | <a href="settings.php">Settings</a> | <a href="tasks.php">Show All Tasks</a> | <a href="stats.php">Stats</a> | <a href="update-date-scores.php">Update Scores</a>
<br />
</div>
</body>
</html>