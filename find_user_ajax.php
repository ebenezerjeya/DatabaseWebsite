<?php
	include_once("db.php");
	session_start();
	$query = "select * from reminder where User_ID = ?";
	$stmt = $db->prepare($query);
	$stmt->bindParam(1, $_POST['User_ID'], PDO::PARAM_STR);
	$stmt->execute();
	$count = $stmt->rowCount();
	if($count > 0) {
		$id = $_POST["User_ID"];
		$query = "select * from reminder where User_ID = ? order by date";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $id, PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetchall();
		echo "<br>";
		echo '<div class="row">';
		echo '<div class="col-2 text-middle"><h5><u>Reminder ID</u></h5></div>';
		echo '<div class="col-2 text-left"><h5><u>Date</u></h5></div>';
		//echo '<div class="col-1 text-middle"><h5><u>Time</u></h5></div>';
		echo '<div class="col-2 text-middle"><h5><u>Reminder Title</u></h5></div>';
		echo '<div class="col-3 text-middle"><h5><u>Description</u></h5></div>';
		echo '</div>';

		foreach ($results as $row) {
			echo '<div class="row">';
			echo '<div class="col-2 text-middle">'.$row['Reminder_ID'].'</div>';
			echo '<div class="col-2 text-middle">'.$row['Date'].'</div>';
			//echo '<div class="col-1 text-middle">'.$row['Time'].'</div>';
			echo '<div class="col-2 text-middle">'.$row['Reminder_title'].'</div>';
			echo '<div class="col-3 text-middle">'.$row['Description'].'</div>';
			echo '</div>';
		}

		echo "<br>";
		echo "<br>";

		$query = "select * from `user` where User_ID = ?";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $id, PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetchall();
		echo '<div class="row">';
		echo '<div class="col-2 text-middle"><h5><u>First Name</u></h5></div>';
		echo '<div class="col-2 text-middle"><h5><u>Last Name</u></h5></div>';
		echo '<div class="col-2 text-middle"><h5><u>Email</u></h5></div>';
		echo '</div>';
		foreach ($results as $row) {
			echo '<div class="row">';
			echo '<div class="col-2 text-middle">'.$row['First_Name'].'</div>';
			echo '<div class="col-2 text-middle">'.$row['Last_Name'].'</div>';
			echo '<div class="col-2 text-middle">'.$row['Email'].'</div>';
			echo '</div>';
		}
		echo "<br>";
	}
	else{
		$message = "User ID not found";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo '<script type="text/javascript">location.reload(true);</script>';
	}
?>
