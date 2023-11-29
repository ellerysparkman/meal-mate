<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
    <head>
        <meta charset="UTF-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Ellery Sparkman">
        <meta name="description" content="Login Page">  
        <title>MealMate Welcome Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous">       
        <link rel="stylesheet" type="text/css" href="styles/main.css">
        <title>MealMate acount</title>   
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            //arrow function
            const add = a => a + 1;

            $(document).ready(function () {

                loginAttempts = document.getElementById("login-attempts");
                loginButton = document.getElementById("login-btn");
                var score = parseInt(sessionStorage.getItem("loginAttempts")) || 0;
                if (loginAttempts){
                    loginAttempts.innerHTML = score;
                }

                if (loginButton){
                    loginButton.addEventListener("click", function(event){
                        score = add(score);
                        var count = document.getElementById("login-attempts").textContent = score;
                        sessionStorage.setItem("loginAttempts", score);
                        console.log(count);
                    });
                }

                $("#more-details").on("click", function(){
                    $.ajax({
                        type: "GET",
                        url: "?command=getemail",
                        dataType: 'json',
                        success: function(response){
                            document.getElementById("emailp").innerHTML = "Email: " + response;
                            document.getElementById("emailp").style.display = 'block';
                            document.getElementById("hide-details").style.width = '100px';
                            document.getElementById("hide-details").style.display = 'block';
                        },
                        error: function(xhr, status, error){
                            console.error("AJAX Error:", status, error);
                            console.log("Response Text:", xhr.responseText);}
                    });

                    event.preventDefault();

                });

                $("#hide-details").on("click", function(){
                    document.getElementById("emailp").style.display = 'none';
                    document.getElementById("hide-details").style.display = 'none';

                });
            });
        </script>

    </head>
    <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="?command=enter">
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
        <?php if($loggedIn) : ?>
            <div class="container" style="margin-top: 15px;">
                <div class="row col-xs-12">
                    <h1>Welcome to mealmate!</h1>
                    <h5>You are currently logged in as <?=$name?>!</h5>
                    <br>
                    <h5>User information</h5>
                    <form>
                        <button id="more-details" type="submit" class="btn addmeal-btn">Show email</button>
                    </form>
                    <div id="details-container">
                        <p id="emailp" style="display:none"></p>
                    </div>
                    <button id="hide-details" style="display:none;" type="submit" class="btn addmeal-btn">Hide email</button>

                    <form action="?command=logout" method="post">
                        <button type="submit" class="btn addmeal-btn">Log out</button>
                    </form>
                </div>
            </div>
        <?php else : ?>
            <div class="container" style="margin-top: 15px;">
                <div class="row col-xs-12">
                    
                    <h1>Welcome to mealmate!</h1>
                    <h5>Already got an account? Log in here!</h5>
                    <p style="float:right">Login Attempts: <span id="login-attempts"></span></p>

                    <p> <?=$message?></p>

                    <form action="?command=login" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="passwd" class="form-label">Password</label>
                            <input type="password" class="form-control" id="passwd" name="passwd">
                        </div>
                        <button type="submit" id="login-btn" class="btn btn-primary">Log in!</button>
                    </form>
                </div>

                <div class="row col-xs-12" style = "margin-top: 20px;">
                    <h5>Otherwise, create an account below.</h5>
                    <form action="?command=register" method="post">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="passwd" class="form-label">Password</label>
                            <input type="password" class="form-control" id="passwd" name="passwd">
                        </div>
                        <button type="submit" class="btn btn-primary">Create account!</button>
                    </form>
                </div>            
            </div>
        <?php endif; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>