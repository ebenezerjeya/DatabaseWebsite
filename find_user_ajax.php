<?php
	include_once("db.php");
	session_start();
	if (isset($_POST["User_ID"]) && $_POST["User_ID"]) {
		$id = $_POST["User_ID"];
		$query = "select * from reminder where User_ID = ? order by date";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $id, PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetchall();
		echo '<div class="row">';
		echo '<div class="col-2 text-right"><h5><u>Reminder ID</u></h5></div>';
		echo '<div class="col-3 text-right"><h5><u>Reminder Title</u></h5></div>';
		echo '<div class="col-5 text-right"><h5><u>Description</u></h5></div>';
		echo '<div class="col-2 text-right"><h5><u>Time</u></h5></div>';
    	echo '<div class="col-2 text-right"><h5><u>Date</u></h5></div>';
		echo '</div>';
		foreach ($results as $row) {
			echo '<div class="row">';
			echo '<div class="col-2 text-right">'.$row['Reminder_ID'].'</div>';
			echo '<div class="col-3 text-right">'.$row['Reminder_Title'].'</div>';
			echo '<div class="col-5 text-right">'.$row['Description'].'</div>';
			echo '<div class="col-2 text-right">'.$row['Time'].'</div>';
			echo '<div class="col-2 text-right">'.$row['Date'].'</div>';
			echo '</div>';
		}
		$query = "select * from `user` where User_ID = ?";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $id, PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetchall();
		echo '<div class="row">';
		echo '<div class="col-3 text-right"><h5><u>First Name</u></h5></div>';
		echo '<div class="col-3 text-right"><h5><u>Last Name</u></h5></div>';
		echo '<div class="col-3 text-right"><h5><u>Email</u></h5></div>';
		echo '</div>';
		foreach ($results as $row) {
			echo '<div class="row">';
			echo '<div class="col-3 text-right">'.$row['First_Name'].'</div>';
			echo '<div class="col-3 text-right">'.$row['Last_Name'].'</div>';
			echo '<div class="col-3 text-right">'.$row['Email'].'</div>';
			echo '</div>';
		}
	}
	else{
		echo 'No Such ID';
	}
?>
