<!-- <?php 


// if(isset($_POST['submit'])&&!empty($_POST['submit'])){
    
//     // $hashpassword = md5($_POST['pwd']);
//     $sql ="select *from public.user where email = '".pg_escape_string($_POST['email'])."' and password ='".pg_escape_string($_POST['pwd'])."'";
//     $data = pg_query($dbconn,$sql); 
//     $login_check = pg_num_rows($data);
//     if($login_check > 0){ 
        
//         echo "Login Successfully";    
//     }else{ 
//         echo "Invalid Details";
//     }
// }
?> -->


<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="ELlery Sparkman">
  <meta name="description" content="Login Page">  
  <title>MealMate Welcome Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous">       
</head>

<body>

<div class="container" style="margin-top: 15px;">
    <div class="row col-xs-12">
        <h1>Welcome to mealmate!</h1>
        <h5>Already got an account? Log in here!</h5>

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

            <button type="submit" class="btn btn-primary">Start!</button>
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

            <button type="submit" class="btn btn-primary">Start!</button>
        </form>
    </div>

            
 </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>