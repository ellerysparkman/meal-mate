<!DOCTYPE html>
<!--Sources used: https://getbootstrap.com/, 
https://mdbootstrap.com/docs/standard/plugins/calendar/ 
https://mdbootstrap.com/docs/b4/jquery/plugins/full-calendar/ 
-->

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="author" content="Maya Hesselroth and Ellery Sparkman">
        <meta name="description" content="Homepage for MealMate">
        <meta name="keywords" content = "meal prep, online cookbook, recipes, meal planning">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous">      
        <link rel="stylesheet" type="text/css" href="styles/main.css">
        <title>MealMate Calendar</title>   
        <style>
            body {
            font-family: Arial, sans-serif;
        }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script>
                function Day (brLs, luLs, diLs, otLs){
                    this.breakfast = brLs;
                    this.lunch = luLs;
                    this.dinner = diLs;
                    this.other = otLs;
                }

                var setDays = <?php echo json_encode($loadDays); ?>;

                $(document).ready(function() {

                    if(setDays){
                        //Monday
                        var oldmon = <?php echo json_encode($oldMon); ?>;
                        var monday = JSON.parse(oldmon);
                        for(let i = 0; i < monday.breakfast.length; i++){
                            $("#monb").append("<p>" + monday.breakfast[i] + "</p>");
                        }
                        for(let i = 0; i < monday.lunch.length; i++){
                            $("#monl").append("<p>" + monday.lunch[i] + "</p>");
                        }
                        for(let i = 0; i < monday.dinner.length; i++){
                            $("#mond").append("<p>" + monday.dinner[i] + "</p>");
                        }
                        for(let i = 0; i < monday.other.length; i++){
                            $("#mono").append("<p>" + monday.other[i] + "</p>");
                        }

                        //Tuesday
                        var oldtue = <?php echo json_encode($oldTue); ?>;
                        var tuesday = JSON.parse(oldtue);
                        for(let i = 0; i < tuesday.breakfast.length; i++){
                            $("#tueb").append("<p>" + tuesday.breakfast[i] + "</p>");
                        }
                        for(let i = 0; i < tuesday.lunch.length; i++){
                            $("#tuel").append("<p>" + tuesday.lunch[i] + "</p>");
                        }
                        for(let i = 0; i < tuesday.dinner.length; i++){
                            $("#tued").append("<p>" + tuesday.dinner[i] + "</p>");
                        }
                        for(let i = 0; i < tuesday.other.length; i++){
                            $("#tueo").append("<p>" + tuesday.other[i] + "</p>");
                        }

                        //Wednesday
                        var oldwed = <?php echo json_encode($oldWed); ?>;
                        var wednesday = JSON.parse(oldwed);
                        for(let i = 0; i < wednesday.breakfast.length; i++){
                            $("#wedb").append("<p>" + wednesday.breakfast[i] + "</p>");
                        }
                        for(let i = 0; i < wednesday.lunch.length; i++){
                            $("#wedl").append("<p>" + wednesday.lunch[i] + "</p>");
                        }
                        for(let i = 0; i < wednesday.dinner.length; i++){
                            $("#wedd").append("<p>" + wednesday.dinner[i] + "</p>");
                        }
                        for(let i = 0; i < wednesday.other.length; i++){
                            $("#wedo").append("<p>" + wednesday.other[i] + "</p>");
                        }

                        //Thursday
                        var oldthu = <?php echo json_encode($oldThu); ?>;
                        var thursday = JSON.parse(oldthu);
                        for(let i = 0; i < thursday.breakfast.length; i++){
                            $("#thub").append("<p>" + thursday.breakfast[i] + "</p>");
                        }
                        for(let i = 0; i < thursday.lunch.length; i++){
                            $("#thul").append("<p>" + thursday.lunch[i] + "</p>");
                        }
                        for(let i = 0; i < thursday.dinner.length; i++){
                            $("#thud").append("<p>" + thursday.dinner[i] + "</p>");
                        }
                        for(let i = 0; i < thursday.other.length; i++){
                            $("#thuo").append("<p>" + thursday.other[i] + "</p>");
                        }

                        //Friday
                        var oldfri = <?php echo json_encode($oldFri); ?>;
                        var friday = JSON.parse(oldfri);
                        for(let i = 0; i < friday.breakfast.length; i++){
                            $("#frib").append("<p>" + friday.breakfast[i] + "</p>");
                        }
                        for(let i = 0; i < friday.lunch.length; i++){
                            $("#fril").append("<p>" + friday.lunch[i] + "</p>");
                        }
                        for(let i = 0; i < friday.dinner.length; i++){
                            $("#frid").append("<p>" + friday.dinner[i] + "</p>");
                        }
                        for(let i = 0; i < friday.other.length; i++){
                            $("#frio").append("<p>" + friday.other[i] + "</p>");
                        }

                        //Saturday
                        var oldsat = <?php echo json_encode($oldSat); ?>;
                        var saturday = JSON.parse(oldsat);
                        for(let i = 0; i < saturday.breakfast.length; i++){
                            $("#satb").append("<p>" + saturday.breakfast[i] + "</p>");
                        }
                        for(let i = 0; i < saturday.lunch.length; i++){
                            $("#satl").append("<p>" + saturday.lunch[i] + "</p>");
                        }
                        for(let i = 0; i < saturday.dinner.length; i++){
                            $("#satd").append("<p>" + saturday.dinner[i] + "</p>");
                        }
                        for(let i = 0; i < saturday.other.length; i++){
                            $("#sato").append("<p>" + saturday.other[i] + "</p>");
                        }

                        //Sunday
                        var oldsun = <?php echo json_encode($oldSun); ?>;
                        var sunday = JSON.parse(oldsun);
                        for(let i = 0; i < sunday.breakfast.length; i++){
                            $("#sunb").append("<p>" + sunday.breakfast[i] + "</p>");
                        }
                        for(let i = 0; i < sunday.lunch.length; i++){
                            $("#sunl").append("<p>" + sunday.lunch[i] + "</p>");
                        }
                        for(let i = 0; i < sunday.dinner.length; i++){
                            $("#sund").append("<p>" + sunday.dinner[i] + "</p>");
                        }
                        for(let i = 0; i < sunday.other.length; i++){
                            $("#suno").append("<p>" + sunday.other[i] + "</p>");
                        }
                    }
                    else{
                        var monday = new Day([], [], [], []);
                        var tuesday = new Day([], [], [], []);
                        var wednesday = new Day([], [], [], []);
                        var thursday = new Day([], [], [], []);
                        var friday = new Day([], [], [], []);
                        var saturday = new Day([], [], [], []);
                        var sunday = new Day([], [], [], []);
                        
                    }

                    //Set hidden fields
                    $("#monhid").val(JSON.stringify(monday));
                    $("#tuehid").val(JSON.stringify(tuesday));
                    $("#wedhid").val(JSON.stringify(wednesday));
                    $("#thuhid").val(JSON.stringify(thursday));
                    $("#frihid").val(JSON.stringify(friday));
                    $("#sathid").val(JSON.stringify(saturday));
                    $("#sunhid").val(JSON.stringify(sunday));

                    $(".day-dropdown-item").on("click", function(){
                        $("#dayDropdown").val($(this).html());
                        $("#dayDropdown").html($(this).html());
                    });

                    $(".meal-dropdown-item").on("click", function(){
                        $("#mealDropdown").val($(this).html());
                        $("#mealDropdown").html($(this).html());
                    });

                    $("#addmealBtn").on("click", function(){
                        let currMeal = $("#mealNameInput").val();
                        //Make sure that a meal name was submitted
                        if(currMeal != ""){
                            let currDay = $("#dayDropdown").val();
                            currDay = currDay.toLowerCase();
                            let currTime = $("#mealDropdown").val();
                            currTime = currTime.toLowerCase();
                            //idStr is the first 3 letters of day plus first letter of meal time ex. monb = monday breakfast
                            let idStr = currDay.substr(0, 3);
                            idStr = idStr + currTime.substr(0, 1);
                            $("#" + idStr).append("<p>" + currMeal + "</p>");

                            if(currDay == "monday"){
                                monday[currTime].push(currMeal);
                                $("#monhid").val(JSON.stringify(monday));
                            }
                            if(currDay == "tuesday"){
                                tuesday[currTime].push(currMeal);
                                $("#tuehid").val(JSON.stringify(tuesday));
                            }
                            if(currDay == "wednesday"){
                                wednesday[currTime].push(currMeal);
                                $("#wedhid").val(JSON.stringify(wednesday));
                            }
                            if(currDay == "thursday"){
                                thursday[currTime].push(currMeal);
                                $("#thuhid").val(JSON.stringify(thursday));
                            }
                            if(currDay == "friday"){
                                friday[currTime].push(currMeal);
                                $("#frihid").val(JSON.stringify(friday));
                            }
                            if(currDay == "saturday"){
                                saturday[currTime].push(currMeal);
                                $("#sathid").val(JSON.stringify(saturday));
                            }
                            if(currDay == "sunday"){
                                sunday[currTime].push(currMeal);
                                $("#sunhid").val(JSON.stringify(sunday));
                            }

                            $("#mealNameInput").val("");
                        }
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
                            <a class="nav-link" href="#">Calendar</a>
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
        <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3 row" style="padding-top:30px">
                            <label for="mealNameInput" class="col-sm-2 col-form-label myfont">Meal name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control myfont" id="mealNameInput" placeholder="Meal">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle addmeal-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dayDropdown" value="Sunday">
                                Sunday
                            </button>
                            <ul class="dropdown-menu">
                                <li><p class="day-dropdown-item myfont" style="text-align:center">Sunday</p></li>
                                <li><p class="day-dropdown-item myfont" style="text-align:center">Monday</p></li>
                                <li><p class="day-dropdown-item myfont" style="text-align:center">Tuesday</p></li>
                                <li><p class="day-dropdown-item myfont" style="text-align:center">Wednesday</p></li>
                                <li><p class="day-dropdown-item myfont" style="text-align:center">Thursday</p></li>
                                <li><p class="day-dropdown-item myfont" style="text-align:center">Friday</p></li>
                                <li><p class="day-dropdown-item myfont" style="text-align:center">Saturday</p></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle addmeal-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="mealDropdown" value="Breakfast">
                                Breakfast
                            </button>
                            <ul class="dropdown-menu">
                                <li><p class="meal-dropdown-item myfont" style="text-align:center">Breakfast</p></li>
                                <li><p class="meal-dropdown-item myfont" style="text-align:center">Lunch</p></li>
                                <li><p class="meal-dropdown-item myfont" style="text-align:center">Dinner</p></li>
                                <li><p class="meal-dropdown-item myfont" style="text-align:center">Other</p></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div id="addmealBtn" class="btn addmeal-btn">
                            <a class="myfont" >Add Meal</a>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div id="generate-list" class="btn addmeal-btn">
                            <a class="myfont" >Generate Shopping List</a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <form class="container" action = "?command=savecalendar" method="post">
                            <input type="hidden" name="monday" id="monhid">
                            <input type="hidden" name="tuesday" id="tuehid">
                            <input type="hidden" name="wednesday" id="wedhid">
                            <input type="hidden" name="thursday" id="thuhid">
                            <input type="hidden" name="friday" id="frihid">
                            <input type="hidden" name="saturday" id="sathid">
                            <input type="hidden" name="sunday" id="sunhid">
                            <button type="submit" class="btn addmeal-btn myfont">Save changes</button>
                        </form>
                    </div>
                </div>
            

            <!-- popup for generated list -->
            <div class="hide" id="listPopup">
                <div class="popup-box">
                    <span class="close-btn" onclick="closePopup()">&times;</span>
                    <h2>Grocery List:</h2>
                    <ul>
                        <li></li>
                    </ul>
                <button class="done-btn" onclick="closePopup()">Copy</button>
            </div>
        </div>





            <div class="container mt-2">
                <h1 class="myfont text-center">Weekly Planner</h1>
                <h4 class="myfont text-center">Nov 19 - 25</h4>
                <div class="row planner">
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Sunday</h3>
                            <div class="meal">Breakfast:
                                <div id="sunb" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Lunch:
                                <div id="sunl" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Dinner:
                                <div id="sund" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Other:
                                <div id="suno" class="added-cal-meal"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Monday</h3>
                            <div class="meal">Breakfast:
                                <div id="monb" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Lunch:
                                <div id="monl" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Dinner:
                                <div id="mond" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Other:
                                <div id="mono" class="added-cal-meal"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Tuesday</h3>
                            <div class="meal">Breakfast:
                                <div id="tueb" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Lunch:
                                <div id="tuel" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Dinner:
                                <div id="tued" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Other:
                                <div id="tueo" class="added-cal-meal"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Wednesday</h3>
                            <div class="meal">Breakfast:
                                <div id="wedb" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Lunch:
                                <div id="wedl" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Dinner:
                                <div id="wedd" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Other:
                                <div id="wedo" class="added-cal-meal"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Thursday</h3>
                            <div class="meal">Breakfast:
                                <div id="thub" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Lunch:
                                <div id="thul" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Dinner:
                                <div id="thud" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Other:
                                <div id="thuo" class="added-cal-meal"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Friday</h3>
                            <div class="meal">Breakfast:
                                <div id="frib" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Lunch:
                                <div id="fril" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Dinner:
                                <div id="frid" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Other:
                                <div id="frio" class="added-cal-meal"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Saturday</h3>
                            <div class="meal">Breakfast:
                                <div id="satb" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Lunch:
                                <div id="satl" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Dinner:
                                <div id="satd" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Other:
                                <div id="sato" class="added-cal-meal"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn fixed-btn">
                    <a class="myfont" href="?command=cookbook">Hint: Check out your <br>cookbook for recipe ideas!</a>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>



<script>

     

    document.getElementById("generate-list").addEventListener("click", function(event) {
        // retrieve all user inputs from planner
        // search resulting string for any existing recipes
            // if found, add that recipe's ingredients to list
        // else, add the string itself to list
            // maybe with "ingredients for " ______
            
        document.getElementById('listPopup').style.display = 'flex';
    });

    function closePopup(){
        document.getElementById('listPopup').style.display = 'none';
    }
 </script>

</html>