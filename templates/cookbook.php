<!DOCTYPE html>
<!--Sources used: https://getbootstrap.com/-->
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1"> 
            <meta name="author" content="Maya Hesselroth">
            <meta name="description" content="Page displaying a user's recipies.">
            <meta name="keywords" content="cookbook online meal prep planning recipes">   
            <title>Cookbook</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous">      
            <link rel="stylesheet" href="styles/main.css">
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
                .recipeHover {
                    transform: scale(1.05);
                }      
            </style>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script>
                $(document).ready(function() {

                    $(".recipe").on("mouseover", function(){
                        $(this).addClass("recipeHover");
                    });
                    $(".recipe").on("mouseout", function(){
                        $(this).removeClass("recipeHover");
                    });
                });
            </script>
        </head>  

        <body>
            <!--The links in the navbar that lead to pages that don't exist are set as disabled-->
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="?command=enter">
                        <img src="images/mealmate-logo.png" alt="Meal mate logo" width="350" height="100">
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
                                <a class="nav-link active" aria-current="page" href="#">Cookbook</a>
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
            <div class="row btn-marg">
                <div class="col-lg-3">
                    <!--This column has the sidebar for searching, filtering, and adding a new recipe.-->
                    <div class="container sidebar">
                        <h1 class="myfont btn-marg">My Cookbook</h1>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2 myfont" type="search" placeholder="Search recipes..." aria-label="Search">
                            <button class="btn btn-outline-success btn-marg myfont" type="submit">Search</button>
                        </form>
                        <div class="accordion" id="filterbytags">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed myfont" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                        Search filters
                                    </button>
                                </h2>
                                <!--The accordion holds a list of tags to filter by.  In the future, it would sort the list of visible recipies to only include
                                ones with the selected tags.  Right now, checking the boxes does nothing.-->
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <?php if($loggedIn) : ?>
                                            <ul>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="breakfastFlexCheck">
                                                        <label class="form-check-label" for="breakfastFlexCheck">
                                                            Breakfast
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="easyFlexCheck">
                                                        <label class="form-check-label" for="easyFlexCheck">
                                                            Easy
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="chickenFlexCheck">
                                                        <label class="form-check-label" for="chickenFlexCheck">
                                                            Chicken
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn addmeal-btn myfont" href="?command=addrecipe" role="button">Add a meal!</a>
                    </div>
                </div>
                <!--This is the column with the grid of recipies.  Three should be in a row on a large screen.-->
                <?php if($loggedIn) : ?>
                    <div class="col">
                        <div class="container cookbook">
                            <?php foreach(array_chunk($recipes, 3, true) as $chunk): ?>
                                <div class="row btn-marg">
                                <?php foreach($chunk as $k => $v): ?>
                                    <div class="col recipeParent">
                                        <div class="card recipe">
                                            <img src="images/noimage.jpg" class="card-img-top cookbook-img" alt="Placeholder to show there's no image.">
                                            <div class="card-body">
                                                <?php 
                                                    $tagStr = "";
                                                    //Code for when user can actually add tags
                                                    //foreach($v["tags"] as $tag){
                                                        //$tagStr .= $tag . " ";
                                                    //}
                                                ?>
                                                <h4 class="myfont-alt"><?=$tagStr?></h4>
                                                <form action="?command=viewrecipe" method="post">
                                                    <input type="hidden" name="recipe_id" value=<?=$v["recipe_id"]?>>
                                                    <button type="submit" class="card-title myfont"><?=$v["name"]?></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="col">
                        <div class="container cookbook">
                            <h2>Log in to view the recipes in your cookbook!<h2>
                            <form action="?command=welcome" method="post">
                                <button type="submit" class="btn btn-primary">Log in</button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        </body>
    </html>