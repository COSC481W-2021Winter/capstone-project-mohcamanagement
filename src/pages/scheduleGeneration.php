<?php
    /*db connection needed if in seperate file */
    include_once ('../includes/dbConnection.php');
    // $conn is the conection to database
    function getInclude() {
        $dbHost = "localhost";
        $dbUser = "root";
        $dbPass = "";
        $db = "Overseer";

        return mysqli_connect($dbHost, $dbUser, $dbPass, $db);
    }
    if(!empty($_POST['Monday'])){
		for($i=0;$i<=$_POST['userCount'];$i++){
		//$useri = print('username' + $i);
		$username='JBond';
		$monday = $_POST['Monday'];
		$tuesday = $_POST['Tuesday'];
		$wednesday = $_POST['Wednesday'];
		$thursday = $_POST['Thursday'];
		$friday = $_POST['Friday'];
		$saturday = $_POST['Saturday'];
		$sunday = $_POST['Sunday'];
		$sql="UPDATE WorkingSchedule SET Monday = '$monday', Tuesday = '$tuesday', Wednesday = '$wednesday',Thursday = '$thursday',Friday = '$friday',Saturday = '$saturday',Sunday = '$sunday' WHERE Username = '$username'";
		// mysqli_query($conn=getInclude(),$sql);
		$conn=getInclude();
        $conn->query($sql);
        }
    }
    if(!empty($_POST["startTime"])){
        $name=$_POST['shiftName'];
        $start=$_POST['startTime'];
        $end=$_POST['endTime'];
        $sql="INSERT INTO ShiftTimes(ShiftName,StartTime,EndTime)
                VALUES('$name','$start','$end')";

        $conn=getInclude();
        $conn->query($sql);

    }


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
    	$numOfRows = mysqli_num_rows($result);

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

    //Main driver to generate shifts
    function generateShifts($conn, $pin){
    	$schedule = Array(Array(), Array(), Array(), Array(), Array(), Array(), Array());

    	$query = "SELECT * FROM Availability";
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
    <h1>Edit Next Weeks Schedule</h1>
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
		$query = "SELECT * FROM Users JOIN WorkingSchedule";
		//makes the connection to the database with the query and returns the result
		$result = mysqli_query($conn, $query);
		//how many rows of data was retunred from the database
		$numOfRows = mysqli_num_rows($result);
		// or you can put it into the loop directly
		// while($row=mysqli_fetch_assoc($result))
		//which will iterate over every row
		$temp=null;

		echo "<form action='adminEditSchedule.php' method='POST'>";


		function generateOptions(){
		
			$query = "SELECT * FROM ShiftTimes";
			$result = mysqli_query($conn=getInclude(), $query);
			while($row = $result->fetch_assoc()){
				echo "<option value='".($row['ShiftName'])."'>".($row['StartTime'])." - ".($row['EndTime'])."</option>";
			}	
		}
		$i=0;
		while($row = $result->fetch_assoc()) {
			//grabs the current row of data so you can display or manipulate
			if($temp==$row["Username"])
				break;
			echo "<tr>";
			echo "<td class='schedBorder'name='user'>".($row['Username'])."</td>";
			echo "<td class='schedBorder'><select name='Monday' id='scheduleEdit'>";
			generateOptions();
			echo"</select></td>";		
			echo "<td class='schedBorder' ><select name='Tuesday' id='scheduleEdit'>";
			generateOptions();
			echo"</select></td>";
			echo "<td class='schedBorder'><select name='Wednesday' id='scheduleEdit'>";
			generateOptions();
			echo"</select></td>";
			echo "<td class='schedBorder'><select name='Thursday' id='scheduleEdit'>";
			generateOptions();
			echo"</select></td>";
			echo "<td class='schedBorder'><select name='Friday' id='scheduleEdit'>";
			generateOptions();
			echo"</select></td>";
			echo "<td class='schedBorder'><select name='Saturday' id='scheduleEdit'>";
			generateOptions();
			echo"</select></td>";
			echo "<td class='schedBorder'><select name='Sunday' id='scheduleEdit'>";
			generateOptions();
			echo"</select></td>";
			
				echo"<input type='Hidden' name='done' id='done' value='true'></input>";
				echo"<input type='Hidden' name='user$i' id='Userdone' value='".($row['Username'])."'></input>";							
			echo "</tr>";

			$i++;
			
			$temp=$row["Username"];
		}
		echo"<input type='Hidden' name='userCount' id='userCount' value='$i'></input>";	
		echo"<input type='Submit' value='EditSchedule'></input>";
		echo "</form>";
		?>
	</table>
    <table>
        <h1>Add Custom Shifts</h1>
        <form action="adminEditSchedule.php" method="POST">
        <tr>
            <td>Name <input type="text" name="shiftName"></td>
            <td><select name="startTime">
                <?php $temp=0;
                for($i=1;$i<13;$i++){
                    if($temp==$i){
                        echo"<option>$i:30</option>";
                        
                    }
                    else{
                        echo"<option>$i:00</option>";
                        $temp=$i;
                        $i=$i-1;
                    }
                    
                    if($temp>24){
                        break;
                    }
                }
                ?>
            </select></td>
            <td><select name="endTime">
                <?php $temp=0;
                for($i=1;$i<13;$i++){
                    if($temp==$i){
                        echo"<option>$i:30</option>";
                        
                    }
                    else{
                        echo"<option>$i:00</option>";
                        $temp=$i;
                        $i=$i-1;
                    }
                    
                    if($temp>24){
                        break;
                    }
                }
                ?>
            </select></td>
            <td><input type='Submit' value='Submit'></input></td>
        </tr>
        </form>

    </table>

    <form method="post" action="adminMain.php">
            <input type="Submit" name="Submit" value="Back"></input>
    </form>
 </body>
 </html>