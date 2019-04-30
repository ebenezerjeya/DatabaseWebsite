<!doctype html>
<html lang="en">
<head>
    <title>View Reminders</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Main CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<style>
    .button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 25px;
        text-align: center;
        font-size: 20px;
        cursor: pointer;
    }
    .button:hover {
        background-color: green;
    }
</style>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['updateButton'])){
        session_start();
            $_SESSION['updateVar'] = $_POST['updateButton'];
            header("Location: UpdateForm.php");
    }
    elseif(isset($_POST['delete'])) {
        session_start();
        include_once("db.php");
        $query = "select * from reminder where Reminder_ID = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $_POST['delete'], PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $query = "delete from reminder where Reminder_ID = ?";
            $stmt = $db->prepare($query);
            $stmt->bindParam(1, $_POST['delete'], PDO::PARAM_INT);
            $stmt->execute();
            $message = "Deletion complete";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            $message = "Reminder ID not found";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
}
?>;
<!-- Main navigation -->
<div id="sidebar">
    <!-- Main navigation items -->
    <nav class="navbar navbar-dark">
        <div id="mainNavbar">
            <ul>
                <li class="nav-item">
                    <button onclick="location.href = 'Home.html';" id="HomeButton" class="button" >Back to Home</button>
                </li>
                <br>
                <li class="nav-item">
                    <button onclick="location.href = 'Form.php';" id="FormButton" class="button" >Create New Reminder</button>
                </li>

            </ul>
        </div>
    </nav>
</div>
</div>
</div>


<div id="content">
    <div id="content-wrapper">

        <!-- Main content area -->
        <main class="container-fluid">
            <div class="row">

                <!-- Sidebar -->
                <aside class="col-md-4">
                    <div>
                        <h4>Search Reminders</h4>
                        <form action="View.php" method="post">
                            <input type="text" class="form-control" id="User_ID" name="User_ID" placeholder="User ID" maxlength="8">

                            <button id="search" name="search" type="button" class="button">Search</button>
                        </form>
                    </div>
                </aside>

                <!-- Main content -->

            </div>
        </main>


        <!-- Footer -->

        <div class="container" id="tabledisplay" name="tabledisplay"></div>

        <div class="container-fluid footer-container">
            <aside class="col-md-3">
                <div>
                    <form action="view.php" method="post">
                        <label for="delete">Delete Reminder</label>
                        <input type="text" class="form-control" id="delete" name="delete" placeholder="Reminder ID" maxlength="8">

                        <button type="submit" class="button" value="delete">Delete Reminder</button>

                    </form>
                    <br>
                    <form method="post">
                        <label for="update">Update Reminder</label>
                        <input type="text" class="form-control" id="updateButton" placeholder="Reminder ID" name="updateButton" maxlength="8">

                        <button type="submit" class="button">Update Reminder</button>
                    </form>
                </div>
            </aside>
        </div>
    </div>
</div>
<!-- Bootcamp JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script type="text/javascript"
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>

<script type="text/javascript">
    $('#search').click(function(){
        var User_ID = $('#User_ID').val();
        $.ajax({
            type:'POST',
            url:'find_user_ajax.php',
            data:'User_ID='+User_ID,
            success:function(html){
                $('#tabledisplay').show();
                $('#tabledisplay').html(html);
            }
        });
    });
</script>
</body>
</html>
