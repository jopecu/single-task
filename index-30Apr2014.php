<html>
<head>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href="css/singletask.css" rel="stylesheet">
</head>
<body>
	<h1 align="center">Single Task Homepage</h1>
    <div align="center" id="AppContainer">
	<?php
    require('../dbconnect.php');
    mysql_query("USE single_task", $dbc);
    
        $total = 0;
    $sum = mysql_query("SELECT duration FROM tasklist WHERE completed=0");
        while ($row = mysql_fetch_array($sum)) {
            $total += $row['duration'];
    }
        $hours = $total/60;
    
    $settings = mysql_query("SELECT * FROM settings");
        $settingsrow = mysql_fetch_array($settings);
            $settingshours = $settingsrow['hours_per_day_avail'];
            $settingssatsun = $settingsrow['include_sat_sun'];
            
    $daysonhours = round($hours/$settingshours,0);
    
	$result = mysql_query("SELECT * FROM tasklist WHERE completed=0");
	$velocity = mysql_query("select round(sum(duration)/60,2) from tasklist where date(datecompleted)=curdate()");
	$num_rows = mysql_num_rows($result);
    $myArray = array($result);
    $velresult = print_r($velocity);

    
	echo "There are <strong>$num_rows</strong> Tasks on your list in total ";
    echo "that will take about <strong>$daysonhours</strong> days.<br/><br/>";
    echo "If it's fully time critical, the task should go into your calendar then you can take it off this list. Always check your calendar regularly for these time critical tasks. <br/><br/>";
    echo "Today's velocity is" . $velresult;
        
    $result2 = mysql_query("SELECT * FROM tasklist WHERE completed=0 ORDER BY score DESC");

	if (!$result) {

	    echo 'Could not run query: ' . mysql_error();

	    exit;

	}

	$yourArray = array($result2);

	$index = 0;
	$row = mysql_fetch_assoc($result2);
 	$yourArray[$index] = $row;

	echo "Your next task is: <br/><strong><h2 style='color:red'>" . $row['title'] . " (" . $row['duration'] . ")</h2></strong>";
	?>
	<form name="form" method="post">
	<input type="submit" name="complete" value="Done" />
    <input type="submit" name="postpone" value="Awaiting Details" />
	</form> 
	
	<?php
		if (!empty($_POST['postpone'])) {
		$TID = $row['TID'];
        $penalty = $row['penaltyscore'];
        $penalty += 2;
        $score = $row['score'];
        $score -= 2;
		$q = mysql_query("UPDATE tasklist SET penaltyscore = $penalty WHERE TID = $TID") or die(mysql_error());
        $P = mysql_query("UPDATE tasklist SET score = $score WHERE TID = $TID") or die(mysql_error());
        if($q) { 
				echo "<a href='index.php'>Refresh</a><br/>"; 
			}
			else { 
				echo "error"; 
			} 
		 }
        if (!empty($_POST['complete'])) {
		$TID = $row['TID'];
		$q2 = mysql_query("UPDATE tasklist SET completed = 1 WHERE TID = $TID") or die(mysql_error());
        $P2 = mysql_query("UPDATE tasklist SET datecompleted = NOW() WHERE TID = $TID") or die(mysql_error());
			if($q2) { 
				echo "<a href='index.php'>Refresh</a><br/>"; 
			}
			else { 
				echo "error"; 
			} 
		 }
         $penalty = $row['penaltyscore'];
         if ($penalty > 5) {
             echo "<h3 style='color:orange;text-decoration:overline;'>This task has been delayed at least 3 times now - you really need to get it done!</h3>";
             }
         else {
             echo ".";
         }

         echo "Your current velocity over the last week is xxxxx tasks per day<br/>";

	?>	
<br/>
<a href="index.php">Home</a> | <a href="add.php">Add a Task</a> | <a href="settings.php">Settings</a> | <a href="tasks.php">Show All Tasks</a> | <a href="stats.php">Stats</a> | <a href="update-date-scores.php">Update Scores</a>
<br />
</div>
</body>
</html>
