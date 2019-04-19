<!doctype html>
<html lang="en">
	<head>
        <title>Form-Create New Reminder</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <!-- Main CSS --> 
        <link rel="stylesheet" href="css/style.css">

        <!-- Font Awesome -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
  
    <body>


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
                                    <?php
                                    if ($_SERVER['REQUEST_METHOD']=='POST') {

                                        include "dbconnection_pdo.php";

                                        $userID = $_POST['userID'];
                                        $fname = $_POST['First_Name'];
                                        $lname = $_POST['Last_Name'];
                                        $email = $_POST['email'];
                                        $reminder_Title = $_POST['reminder_Title'];
                                        $description = $_POST['description'];
                                        $time = $_POST['time'];
                                        $date = $_POST['date'];
                                        $all_day = $_POST['all_day'];

                                        $q = "Insert into EMPLOYEES (user_ID,FIRST_NAME,LAST_NAME,EMAIL,Reminder_title,description,`time`,`date`,all_day) VALUES (?,?,?,?,?,?,?,?,?)";
                                        $stmt = $DBH->prepare($q);
                                        $stmt->bindParam(1, $userID, PDO::PARAM_STR);
                                        $stmt->bindParam(2, $fname, PDO::PARAM_STR, 20);
                                        $stmt->bindParam(3, $lname, PDO::PARAM_STR, 25);
                                        $stmt->bindParam(4, $email, PDO::PARAM_STR, 25);
                                        $stmt->bindParam(5, $reminder_Title, PDO::PARAM_STR, 35);
                                        $stmt->bindParam(6, $description, PDO::PARAM_STR, 100);
                                        $stmt->bindParam(7, $time, PDO::PARAM_STR, 10);
                                        $stmt->bindParam(8, $date, PDO::PARAM_STR);
                                        $stmt->bindParam(9, $all_day, PDO::PARAM_BOOL);


                                        if (!$stmt->execute()){
                                            die('Could not enter data: ' . $stmt->error);
                                        }

                                        $stmt->close();


                                        $q = "SELECT count(*) FROM employees";
                                        $result = $DBH->prepare($q);
                                        $result->execute();
                                        $numEmp = $result->fetchColumn();

                                        // Free resultset
                                        $result->closeCursor();

                                        // Closing connection
                                        $DBH = null;
                                        ?>
                                        <div id="holder">
                                            <h1>An employee record has been inserted.</h1>
                                            <p>There are <?php echo $numEmp;?> employees.</p>
                                            <p><a href="employee_pdo.php">Click here to insert another record!</a></p>

                                        </div>
                                    <?php
                                    }
                                    else {
                                    ?>
                                        <div id="holder">
                                            <h1>Insert employee record</h1>
                                                <form action="form.php" method="post">
                                                    <div class="form-group">
                                                        <label for="userID">User ID</label>
                                                        <input type="text" class="form-control" id="userID" maxlength="8">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="firstName">First Name</label>
                                                        <input type="text" class="form-control" id="firstName">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="lastName">Last Name</label>
                                                        <input type="text" class="form-control" id="lastName">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail" >Email address</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
                                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="reminderTitle">Reminder Title</label>
                                                        <textarea class="form-control" id="reminderTitle" rows="1" maxlength="35"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="reminderDescription">Description</label>
                                                        <textarea class="form-control" id="reminderDescription" rows="3" maxlength="100"></textarea>
                                                    </div>
                                                    <?php
                                                    include "dbconnection_pdo.php";
                                                    $q = "SELECT department_id, department_name FROM departments ORDER BY department_name";
                                                    $empData = $DBH->query($q);
                                                    # setting the fetch mode
                                                    $empData->setFetchMode(PDO::FETCH_ASSOC);

                                                    while($row = $empData->fetch()) {
                                                        echo '<option value="'.$row['department_id'].'">'.$row['department_name'].'</option>';
                                                    }
                                                    ?>
                                                    </select>
                                                    </td>
                                                    </tr>
                                                    </table>
                                                    <input id="InsertEmp" type="submit" value="Insert">
                                                </form>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </fieldset>
                            </article>
                        </div>

                    </div>
                </main>
            </div>
        </div>
    </body>
</html>