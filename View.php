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
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        include_once("db.php");
        $query = "select * from reminder where User_ID =? order by date";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $_POST['ID'], PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        $results = $stmt->fetchAll();
        if ($count > 0) {
            foreach ($results as $row) {
                $id = $row['Reminder_ID'];
                $uid = $row['User_ID'];
                $title = $row['Reminder_title'];
                $descrip = $row['Description'];
                $date = $row['Date'];
                $time = $row['Time'];

                echo '<option style="color: #000; font-weight: bold;" value="' . $uid . '">' . $title . '</option>';
            }
        } else {
            echo '<option value="0">User ID does not exist</option>';
        }
    }
        ?>
         <!-- Main navigation -->
        <div id="sidebar">

            <div class="navbar-expand-md navbar-dark">
                <!-- Mobile menu toggle and header -->
                <div class="mobile-header-controls">
                    <a class="navbar-brand d-md-none d-lg-none d-xl-none" href="#"><span>my</span>website</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#SidebarContent" aria-controls="SidebarContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <div id="SidebarContent" class="collapse flex-column navbar-collapse">



                    <!-- Main navigation items -->
                    <nav class="navbar navbar-dark">
                        <div id="mainNavbar">
                            <ul class="flex-column mr-auto">
                                <li class="nav-item">
                                    <button onclick="location.href = 'Home.html';" id="HomeButton" class="button" >Home</button>
                                </li>

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
                            <div class="sidebar-box">

                            </div>

                            <div>
                                <h4>Search Reminders</h4>
                                <form action="view.php" method="post">
                                        <input type="text" class="form-control" id="ID" name="ID" maxlength="8">

                                    <button id="search" name="search" type="submit" class="button">Search</button>
                                </form>
                            </div>

                            <div class="sidebar-box">

                            </div>
                        </aside>

                        <!-- Main content -->
                        <div class="col-md-8">


                       </div>
                    </div>
                </main>


                <!-- Footer -->
               <div class="container-fluid footer-container" id="area_container" name="area_container">
                    <footer class="footer">
                        <div class="footer-lists">
                            <!-- Unsure of what to change, etc: "#search" and '#dept'  -->
                            <script type="text/javascript">
                                $('#search').click(function(){
                                    var User_ID = $('#search').find(":selected").val();
                                    $.ajax({
                                        type:'POST',
                                        url:'find_user_ajax.php',
                                        data:'User_ID='+User_ID,
                                        success:function(html){
                                            $('#area_container').show();
                                            $('#area_container').html(html);
                                        }
                                    });
                                });
                            </script>
                        </div>

                    </footer>
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

    </body>
</html>
