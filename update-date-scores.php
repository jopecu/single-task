<html>
<body>
    <h1 align="center">Update Scores</h1>
    <div align="center">
	<?php
        require('../dbconnect.php');
        mysql_query("USE single_task", $dbc);
    
        $result = mysql_query("SELECT TID,title,datetime,important,urgent,duration,chargeable,penaltyscore FROM tasklist WHERE completed = 0");
        $num_rows = mysql_num_rows($result);
        echo "There are $num_rows Tasks on your list in total.<br/><br/>";  
        $currentdate = date('d-m-y');
        echo "$currentdate </br></br>";
   
    while ($data = mysql_fetch_array($result)) {
        $TID = $data['TID'];
        $tasktitle = $data['title'];
        $taskdate = date($data['datetime']);
        $important = $data['important'];
        $urgent = $data['urgent'];
        $duration = $data['duration'];
        $chargeable = $data['chargeable'];
        $penaltyscore = $data['penaltyscore'];
        $editedtaskdate = date('d-m-y', strtotime($taskdate));
        $diff = $currentdate - $editedtaskdate;
        $insert = "UPDATE tasklist SET datescore = $diff WHERE TID = $TID;";
        $recalc = "UPDATE tasklist SET score = $important+$urgent+2*$diff+60/$duration+$chargeable-$penaltyscore WHERE TID = $TID;";
        echo "$TID - $tasktitle - $taskdate - $important - $urgent - $chargeable - $duration - $diff -";
        
        $retval = mysql_query($insert);
        if (! $retval) {
                die('Could not update data: ' . mysql_error());
        }
        echo "updated successfully";
        
        $retval2 = mysql_query($recalc);
        if (! $retval2) {
                die('Could not update data: ' . mysql_error());
        }
        echo "recalced successfully";
        
        echo "$TID - $tasktitle - $editedtaskdate - Difference: $diff<br/>";
    }
    ?>
<br/>
<a href="index.php">Refresh</a> | <a href="index.php">Home</a> | <a href="add.php">Add a Task</a> | <a href="settings.php">Settings</a> | <a href="tasks.php">Show All Tasks</a> | <a href="stats.php">Stats</a> | <a href="update-date-scores.php">Update Scores</a>
<br />
</div>
</body>
</html>