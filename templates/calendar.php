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
        <meta name="author" content="Mainly Ellery Sparkman">
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
            <div class="btn addmeal-btn">
                <a class="myfont">Add Meal</a>
            </div>
            <div id="generate-list" class="btn addmeal-btn">
                <a class="myfont" >Generate Shopping List</a>
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
                <h4 class="myfont text-center">Oct 4 - 11</h4>
                <div class="row planner">
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Sunday</h3>
                            <div class="meal">Breakfast:
                                <form id="sunb">
                                <textarea class="form-control" rows="3"  ></textarea>
                                <button type="submit" class="add-btn">Add</button>
                                </form>
                                <div id="sunbOutput" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Lunch:
                                <form id="sunl">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn">Add</button>
                                </form>
                                <div id="sunlOutput" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Dinner:
                                <form id="sund">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  >Add</button>
                                </form>
                            </div>
                            <div id="sundOutput" class="added-cal-meal"></div>
                            <div class="meal">Other:
                                <form id="suno">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  >Add</button>
                                </form>
                                <div id="sunoOutput" class="added-cal-meal"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Monday</h3>
                            <div class="meal">Breakfast:
                            <form id="monb">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                            <div id="monbOutput" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Lunch:
                            <form id="monl">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="monlOutput" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Dinner:
                            <form id="mond">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                            <div id="mondOutput" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Other:
                            <form id="mono">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="monoOutput" class="added-cal-meal"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Tuesday</h3>
                            <div class="meal">Breakfast:
                            <form id="tuesb">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                            <div id="tuesbOutput" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Lunch:
                            <form id="tuesl">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="tueslOutput" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Dinner:
                            <form id="tuesd">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="tuesdOutput" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Other:
                            <form id="tueso">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="tuesoOutput" class="added-cal-meal"></div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Wednesday</h3>
                            <div class="meal">Breakfast:
                            <form id="wedb">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="wedbOutput" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Lunch:
                            <form id="wedl">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="wedlOutput" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Dinner:
                            <form id="wedd">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="weddOutput" class="added-cal-meal"></div>

                            </div>
                            <div class="meal">Other:
                            <form id="wedo">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="wedoOutput" class="added-cal-meal"></div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Thursday</h3>
                            <div class="meal">Breakfast:
                            <form id="thursb">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="thursbOutput" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Lunch:
                            <form id="thursl">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="thurslOutput" class="added-cal-meal"></div>

                            </div>
                            <div class="meal">Dinner:
                            <form id="thursd">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="thursdOutput" class="added-cal-meal"></div>

                            </div>
                            <div class="meal">Other:
                            <form id="thurso">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="thursoOutput" class="added-cal-meal"></div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Friday</h3>
                            <div class="meal">Breakfast:
                            <form id="frib">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="fribOutput" class="added-cal-meal"></div>
                            </div>
                            <div class="meal">Lunch:
                            <form id="fril">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="frilOutput" class="added-cal-meal"></div>

                            </div>
                            <div class="meal">Dinner:
                            <form id="frid">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="fridOutput" class="added-cal-meal"></div>

                            </div>
                            <div class="meal">Other:
                            <form id="frio">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="frioOutput" class="added-cal-meal"></div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-1-4">
                        <div class="day">
                            <h3 class="dayheader">Saturday</h3>
                            <div class="meal">Breakfast:
                            <form id="satb">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="satbOutput" class="added-cal-meal"></div>

                            </div>
                            <div class="meal">Lunch:
                            <form id="satl">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="satlOutput" class="added-cal-meal"></div>

                            </div>
                            <div class="meal">Dinner:
                            <form id="satd">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="satdOutput" class="added-cal-meal"></div>

                            </div>
                            <div class="meal">Other:
                            <form id="sato">
                                    <textarea class="form-control" rows="3"  ></textarea>
                                    <button type ="submit" class="add-btn"  placeholder="bithc">Add</button>
                                </form>
                                <div id="satoOutput" class="added-cal-meal"></div>

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


    function addMeal(formId) {
        var mealTextArea = document.getElementById(formId).getElementsByTagName('textarea')[0];
        var mealValue = mealTextArea.value;
        var outputElement = document.getElementById(formId + 'Output');
        outputElement.innerHTML += '<p>' +  mealValue + '</p>';
        mealTextArea.value = '';    
    }


    document.addEventListener('DOMContentLoaded', function () {

            // adds user's meal input to page on click of add btn
            var addButtons = document.querySelectorAll('.add-btn');
            addButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    var form = button.parentElement;
                    var formId = form.id; 
                    addMeal(formId);
                });
            });

            // allow edits
            var addedMeals = document.querySelectorAll('.added-cal-meal');
            addedMeals.forEach(function (addedMeal) {
                addedMeal.addEventListener('click', function () {
                    var toEdit = document.createElement('textarea');
                    toEdit.value = addedMeal.textContent.trim();
                    addedMeal.innerHTML = '';
                    addedMeal.appendChild(toEdit);

                    // Focus on the textarea for editing
                    toEdit.focus();

                    // Add blur event listener to save changes when the textarea loses focus
                    toEdit.addEventListener('blur', function () {
                        addedMeal.innerHTML += toEdit.value;
                    });
                });
            });

    });

 </script>

</html>