<!doctype html>
<html lang="en">
	<head>
        <title>MyCompany - ZyPop Web Templates</title>

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
        
         <!-- Main navigation -->
        <div id="sidebar">

            <div class="navbar-expand-md navbar-dark">

                <header class="d-none d-md-block">
                    <h1><span>my</span>website</h1>
                </header>


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

                            <div class="sidebar-box">
                                <h4>Search Reminders</h4>
                                <form class="form-inline my-2 my-lg-0">
                                    <input class="form-control mr-sm-2" type="text" name="ID" placeholder="User ID" aria-label="Search" maxlength="8">
                                    <button class="btn btn-secondary my-2 my-sm-0" id="search" name="search" type="submit">Search</button>
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
               <div class="container-fluid footer-container">
                    <footer class="footer">
                        <div class="footer-lists">
                            <div class="row">

                            </div>
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
        
        <!-- Unsure of what to change, etc: "#search" and '#dept'  -->      
        <script type="text/javascript">
        $('#search').click(function(){
            var d_id = $('#dept').find(":selected").val();
            $.ajax({
                type:'POST',
                url:'find_user_ajax.php',
                data:'d_id='+d_id,
                success:function(html){
                    $('#area_container').show();
                    $('#area_container').html(html);  
                }
            }); 		
        });
            
        $('#dept').change(function () {
            var u_id = $('#dept').find(":selected").val();
            $.ajax({
                type:'POST',
                url:'find_user_ajax.php',
                data:'d_id='+d_id,
                success:function(html){
                    $('#area_container').show();
                    $('#area_container').html(html);  
                }
            });
        });				
        </script>
    </body>
</html>
