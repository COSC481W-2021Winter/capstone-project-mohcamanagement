<?php
    /*db connection needed if in seperate file */
    include_once ('../includes/dbConnection.php');

	date_default_timezone_set("America/New_York");

	function callAIFunction($company=""){
		exec("python ../../py/mainAI.py ".$company, $output);
		if ($output[0] != "Done"){
			echo '<script>alert("Unable to generate schedule!")</script>';
		}
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["acceptSchedule"])) {
		$query = "DELETE FROM CurrentSchedule";
		mysqli_query($conn, $query);

		$query = "SELECT * FROM WorkingSchedule";
		$result = mysqli_query($conn, $query);
		$numOfRows = mysqli_num_rows($result);

		for($i=0;$i<$numOfRows;$i++){
			$row = mysqli_fetch_assoc($result);
			$user = $row['Username'];
			$monday = $row['Monday'];
			$tuesday = $row['Tuesday'];
			$wednesday = $row['Wednesday'];
			$thursday = $row['Thursday'];
			$friday = $row['Friday'];
			$saturday = $row['Saturday'];
			$sunday = $row['Sunday'];

			$sql = "INSERT INTO CurrentSchedule VALUES ('$user','$monday','$tuesday','$wednesday','$thursday','$friday','$saturday','$sunday')";
			mysqli_query($conn, $sql);
		}
		echo "<script>alert('The schedule has ben saved as the current schedule.')</script>";
	}

	// checking to see if the user is allowed to be on the page.
    if(isset($_COOKIE["Username"])) {
		// if not empty then we store the cookie into a variable
		$userCookie = $_COOKIE["Username"];
		$query = "SELECT * FROM Users WHERE Username = '$userCookie'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$isManagerCheck = $row['IsManager'];
		$companyName = $row['Name'];

		if($isManagerCheck == 0) {
			header("Location: userMain.php");
		}
	}
    // $conn is the conection to database
    function getInclude() {
        $dbHost = "localhost";
        $dbUser = "root";
        $dbPass = "";
        $db = "Overseer";

        return mysqli_connect($dbHost, $dbUser, $dbPass, $db);
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["editSchedule"])) {
		$query = "SELECT * FROM Users WHERE isManager=0 AND Name='$companyName'";
		$result = mysqli_query($conn, $query);
		$numOfRows = mysqli_num_rows($result);
		
		for($i=0; $i<$numOfRows; $i++){

			$row = mysqli_fetch_assoc($result);
			$username = $row['Username'];
			
			$monday = $_POST['Monday'.$i];
			$tuesday = $_POST['Tuesday'.$i];
			$wednesday = $_POST['Wednesday'.$i];
			$thursday = $_POST['Thursday'.$i];
			$friday = $_POST['Friday'.$i];
			$saturday = $_POST['Saturday'.$i];
			$sunday = $_POST['Sunday'.$i];
      		
      		$sql ="DELETE FROM WorkingSchedule WHERE Username='$username'";
      		mysqli_query($conn, $sql);

			$sql="INSERT INTO WorkingSchedule VALUES('$username', '$monday', '$tuesday', '$wednesday', '$thursday', '$friday', '$saturday', '$sunday')";

      		mysqli_query($conn, $sql);
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

	if(!empty($_POST["generateAI"])){
		$userName = $_COOKIE['Username'];
		$query = "SELECT Name FROM Users WHERE Username = '$userName'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$company = $row['Name'];
		callAIFunction($company);
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
		$numOfRows = mysqli_num_rows($result);
		if($numOfRows > 0) {
			while($row = $result->fetch_assoc()){

				if($row[$day]==$row["ShiftName"]){
					echo "<option Selected value='".($row['ShiftName'])."'>".($row['StartTime'])." - ".($row['EndTime'])."</option>";

				}
				else{
					echo "<option value='".($row['ShiftName'])."'>".($row['StartTime'])." - ".($row['EndTime'])."</option>";
				}
			}
		}

		else {
			$query = "SELECT * FROM ShiftTimes";
			$result = mysqli_query($conn=getInclude(), $query);
       		$numOfRows = mysqli_num_rows($result);

			for ($i=0; $i < $numOfRows-1 ; $i++) { 
				$row = mysqli_fetch_assoc($result);

				echo "<option value='".($row['ShiftName'])."'>".($row['StartTime'])." - ".($row['EndTime'])."</option>";
			}	
				$row = mysqli_fetch_assoc($result);
				echo "<option selected value='".($row['ShiftName'])."'>".($row['StartTime'])." - ".($row['EndTime'])."</option>";
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
	<link rel="stylesheet" href="../style/style5.css?<?php echo time(); ?>">
	<link rel="stylesheet" href="../style/style1.css?<?php echo time(); ?>">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
 </head>
<header>
    <ul>
		<li><a href="adminMain.php">Admin Main</a></li>
      	<li><a href="inventoryLog.php">Inventory Log</a></li>
      	<li><a href="scheduleGeneration.php">Schedule Generation</a></li>
	  	<li><a href="adminCreateUser.php">Employees</a></li>
      	<li style="float:right"><a class="active1" onclick="location.href='../index.php'">Log out</a></li>
    </ul>
</header>

<body style="margin-top: 2%">
<div class="wrapper">
<h1 class="center">Schedule Generation</h1>
	<button class="collapsible">Availability</button>
	<div class="content inside-table">
    <table id="avail" style="margin-bottom: 1%;">
        <?php
        // plan to add an automated date with the weekdays to make shcdule easier to read
        //ex Monday 15
        echo "<tr>";
            echo "<th>Employee</th>";
            echo "<th>Monday</th>";
            echo "<th>Tuesday</th>";
            echo "<th>Wednesday</th>";
            echo "<th>Thursday</th>";
            echo "<th>Friday</th>";
            echo "<th>Saturday</th>";
            echo "<th>Sunday</th>";
        echo "</tr>";
        //Selects all the data from the Users Table for use in getting the schedules
        $query = "SELECT * FROM Users WHERE Name='$companyName'";
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
	</div>

	<button class="collapsible">Edit Next Weeks Schedule</button>
	<div class="content inside-table">
	<table id="nextweekschedule" style="margin-bottom: 1%;">
		<?php
		// plan to add an automated date with the weekdays to make shcdule easier to read
		//ex Monday 15
		echo "<tr>";
		echo "<th>Employee</th>";
		echo "<th>Monday</th>";
		echo "<th>Tuesday</th>";
		echo "<th>Wednesday</th>";
		echo "<th>Thursday</th>";
		echo "<th>Friday</th>";
		echo "<th>Saturday</th>";
		echo "<th>Sunday</th>";
		echo "</tr>";
		
		//Selects all the data from the Users Table for use in getting the schedules
		$query = "SELECT * FROM Users WHERE isManager=0 AND Name='$companyName'";
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
		echo"<tr><td colspan='8' style='text-align: center;'><input type='Submit' name='editSchedule' value='Edit Schedule'></input></td></tr>";
		echo "</form>";
		?>
		<tr>
			<td colspan="8" style="text-align: center;">
				<form action='scheduleGeneration.php' method="post">
						<input type="submit" name="generateAI" value="Generate Schedule"/>
				</form>
			</td>
		</tr>

		<tr>
			<td colspan="8" style="text-align: center;">
				<form action='scheduleGeneration.php' method="post">
					<input type="submit" name="acceptSchedule" value="Accept Schedule">
				</form>
			</td>
		</tr>
	</table>

	</div>


	
	<button class="collapsible">Next Weeks Schedule</button>
	<div class="content inside-table">
	<table id="workSched" style="margin-bottom: 1%;">
        <?php
        echo "<tr>";
		echo "<th>Employee</th>";
		echo "<th>Monday</th>";
		echo "<th>Tuesday</th>";
		echo "<th>Wednesday</th>";
		echo "<th>Thursday</th>";
		echo "<th>Friday</th>";
		echo "<th>Saturday</th>";
		echo "<th>Sunday</th>";
		echo "</tr>";
		
        $query = "SELECT * FROM Users WHERE isManager=0 AND Name='$companyName'";
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
	</div>



	<button class="collapsible">Time Request Off</button>
	<div class="content inside-table">
    <table id="requestOff" style="margin-bottom: 1%;">
        <?php
        // plan to add an automated date with the weekdays to make shcdule easier to read
        //ex Monday 15
        echo "<tr>";
            echo "<th>Employee</th>";
            echo "<th>Start Date</th>";
            echo "<th>End Date</th>";
            echo "<th>Mandatory</th>";
        echo "</tr>";
        //Selects all the data from the Users Table for use in getting the schedules
        $query = "SELECT * FROM Users WHERE Name='$companyName'";
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
	</div>


	<button class="collapsible">Add Custom Shifts</button>
	<div class="content inside-table">
    <table>
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
	</div>

	<!-- This script is to make the tables collapsible -->
	<script>
	var coll = document.getElementsByClassName("collapsible");
	var i;

	for (i = 0; i < coll.length; i++) {
 		coll[i].addEventListener("click", function() {
   	 		this.classList.toggle("active");
    		var content = this.nextElementSibling;
    		if (content.style.maxHeight){
      			content.style.maxHeight = null;
    		} else {
      			content.style.maxHeight = content.scrollHeight + "px";
    		} 
  		});
	}
	</script>

	<!-- Footer -->
	<div class="push"></div>
	</div>
	<footer class="footer3 center">&#169 2021 Overseer</footer>

 </body>
 </html>