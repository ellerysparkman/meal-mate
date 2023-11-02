<!DOCTYPE html>
<!--Sources used: https://getbootstrap.com/, https://stackoverflow.com/questions/52324561/bootstrap-4-how-to-change-the-order-of-a-columns-when-the-screen-size-changes-->
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1"> 
            <meta name="author" content="Mainly made by Maya Hesselroth, with edits from Ellery">
            <meta name="description" content="Page with input fields for a user to add a new recipe to their cookbook.">
            <meta name="keywords" content="cookbook online meal prep planning recipes ingredients">   
            <title><?=$name?></title>
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
                                <a class="nav-link" aria-disabled="true">
                                    <img src="images/profile-pic.png" alt="Profile picture" width="20" height="20">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <h1 class="myfont btn-marg"><?=$recipe_name?></h1>