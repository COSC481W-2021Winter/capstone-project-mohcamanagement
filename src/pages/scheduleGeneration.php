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
    if(!empty($_POST['Monday0'])){
		$query = "SELECT * FROM Users WHERE isManager=0";
		$result = mysqli_query($conn, $query);
		$numOfRows = mysqli_num_rows($result);
		for($i=0;$i<$numOfRows;$i++){

			$row = mysqli_fetch_assoc($result);
			$username = $row['Username'];
			
			
			$monday = $_POST['Monday'.$i];
			$tuesday = $_POST['Tuesday'.$i];
			$wednesday = $_POST['Wednesday'.$i];
			$thursday = $_POST['Thursday'.$i];
			$friday = $_POST['Friday'.$i];
			$saturday = $_POST['Saturday'.$i];
			$sunday = $_POST['Sunday'.$i];
      
			$sql="UPDATE WorkingSchedule SET Monday = '$monday', Tuesday = '$tuesday',
			Wednesday = '$wednesday',Thursday = '$thursday',Friday = '$friday',
			Saturday = '$saturday',Sunday = '$sunday' WHERE Username = '$username'";

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

    //Main driver to generate shift Availability
    function generateShifts($conn, $pin){
    	$schedule = Array(Array(), Array(), Array(), Array(), Array(), Array(), Array());

    	$query = "SELECT * FROM Availability";
    	$result = mysqli_query($conn, $query);

    	iterateShiftsTable($result, $pin, $schedule);
    	printSchedule($schedule);
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
	//grabs the requested days off and displays it
    function getRequestsOff($conn, $pin, $userName){
        $query = "SELECT * FROM RequestOff";
        $result = mysqli_query($conn, $query);

        iterateRequestOffTable($result, $pin, $userName);

	}
	//makes the display time for next weeks schedule
	function generateTimes($conn,$query,$day){
		//first monday
		$result=mysqli_query($conn,$query);
		while($row = $result->fetch_assoc()){
			if($row[$day]==$row['ShiftName']){
				echo $row['StartTime']." - ".$row['EndTime'];
			}
		}
	}
	//makes the schedule for next week
	function generateSchedule($conn,$user){
		try{
		$query="SELECT * FROM WorkingSchedule JOIN ShiftTimes WHERE Username='".$user."'";
			echo "<td class='schedBorder'>";
				echo generateTimes($conn,$query,"Monday");
			echo "</td>";
			echo "<td class='schedBorder'>";
				echo generateTimes($conn,$query,'Tuesday');
			echo "</td>";
			echo "<td class='schedBorder'>";
				echo generateTimes($conn,$query,'Wednesday');
			echo "</td>";
			echo "<td class='schedBorder'>";
				echo generateTimes($conn,$query,'Thursday');
			echo "</td>";
			echo "<td class='schedBorder'>";
				echo generateTimes($conn,$query,'Friday');
			echo "</td>";
			echo "<td class='schedBorder'>";
				echo generateTimes($conn,$query,'Saturday');
			echo "</td>";
			echo "<td class='schedBorder'>";
				echo generateTimes($conn,$query,'Sunday');
			echo "</td>";
		
		}catch(exception $e){

		}
        
	}
	//makes the options for the shift selectin for next weeks schedule
	
	function generateOptions($day,$usernamE){
		
		$query = "SELECT * FROM WorkingSchedule NATURAL JOIN ShiftTimes WHERE Username='$usernamE'";

		$result = mysqli_query($conn=getInclude(), $query);
		
		while($row = $result->fetch_assoc()){

			if($row[$day]==$row["ShiftName"]){
				echo "<option Selected value='".($row['ShiftName'])."'>".($row['StartTime'])." - ".($row['EndTime'])."</option>";

			}
			else{
				echo "<option value='".($row['ShiftName'])."'>".($row['StartTime'])." - ".($row['EndTime'])."</option>";
			}
		}	
	}
	//makes the shift times for custom shifts
	function generateCustomShift(){
		$temp=0;
		for($i=1;$i<24;$i++){
			if($temp==$i){
				echo"<option>$i:30</option>";
				if($i==23){
					echo"<option>24:00</option>";
				}
			}
			else{
				echo"<option>$i:00</option>";
				$temp=$i;
				$i=$i-1;
			}
		}

	}
?>
<!DOCTYPE html>
 <html lang="en">
 <head>
    <title>Work Schedule</title>
    <link rel="stylesheet" href="../style/style.css?<?php echo time(); ?>">

 </head>
 <body>
    <h1>Availability</h1>
    <table id="avail" style="center">
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
	<table id="nextweekschedule" style="center">
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
		//$query = "SELECT * FROM Users JOIN WorkingSchedule";
		//makes the connection to the database with the query and returns the result
		//$result = mysqli_query($conn, $query);
		//how many rows of data was retunred from the database
		//$numOfRows = mysqli_num_rows($result);
		// or you can put it into the loop directly
		//which will iterate over every row
		//$temp=null;

		$query = "SELECT * FROM Users WHERE isManager=0";
		$result = mysqli_query($conn, $query);
		$numOfRows = mysqli_num_rows($result);
		
		echo "<form action='scheduleGeneration.php' method='POST'>";

		// for($i=0;$i<$numOfRows;$i++){
			// $row = mysqli_fetch_assoc($result);
			// $username = $row["Username"];
			// echo "<td class='schedBorder'name='user'>".$username."</td>";
		// }
		
		//$i=0;
		for($i=0;$i<$numOfRows;$i++){
			//grabs the current row of data so you can display or manipulate
			$row = mysqli_fetch_assoc($result);
			$username = $row["Username"];
			echo"<input type='Hidden' name='".$username."' id='".$username."' value='".$username."'></input>";	
			echo "<tr>";
				echo "<td class='schedBorder'name='$username'>".$username."</td>";
				echo "<td class='schedBorder'><select name='Monday$i' id='scheduleEdit'>";
					generateOptions("Monday",$username);
				echo"</select></td>";		
				echo "<td class='schedBorder' ><select name='Tuesday$i' id='scheduleEdit'>";
					generateOptions("Tuesday",$username);
				echo"</select></td>";
				echo "<td class='schedBorder'><select name='Wednesday$i' id='scheduleEdit'>";
					generateOptions("Wednesday",$username);
				echo"</select></td>";
				echo "<td class='schedBorder'><select name='Thursday$i' id='scheduleEdit'>";
					generateOptions("Thursday",$username);
				echo"</select></td>";
				echo "<td class='schedBorder'><select name='Friday$i' id='scheduleEdit'>";
					generateOptions("Friday",$username);
				echo"</select></td>";
				echo "<td class='schedBorder'><select name='Saturday$i' id='scheduleEdit'>";
					generateOptions("Saturday",$username);
				echo"</select></td>";
				echo "<td class='schedBorder'><select name='Sunday$i' id='scheduleEdit'>";
					generateOptions("Sunday",$username);
				echo"</select></td>";
			
				//echo"<input type='Hidden' name='done' id='done' value='true'></input>";
										
			echo "</tr>";

			//$i++;
			
			//$temp=$row["Username"];
		}
		// echo"<input type='Hidden' name='userCount' id='userCount' value='$i'></input>";	
		echo"<tr><td><input type='Submit' value='EditSchedule'></input></td></tr>";
		echo "</form>";
		?>
	</table>
	<h1>Next Weeks Schedule</h1>
	<table id="workSched">
        <?php
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
		
        $query = "SELECT * FROM Users WHERE isManager=0";
        $result = mysqli_query($conn, $query);
        $numOfRows = mysqli_num_rows($result);

        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td class='schedBorder'name='user'>".($row['Username'])."</td>";
            generateSchedule($conn, $row['Username']);
            echo "</tr>";
        }
        ?>
    </table>

    <h1>Time Request Off</h1>
    <table id="requestOff" style="center">
        <?php
        // plan to add an automated date with the weekdays to make shcdule easier to read
        //ex Monday 15
        echo "<tr>";
            echo "<td class='schedBorder'><h3>Employee</h3></td>";
            echo "<td class='schedBorder' ><h3> Start Date </h3></td>";
            echo "<td class='schedBorder'><h3> End Date </h3></td>";
            echo "<td class='schedBorder'><h3> Mandatory </h3></td>";
        echo "</tr>";
        //Selects all the data from the Users Table for use in getting the schedules
        $query = "SELECT * FROM Users";
        //makes the connection to the database with the query and returns the result
        $result = mysqli_query($conn, $query);
        //how many rows of data was retunred from the database
        $numOfRows = mysqli_num_rows($result);
        // or you can put it into the loop directly
        //which will iterate over every row

        while($row = mysqli_fetch_assoc($result)) {
            //grabs the current row of data so you can display or manipulate
            getRequestsOff($conn, $row['Pin'], $row['Username']);
        }
        ?>
    </table>

    <table>
        <h1>Add Custom Shifts</h1>
        <form action="scheduleGeneration.php" method="POST">
        <tr>
            <td>Name <input type="text" name="shiftName"></td>
            <td>
				<select name="startTime">
					<?php
					generateCustomShift();
					?>
				</select>
			</td>
            <td>
				<select name="endTime">
					<?php 
					generateCustomShift();
					?>
				</select>
			</td>
            <td>
				<input type='Submit' value='Submit'></input>
			</td>
        </tr>
        </form>

    </table>

    <form method="post" action="adminMain.php">
            <input type="Submit" name="Submit" value="Back"></input>
    </form>
 </body>
 </html>