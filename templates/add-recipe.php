<!DOCTYPE html>
<!--Sources used: https://getbootstrap.com/, https://stackoverflow.com/questions/52324561/bootstrap-4-how-to-change-the-order-of-a-columns-when-the-screen-size-changes-->
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1"> 
            <meta name="author" content="Mainly made by Ellery, with edits from Maya">
            <meta name="description" content="Page with input fields for a user to add a new recipe to their cookbook.">
            <meta name="keywords" content="cookbook online meal prep planning recipes ingredients">   
            <title>Add recipe</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous">      
            <link rel="stylesheet" href="styles/main.css">
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
                                <a class="nav-link"  href="?command=calendar">Calendar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-disabled="true">Feed</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="?command=cookbook">Cookbook</a>
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
            <h1 class="myfont btn-marg">Add to Cookbook</h1>
            <?php if($loggedIn) : ?>
                <!--This is the container for all of the input fields.-->

                <form class="container" action = "?command=insertrecipe" method="post">
                    <?php if(!empty($message)): ?>
                        <p class='alert alert-danger'><?=$message?></p>
                    <?php endif; ?>
                    <input type="hidden" name="updateInfo" value="false">
                    <div class="row g-3">
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="recipeNameInput" class="form-label myfont">Recipe name</label>
                                <input type="text" class="form-control myfont" id="recipeNameInput" name="recipeNameInput" placeholder="Name" required>
                            </div>
                        </div>
                        <!--The tags/ingredients lists should grow as the user hits enter.  The ingredients list should check that it starts with a number.-->
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="ingredientsInput" class="form-label myfont">Ingredients</label>
                                <ul>
                                    <li class="myfont"></li>
                                    <li class="myfont"></li>
                                </ul>
                                <input type="text" class="form-control myfont" id="ingredientsInput" name="ingredientsInput" placeholder="New ingredient">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <label for="tagsInput" class="form-label myfont">Tags</label>
                                <ul>
                                    <li class="myfont"></li>
                                    <li class="myfont"></li>
                                </ul>
                                <input type="text" class="form-control myfont" id="tagsInput" name="tagsInput" placeholder="New tag">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <p class="myfont">Add an image for the recipe card!</p>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control myfont" id="recipeImageFile">
                                <label for="recipeImageFile"class="input-group-text myfont" >Upload</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-5 order-1 order-md-1">
                            <div class="form-floating">
                                <textarea class="form-control myfont" placeholder="Write the recipe here" id="recipeTextarea" name="recipeTextarea" style="height: 350px"></textarea>
                                <label class="myfont" for="recipeTextarea">Recipe</label>
                            </div>
                        </div>
                        <div class="col-md-5 order-2 order-md-2">
                            <div class="form-floating">
                                <textarea class="form-control myfont" placeholder="Write notes about the recipe here" id="notesTextarea" name="notesTextarea" style="height: 350px"></textarea>
                                <label class="myfont" for="notesTextarea">Notes</label>
                            </div>
                        </div>
                        <div class="col-md-2 order-3 order-md-3">
                            <button type="submit" class="btn addmeal-btn myfont">Add to Cookbook!</button>
                        </div>
                    </div>
                </form>
            <?php else : ?>
                <div class="container" style="margin-top: 15px;">
                    <h2 class="myfont btn-marg">Please log in to add to your cookbook!</h2>
                    <form action="?command=welcome" method="post">
                            <button type="submit" class="btn btn-primary">Log in</button>
                    </form>
                </div>
            <?php endif; ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        </body>
    </html>