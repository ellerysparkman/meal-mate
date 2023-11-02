<!DOCTYPE html>
<!--Sources used: https://getbootstrap.com/-->
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1"> 
            <meta name="author" content="Maya Hesselroth, Ellery Sparkman">
            <meta name="description" content="Page displaying a user's recipes.">
            <meta name="keywords" content="cookbook online meal prep planning recipes">   
            <title>Cookbook</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous">      
            <link rel="stylesheet" href="styles/main.css">
            <style>
                body {
                    font-family: Arial, sans-serif;
                }      
            </style>
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
                                <a class="nav-link" aria-disabled="true">
                                    <img src="images/profile-pic.png" alt="Profile bitch" width="20" height="20">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn addmeal-btn myfont" href="?command=showadd" role="button">Add a meal!</a>
                    </div>
                </div>
                <!--This is the column with the grid of recipies.  Three should be in a row on a large screen.-->

                <?php 
                // get recipes
                print_r($recipes);
                // show them in grid
                // for recipe in recipe
                ?> 




                <div class="col">
                    <div class="container cookbook">
                        <div class="row btn-marg">
                            <div class="col justify-self-start">
                                <div class="card recipe">
                                    <img src="images/dal.jpg" class="card-img-top cookbook-img" alt="A pot of dal.">
                                    <div class="card-body">
                                        <h4 class="myfont-alt">Vegetarian, Vegan, Healthy</h4>
                                        <a class="nav-link card-title myfont" href = "?command=showrecipe&recipe_id=<?php echo $recipes[0]['recipe_id'];?> " >Best Homemade Dal</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col justify-self-center">
                                <div class="card recipe">
                                    <img src="images/hamburger.jpg" class="card-img-top cookbook-img" alt="A hamburger.">
                                    <div class="card-body">
                                        <h4 class="myfont-alt">Red meat, Easy</h4>
                                        <h3 class="card-title myfont">Restaurant-Style Smash Burger</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col justify-self-end">
                                <div class="card recipe">
                                    <img src="images/naengmyeon.jpg" class="card-img-top cookbook-img" alt="A bowl of mul naengmyeon.">
                                    <div class="card-body">
                                        <h4 class="myfont-alt">Noodles, Korean, Healthy</h4>
                                        <h3 class="card-title myfont">Mul Naengmyeon From Scratch</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row btn-marg">
                            <div class="col justify-self-start">
                                <div class="card recipe">
                                    <img src="images/pancakes.jpg" class="card-img-top cookbook-img" alt="A plate of pancakes.">
                                    <div class="card-body">
                                        <h4 class="myfont-alt">Breakfast, Sweet, Easy</h4>
                                        <h3 class="card-title myfont">Fluffiest Whole Wheat Pancakes</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col justify-self-center cookbook-img">
                                <div class="card recipe">
                                    <img src="images/sasuage.jpg" class="card-img-top cookbook-img" alt="A pot of dal">
                                    <div class="card-body">
                                        <h4 class="myfont-alt">Chicken, Weeknight Dinners, One-Pan</h4>
                                        <h3 class="card-title myfont">Healthy Chicken Sausage Stir-Fry</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col justify-self-end">
                                <div class="card recipe">
                                    <img src="images/kale-salad.png" class="card-img-top cookbook-img" alt="A nutricious kale salad.">
                                    <div class="card-body">
                                        <h4 class="myfont-alt">Kale Salad, Quick</h4>
                                        <h3 class="card-title myfont">Kale Avocado Salad</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        </body>
    </html>