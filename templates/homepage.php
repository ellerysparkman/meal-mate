<!DOCTYPE html>
<!--Sources used: https://getbootstrap.com/-->
<!-- Very simple skeleton of a homepage-->

<!-- LINK TO HOMEPAGE https://cs4640.cs.virginia.edu/ets4pkp/sprint2/index.html -->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="author" content="Mainly done by Ellery Sparkman, Maya Hesselroth made slight adjustments">
        <meta name="description" content="Homepage for MealMate">
        <meta name="keywords" content = "meal prep, online cookbook, recipes, meal planning">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous">      
        <link rel="stylesheet" type="text/css" href="../styles/main.css">
        <title>MealMate Home Page</title>   
    </head>  

    <body>
        <!-- center the logo on the top-->
    <!-- <header>
        <img src="images/mealmate-logo.png" alt="Mealmate logo" width="350" height="100">
    </header> -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="../images/mealmate-logo.png" alt="Mealmate logo" width="350" height="100">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/meal-mate/templates/calendar.php">Calendar</a>
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
        
        <div class="row jumbotron">
            <div class="col jumbotron-image">
                <img style="height: 370px" src="../images/mealprep-transparent.png" alt="meal prep image">
            </div>
            <div class= "col jumbotron-text">
                <h1 style="color:#a7c178; font-weight: bold" class ="myfont">welcome to mealmate, <?=$name?>!</h1>
                <p style="font-weight: bold; color: rgb(231, 230, 206)" class="myfont-alt">This can be your calendar, cookbook, and Pinterest board all in one. Plan your meals for the week with our easy-to-use calendar feature. Share your favorite recipes with friends. Add recipes to your cookbook that you want to cook again. Start today! </p>
                <div class="btn addmeal-btn">
                    <!-- Start button leads to calendar to add a recipe, but later it will lead to an account/profile page-->
                    <a class="myfont" href="/meal-mate/templates/calendar.php">Go to your calendar!</a>
                </div>
                <h1><?=$message?></h1>

    </div>




                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
 



