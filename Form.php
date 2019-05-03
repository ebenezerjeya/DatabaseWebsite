<!DOCTYPE html>
<html lang="en">
	<head>
        <title>Form-Create New Reminder</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <!-- Main CSS -->
        <link rel="stylesheet" href="style.css">

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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include_once("db.php");
        $query = "select * from `user` where User_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $_POST['userID'], PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count > 0) {
            $td=$_POST['date'];
            $td=date('Y-m-d',strtotime($td));
            $tc=$_POST['time'];
            $tc=date('G:i:s', strtotime($tc));
            $query = "insert into reminder (User_id, reminder_title, description, `Date`) values (?,?,?,?)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(1, $_POST['userID'], PDO::PARAM_STR);
            $stmt->bindParam(2, $_POST['reminderTitle'], PDO::PARAM_STR);
            $stmt->bindParam(3, $_POST['reminderDescription'], PDO::PARAM_STR);
            $stmt->bindParam(4, $td, PDO::PARAM_STR);

            $stmt->execute();
            header('Location: View.php');
        } else {
            // insert a new instructor
            $query = "insert into `user` (User_ID, First_name, Last_name, email) values (?,?,?,?)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(1, $_POST['userID'], PDO::PARAM_STR);
            $stmt->bindParam(2, $_POST['firstName'], PDO::PARAM_STR);
            $stmt->bindParam(3, $_POST['lastName'], PDO::PARAM_STR);
            $stmt->bindParam(4, $_POST['exampleInputEmail'], PDO::PARAM_STR);
            $stmt->execute();
            $td=$_POST['date'];
            $td=date('Y-m-d',strtotime($td));
            $tc=$_POST['time'];
            $tc=date('G:i:s', strtotime($tc));
            $query = "insert into reminder (User_ID, reminder_title, description, `Date`) values (?,?,?,?)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(1, $_POST['userID'], PDO::PARAM_STR);
            $stmt->bindParam(2, $_POST['reminderTitle'], PDO::PARAM_STR);
            $stmt->bindParam(3, $_POST['reminderDescription'], PDO::PARAM_STR);
            $stmt->bindParam(4, $td, PDO::PARAM_STR);
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
                            <h1 class="text-center">Make New Reminder</h1>
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

                                    <form action="form.php" method="post">
                                    <div class="form-group">
                                        <label for="userID">User ID</label>
                                        <input type="text" class="form-control" id="userID" name="userID" maxlength="8">
                                    </div>

                                    <div class="form-group">
                                        <label for="firstName">First Name</label>
                                        <input type="text" class="form-control" name="firstName" id="firstName">
                                    </div>

                                    <div class="form-group">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" class="form-control" name="lastName" id="lastName">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail" >Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail" name="exampleInputEmail" aria-describeDBHy="emailHelp">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>


                                    <div class="form-group">
                                        <label for="reminderTitle">Reminder Title</label>
                                         <textarea class="form-control" id="reminderTitle" name="reminderTitle" rows="1" maxlength="35"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="reminderDescription">Description</label>
                                        <textarea class="form-control" id="reminderDescription" name="reminderDescription" rows="3" maxlength="100"></textarea>
                                    </div>


                                        <div class="form-group">
                                            <label for="date" >Date</label>
                                            <input type="date" class="form-control" id="date" name="date">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button></form>

                                </fieldset>


                            </article>
                        </div>

                    </div>
                </main>


            </div>
        </div>
    </body>
</html>
