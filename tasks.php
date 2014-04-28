<html>
<head>
<title>Tasks</title>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href="css/singletask.css" rel="stylesheet">
</head>
<body>
	<h1 align="center">All Tasks</h1>
    <div align="center" id="AppContainer">
	<?php
    require('../dbconnect.php');
	mysql_query("USE single_task", $dbc);

	$result = mysql_query("SELECT * FROM tasklist WHERE completed=0", $dbc);
	$num_rows = mysql_num_rows($result);

	echo "There are $num_rows Tasks on your list in total.<br/><br/>";
	?>
<form name="form" method="post">
<?php 
	$result = mysql_query("SELECT TID,title FROM tasklist WHERE completed=0 ORDER BY score DESC"); 
    
      while ($data = mysql_fetch_array($result)) {
        $TID = $data['TID'];
        $title = $data['title'];
        echo "$title <input type='submit' name='$TID' value='completed'></input><br />";
        

    if(!empty($_POST[$TID])) { 
        $q = mysql_query("UPDATE tasklist SET completed = 1 WHERE TID = $TID") or die(mysql_error()); 
        	if($q) { 
    			echo "<a href='tasks.php'>Completed! - Refresh list</a>"; 
    		}
    		else { 
    			echo "error"; 
    		}
        }
  
    

    }        


     ?>
		

</form> 
</body> 
<?php



?> 
<br/>
<a href="index.php">Home</a> | <a href="add.php">Add a Task</a> | <a href="settings.php">Settings</a> | <a href="tasks.php">Show All Tasks</a> | <a href="stats.php">Stats</a> | <a href="update-date-scores.php">Update Scores</a>
<br />
</div>
</body>
</html>