<!DOCTYPE html>
<!--Sources used: https://getbootstrap.com/-->
<!-- Very simple skeleton of a homepage-->

<!-- LINK TO HOMEPAGE https://cs4640.cs.virginia.edu/msh3dvn/sprint3/?command=enter -->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="author" content="Mainly done by Ellery Sparkman, Maya Hesselroth made slight adjustments">
        <meta name="description" content="Homepage for MealMate">
        <meta name="keywords" content = "meal prep, online cookbook, recipes, meal planning">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous">      
        <link rel="stylesheet" type="text/css" href="styles/main.css">
        <title>MealMate Home Page</title>   
    </head>  

    <body>
        <!-- center the logo on the top-->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="images/mealmate-logo.png" alt="Mealmate logo" width="350" height="100">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="?command=calendar">Calendar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-disabled="true">Feed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?command=cookbook">Cookbook</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-disabled="true">About us</a>
                        </li>
                        <li class="nav-item">
                            <!-- This would normally lead to a profile page, but currently just leads to the log in/out page -->
                            <a class="nav-link" href="?command=welcome">
                                <img src="images/profile-pic.png" alt="Profile picture" width="20" height="20">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- If user is logged in, greet them -->
        <?php if($loggedIn) : ?>
            <div class="row jumbotron">
                <div class="col jumbotron-image">
                    <img id ="mealprep2" style="height: 370px" src="images/mealprep-transparent.png" alt="meal prep image">
                </div>
                <div class= "col jumbotron-text">
                    <h1 style="color:#a7c178; font-weight: bold" class ="myfont">welcome to mealmate, <?=$name?>!</h1>
                    <p style="font-weight: bold; color: rgb(231, 230, 206)" class="myfont-alt">This can be your calendar, cookbook, and Pinterest board all in one. Plan your meals for the week with our easy-to-use calendar feature. Share your favorite recipes with friends. Add recipes to your cookbook that you want to cook again. Start today! </p>
                    <div class="btn homepage-btn" id = "bottom-button" onmouseover = "change()" onmouseout = "reverse()">
                        <!-- Button leads to the user's cookbook-->
                        <a class="myfont" id="mytext" href="?command=cookbook">Go to your cookbook!</a>
                    </div>
                </div>
            </div>
        <!-- If user isn't logged in, direct them to do so-->
        <?php else : ?>
            <div class="row jumbotron">
                <div class="col jumbotron-image">
                    <img id="mealprep" style="height: 370px" src="images/mealprep-transparent.png" alt="meal prep image">
                </div>
                <div class= "col jumbotron-text">
                    <h1 style="color:#a7c178; font-weight: bold" class ="myfont">welcome to mealmate!</h1>
                    <p style="font-weight: bold; color: rgb(231, 230, 206)" class="myfont-alt">This can be your calendar, cookbook, and Pinterest board all in one. Plan your meals for the week with our easy-to-use calendar feature. Share your favorite recipes with friends. Add recipes to your cookbook that you want to cook again. Start today! </p>
                    <div class="btn addmeal-btn">
                        <!-- Button leads to log in page-->
                        <a class="myfont" href="?command=welcome">Log in!</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script>

            function change(){
                var bottomButton = document.getElementById("bottom-button");
                var text = document.getElementById("mytext");
                if (bottomButton) {
                    bottomButton.style.backgroundColor = '#212b5c';  
                    mytext.style.color = "rgb(231, 230, 206)";   

            }}
            function reverse(){
                var bottomButton = document.getElementById("bottom-button");
                var text = document.getElementById("mytext");
                if (bottomButton) {
                    bottomButton.style.backgroundColor = '#64793c';    
                    text.style.color = '#0e1744'; 
            }}

            
            </script>
    </body>

</html>