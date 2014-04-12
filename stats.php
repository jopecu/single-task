<html>
<body>
	<h1 align="center">Statistics</h1>
    <div align="center">
	<?php
    require('../dbconnect.php');
    mysql_query("USE single_task", $dbc);
    

    $total = 0;
    $sum = mysql_query("SELECT duration FROM tasklist WHERE completed=0");
        while ($row = mysql_fetch_array($sum)) {
            $total += $row['duration'];
    }
        $hours = $total/60;
        echo "Total duration is $total mins or $hours hours. <br/>";
    $num_rows = mysql_num_rows($sum);
	echo "There are $num_rows Tasks on your list in total.<br/><br/>";
    
    $settings = mysql_query("SELECT * FROM settings");
        $settingsrow = mysql_fetch_array($settings);
            $settingshours = $settingsrow['hours_per_day_avail'];
            $settingssatsun = $settingsrow['include_sat_sun'];
            
    $daysonhours = round($hours/$settingshours,2);
            
    echo "Hours per day is $settingshours <br/><br/>";
    echo "There are therefore $daysonhours days of work on the list<br/><br/>";
    
    if ($settingssatsun==1) {
        $weekswithsatsun = round($daysonhours/7,2);
        echo "Weeks with Sat Sun is $weekswithsatsun<br/>";
    }
    else {
        $weekswithoutsatsun = round($daysonhours/5,2);
        echo "Weeks without Sat Sun is $weekswithoutsatsun<br/>";
    }

    ?>
<br/>
<a href="index.php">Home</a> | <a href="add.php">Add a Task</a> | <a href="settings.php">Settings</a> | <a href="tasks.php">Show All Tasks</a> | <a href="stats.php">Stats</a> | <a href="update-date-scores.php">Update Scores</a>
<br />
</div>
</body>
</html>