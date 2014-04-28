<html>
<head>
<title>Change Settings</title>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href="css/singletask.css" rel="stylesheet">
</head>
<body>
<div align="center" id="AppContainer">
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

$batches_of = $_POST['batches_of'];
$hours_avail = $_POST['hours_avail'];
$include_sat_sun = $_POST['include_sat_sun'];

$sql = "UPDATE settings ".
       "SET batches_of = $batches_of , hours_per_day_avail = $hours_avail , include_sat_sun = $include_sat_sun ".
       "WHERE ID = 0" ;

mysql_select_db('single_task');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not update data: ' . mysql_error());
}
echo "Updated data successfully\n";
echo "<br/><br/><a href='index.php'>Back to Home</a>";
}
else
{
?>
<form method="post" action="<?php $_PHP_SELF ?>">
<table width="400" border="0" cellspacing="1" cellpadding="2">
<tr>
<td width="100">Batches Of</td>
<td><select name="batches_of" type="text" id="batches_of" value="<?php $retval['batches_of'] ?>">
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
</td>
</tr>
<tr>
<td width="100">Hours Available</td>
<td><select name="hours_avail" type="text" id="hours_avail">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select>
</td>
</tr>
<tr>
<td width="100">Include Sat Sun?</td>
<td><input type="radio" name="include_sat_sun" value=1>Yes<br>
<input type="radio" name="include_sat_sun" value=0>No</td>
</tr>
<tr>
<td width="100"> </td>
<td> </td>
</tr>
<tr>
<td width="100"> </td>
<td>
<input name="update" type="submit" id="update" value="Update">
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