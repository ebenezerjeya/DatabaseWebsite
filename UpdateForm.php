<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form-Create New Reminder</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Main CSS -->
    <link  rel="stylesheet" type= "text/css" href="style.css">

    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <?php
    session_start();
    $_SESSION['errorMessage']="";
    ?>
</head>
<style>
    .button {
        background-color: #2665bf;
        border: none;
        color: white;
        padding: 15px 25px;
        text-align: center;
        font-size: 20px;
        cursor: pointer;
    }
    .button:hover {
        background-color: skyblue;
    }
</style>
<body>

<?php
$reminder = $_SESSION['updateVar'];
include_once("db.php");
$query = "select * from reminder where Reminder_ID = ?";
$stmt = $db->prepare($query);
$stmt->bindParam(1, $reminder, PDO::PARAM_INT);
$stmt->execute();
$count = $stmt->rowCount();
if ($count > 0) {
    $query = "select * from reminder where Reminder_ID = ?";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $reminder, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchall();
    foreach ($results as $row) {
        $username = $row['User_ID'];
        $title = $row['Reminder_title'];
        $description = $row['Description'];
        $time = $row['Time'];
        $date =$row['Date'];
    }
    $query = "select * from `user` where User_ID = ?";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchall();
    foreach ($results as $row){
        $firstname = $row['First_Name'];
        $lastname = $row['Last_Name'];
        $email = $row['Email'];
    }
} else {
    header('Location: Form.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['updateConfirm'])) {
        include_once("db.php");
        $td = $_POST['date'];
        $td = date('Y-m-d', strtotime($td));

        if(strlen(trim($_POST['reminderTitle'])) == 0){
            $title=$title;
        }
        else{
            $title=$_REQUEST['reminderTitle'];
        }
        if(strlen(trim($_POST['reminderDescription'])) == 0){
            $description=$description;
        }
        else{
            $description=$_REQUEST['reminderDescription'];
        }

        $query = "UPDATE reminder SET Reminder_title = ?, Description = ?, `Date` = ? WHERE Reminder_ID = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $title, PDO::PARAM_STR);
        $stmt->bindParam(2, $description, PDO::PARAM_STR);
        $stmt->bindParam(3, $td, PDO::PARAM_STR);
        $stmt->bindParam(4, $reminder, PDO::PARAM_INT);
        $stmt->execute();
        header('Location: View.php');
    }
}
?>
<div id="sidebar">
    <!-- Main navigation items -->
    <nav class="navbar navbar-dark">
        <div id="mainNavbar">
            <ul>
                <li class="nav-item">
                    <button onclick="location.href = 'home.html';" id="HomeButton" class="button" >Back to Home</button>
                </li>
                <br>
                <li class="nav-item">
                    <button onclick="location.href = 'View.php';" id="ViewButton" class="button" >Go to View Instead</button>
                </li>

            </ul>
        </div>
    </nav>
</div>
</div>
</div>
<div id="content">
    <div id="content-wrapper">

        <!-- Jumbtron / Slider -->
        <div class="jumbotron-wrap">
            <div class="container-fluid">
                <div class="jumbotron jumbotron-narrow static-slider">
                    <h1 class="text-center">Update Reminder</h1>
                </div>
            </div>
        </div>

        <!-- Main content area -->
        <main class="container-fluid">
            <div class="row">

                <!-- Main content -->
                <div class="col-sm-8">
                    <article>
                        <h3>Form</h3>

                        <fieldset>

                            <form method="post" >
                                <div class="form-group">
                                    <label for="userID">User ID</label>
                                    <input type="text" class="form-control" id="userID" name="userID" placeholder="<?php echo $username?>" maxlength="8" >
                                </div>

                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" name="firstName" placeholder=" <?php echo $firstname?>" id="firstName">
                                </div>

                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" name="lastName" placeholder="<?php echo $lastname?>"  id="lastName">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail" >Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail" placeholder=" <?php echo $email?>" name="exampleInputEmail" aria-describeDBHy="emailHelp">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>


                                <div class="form-group">
                                    <label for="reminderTitle">Reminder Title</label>
                                    <textarea class="form-control" id="reminderTitle" name="reminderTitle" placeholder=" <?php echo $title?>" rows="1" maxlength="35"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="reminderDescription">Description</label>
                                    <textarea class="form-control" id="reminderDescription" name="reminderDescription" placeholder=" <?php echo $description?>" rows="3" maxlength="100"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="date" >Verify Date</label>
                                    <input type="date" class="form-control" placeholder=" <?php echo $date?>" id="date" name="date">
                                </div>
                                <button type="submit" class="btn btn-primary" name="updateConfirm">Submit</button></form>

                        </fieldset>


                    </article>
                </div>

            </div>
        </main>


    </div>
</div>
</body>
</html>