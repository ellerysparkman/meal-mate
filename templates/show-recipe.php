<!DOCTYPE html>
<!--Sources used: https://getbootstrap.com/-->
<!-- Very simple skeleton of a homepage-->

<!-- LINK TO HOMEPAGE https://cs4640.cs.virginia.edu/ets4pkp/sprint2/index.html -->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="author" content="Maya Hesselroth with edits from Ellery Sparkman">
        <meta name="description" content="Detailed view for a recipe">
        <meta name="keywords" content = "meal prep, online cookbook, recipes, meal planning">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous">      
        <link rel="stylesheet" type="text/css" href="styles/main.css">
        <title>Recipe</title>   
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
        <div class="container" style="margin-top: 15px;">
            <h1><?=$currRecipe[0]["name"]?></h1>
            <div class="row g-3"> 
                <div class="col-lg-3">
                    <div class="mb-3">
                        <h4>Ingredients</h4>
                            <!--Needs to loop through the items in the ingedients list once user is capable of adding them -->
                        <ul>
                            <li class="myfont"></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="mb-3">
                        <h4>Tags</h4>
                        <!--Needs to loop through the items in the tags list once user is capable of adding them -->
                        <ul>
                            <li class="myfont"></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h4>Image</h4>
                    <img src="images/noimage.jpg" alt="Placeholder to show there's no image." width="250" height="250">
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-5 order-1 order-md-1">
                    <h4>Recipe</h4>
                    <p><?=$currRecipe[0]["instructions"]?></p>
                </div>
                <div class="col-md-5 order-2 order-md-2">
                    <h4>Recipe</h4>
                    <p><?=$currRecipe[0]["notes"]?></p>
                </div>
                <div class="col-md-1 order-3 order-md-3">
                    <form action="?command=edit" method="post">
                        <input type="hidden" name="recipe_id" value=<?=$currRecipe[0]["recipe_id"]?>>
                        <button type="submit" class="btn addmeal-btn myfont">Edit</button>
                    </form>
                </div>
                <div class="col-md-1 order-4 order-md-4">
                    <form action="?command=delete" method="post">
                        <input type="hidden" name="recipe_id" value=<?=$currRecipe[0]["recipe_id"]?>>
                        <button type="submit" class="btn addmeal-btn myfont">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>