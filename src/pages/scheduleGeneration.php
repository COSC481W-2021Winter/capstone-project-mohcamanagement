<?php
    /*db connection needed if in seperate file */
    include_once ('../includes/dbConnection.php');
    // $conn is the conection to database

    //Converts a day string to a number based on the day of the week starting on Monday
    function dateToNumber($date){
    	switch($date){
    		case "Monday":
    			return 0;
    		case "Tuesday":
    			return 1;
    		case "Wednesday":
    			return 2;
    		case "Thursday":
    			return 3;
    		case "Friday":
    			return 4;
    		case "Saturday":
    			return 5;
    		case "Sunday":
    			return 6;
    		default:
    			return -1;
    	}
    }

    //Fills up the schedule array with shift strings.
    function fillScheduleArray($row, $pin, &$schedule){
    	$index = dateToNumber($row['Day']);
    	array_push($schedule[$index], $row['ShiftName']);
    }

    //Iterates through the shift table in the database
    function iterateShiftsTable($result, $pin, &$schedule){
    	while($row = $result->fetch_assoc()){
    		if($row['Pin'] == $pin) fillScheduleArray($row, $pin, $schedule);
    	}
    }

    //Prints out the shift schedule to the table
    function printSchedule($schedule){
    	for($i = 0; $i < count($schedule); $i++){
    		$shifts = "";
    		for($j = 0; $j < count($schedule[$i]); $j++){
    			if($j == count($schedule[$i])-1) $shifts .= $schedule[$i][$j];
    			else $shifts .= $schedule[$i][$j].", ";
    		}
    		if(count($schedule[$i]) == 0)echo "<td class='schedBorder'> Off </td>";
    		else echo "<td class='schedBorder'>".$shifts."</td>";
    	}
    }


    function fillRequestOffTable($row){
    	$startDate = $row['StartDate'];
    	$endDate = $row['EndDate'];
    	$isMandatory = $row['Mandatory'];

    	echo "<td class='schedBorder'>".$startDate."</td>";
    	echo "<td class='schedBorder'>".$endDate."</td>";

    	if($isMandatory) echo "<td class='schedBorder'> Yes </td>";
    	else echo "<td class='schedBorder'> No </td>";
    }

    function iterateRequestOffTable($result, $pin, $userName){

    	$isNameSet = false;
    	
    	while($row = $result->fetch_assoc()){
    		if($row['Pin'] == $pin){
    			echo "<tr>";
    			if(!$isNameSet){
	    			echo "<td class='schedBorder'name='user'>".$userName."</td>";
	    			$isNameSet = true;
	    		}
	    		else echo "<td class='schedBorder'> </td>";
    			fillRequestOffTable($row, $userName);
    		} 
    		echo "</tr>";
    	}
    }

    function getRequestsOff($conn, $pin, $userName){
    	$query = "SELECT * FROM requestoff";
    	$result = mysqli_query($conn, $query);

    	iterateRequestOffTable($result, $pin, $userName);

    }

    //Main driver to generate shifts
    function generateShifts($conn, $pin){
    	$schedule = Array(Array(), Array(), Array(), Array(), Array(), Array(), Array());

    	$query = "SELECT * FROM availability";
    	$result = mysqli_query($conn, $query);

    	iterateShiftsTable($result, $pin, $schedule);
    	printSchedule($schedule);
    }

?>
<!DOCTYPE html>
 <html lang="en">
 <head>
    <title>Work Schedule</title>
    <link rel="stylesheet" href="../style/style.css">
 </head>
 <body>
    <h1>Work Schedule</h1>
    <table style="center">
        <?php
        // plan to add an automated date with the weekdays to make shcdule easier to read
        //ex Monday 15
        echo "<tr>";
            echo "<td class='schedBorder'><h3>Employee</h3></td>";
            echo "<td class='schedBorder' ><h3>Monday </h3></td>";
            echo "<td class='schedBorder'><h3>Tuesday </h3></td>";
            echo "<td class='schedBorder'><h3>Wednesday </h3></td>";
            echo "<td class='schedBorder'><h3>Thursday </h3></td>";
            echo "<td class='schedBorder'><h3>Friday </h3></td>";
            echo "<td class='schedBorder'><h3>Saturday </h3></td>";
            echo "<td class='schedBorder'><h3>Sunday </h3></td>";
        echo "</tr>";
        //Selects all the data from the Users Table for use in getting the schedules
        $query = "SELECT * FROM Users";
        //makes the connection to the database with the query and returns the result
        $result = mysqli_query($conn, $query);
        //how many rows of data was retunred from the database
        $numOfRows = mysqli_num_rows($result);
        // or you can put it into the loop directly
        // while($row=mysqli_fetch_assoc($result))
        //which will iterate over every row

        while($row = mysqli_fetch_assoc($result)) {
            //grabs the current row of data so you can display or manipulate
            echo "<tr>";
            echo "<td class='schedBorder'name='user'>".($row['Username'])."</td>";
            generateShifts($conn, $row['Pin']);
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <h1>Requests Off</h1>
    <table style="center">
        <?php
        // plan to add an automated date with the weekdays to make shcdule easier to read
        //ex Monday 15
        echo "<tr>";
            echo "<td class='schedBorder'><h3>Employee</h3></td>";
            echo "<td class='schedBorder'><h3>Start Date </h3></td>";
            echo "<td class='schedBorder'><h3>End Date </h3></td>";
            echo "<td class='schedBorder'><h3>Mandatory </h3></td>";
        echo "</tr>";
        //Selects all the data from the Users Table for use in getting the schedules
        $query = "SELECT * FROM Users";
        //makes the connection to the database with the query and returns the result
        $result = mysqli_query($conn, $query);
        //how many rows of data was retunred from the database
        $numOfRows = mysqli_num_rows($result);
        // or you can put it into the loop directly
        // while($row=mysqli_fetch_assoc($result))
        //which will iterate over every row

        while($row = mysqli_fetch_assoc($result)) {
            //grabs the current row of data so you can display or manipulate
            getRequestsOff($conn, $row['Pin'], $row['Username']);
        }
        ?>
    </table>

    <form method="post" action="adminMain.php">
            <input type="Submit" name="Submit" value="Back"></input>
    </form>
 </body>
 </html>