<!DOCTYPE html>
<!-- Sprint 2 MealMate with Maya Hesselroth -->
<!--Sources used: https://getbootstrap.com/, 
https://mdbootstrap.com/docs/standard/plugins/calendar/ 
https://mdbootstrap.com/docs/b4/jquery/plugins/full-calendar/ 
-->

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="author" content="Mainly Ellery Sparkman, Maya Hesselroth added the responsive design">
        <meta name="description" content="Homepage for MealMate">
        <meta name="keywords" content = "meal prep, online cookbook, recipes, meal planning">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous">      
        <link rel="stylesheet" type="text/css" href="../styles/main.css">
        <title>MealMate Calendar</title>   
        <style>
            body {
            font-family: Arial, sans-serif;
        }
        </style>
    </head>  

    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/meal-mate/templates/homepage.php">
                    <img src="../images/mealmate-logo.png" alt="Mealmate logo" width="350" height="100">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link"  aria-current="page" href="#">Calendar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-disabled="true">Feed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/meal-mate/templates/cookbook.php">Cookbook</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-disabled="true">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-disabled="true">
                                <img src="../images/profile-pic.png" alt="Profile picture" width="20" height="20">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <!--These buttons currently don't do anything.  Add meal is refering to adding an exisiting recipe to the calendar, not
            adding a new recipe to the database.-->
            <div class="btn addmeal-btn">
                <a class="myfont">Add Meal</a>
            </div>
            <div class="btn addmeal-btn">
                <a class="myfont">Generate Shopping List</a>
            </div>
            <div class="container mt-2">
                <h1 class="myfont text-center">Weekly Planner</h1>
                <h4 class="myfont text-center">Oct 4 - 11</h4>
                <!--This grid displays the seven days of the week.-->
                <div class="row planner">
                    <!-- col-lg-1-4 is a custom column width in the css -->
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Sunday</h3>
                            <!--There will be a list of added meals under each meal class, with a close button to remove them.-->
                            <div class="meal">Breakfast:</div>
                            <div class="meal">Lunch:</div>
                            <div class="meal">Dinner:</div>
                            <div class="meal">Other:</div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Monday</h3>
                            <div class="meal">Breakfast:</div>
                            <div class="meal">Lunch:</div>
                            <div class="meal">Dinner:</div>
                            <div class="meal">Other:</div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Tuesday</h3>
                            <div class="meal">Breakfast:</div>
                            <div class="meal">Lunch:</div>
                            <div class="meal">Dinner:</div>
                            <div class="meal">Other:</div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Wednesday</h3>
                            <div class="meal">Breakfast:</div>
                            <div class="meal">Lunch:</div>
                            <div class="meal">Dinner:</div>
                            <div class="meal">Other:</div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Thursday</h3>
                            <div class="meal">Breakfast:</div>
                            <div class="meal">Lunch:</div>
                            <div class="meal">Dinner:</div>
                            <div class="meal">Other:</div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Friday</h3>
                            <div class="meal">Breakfast:</div>
                            <div class="meal">Lunch:</div>
                            <div class="meal">Dinner:</div>
                            <div class="meal">Other:</div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Saturday</h3>
                            <div class="meal">Breakfast:</div>
                            <div class="meal">Lunch:</div>
                            <div class="meal">Dinner:</div>
                            <div class="meal">Other:</div>
                        </div>
                    </div>
                </div>
                <!--This button doesn't do anything right now-->
                <!-- <div class="btn fixed-btn">
                    <a class="myfont">Make an account!</a>
                </div> -->
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
 



