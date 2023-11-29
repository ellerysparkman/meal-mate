<?php

// https://www.w3schools.com/php/php_form_url_email.asp
//Both Ellery and Maya worked a lot on this
error_reporting(E_ALL);
ini_set("display_errors", 1);

class SiteController {

    private $input = [];
    private $db;
    private $errorMessage = "";

    public function __construct($input) {
        session_start();
        $this->db = new Database();
        $this->input = $input;
    }

    public function run(){
        $command = "welcome";
        if (isset($this->input["command"])){
            $command = $this->input["command"];
        }

        switch($command){
            case "login":
                $this->login();
                break;
            case "register":
                $this->register();
                break;
            case "enter":
                $this->showHomePage();
                break;
            case "cookbook":
                $this->showCookbook();
                break;
            case "logout":
                $this->logout();
                break;
            case "addrecipe":
                $this->showRecipeCreation();
                break;
            case "insertrecipe":
                $this->addRecipe();
                break;
            case "calendar":
                $this->showCalendar();
                break;
            case "savecalendar":
                $this->saveCalendar();
                break;
            case "generatelist":
                $this->generateList();
                break;
            case "viewrecipe":
                $this->showRecipe();
                break;
            case "edit":
                $this->editRecipe();
                break;
            case "delete":
                $this->deleteRecipe();
                break;
            default:
                $this->showWelcome();
                break;
        }
    }

    //The log in/log out page
    public function showWelcome(){       
        $message = "";
        if (!empty($this->errorMessage))
            $message .= "<p class='alert alert-danger'>".$this->errorMessage."</p>";

        $loggedIn = false;

        if(isset($_SESSION["name"])){
            $name = $_SESSION["name"];
            $loggedIn = true;
            $res = $this->db->query("select name, email from users where name = $1;", $name);
            $info = json_encode($res, JSON_PRETTY_PRINT);
        }

        include("templates/welcome.php");
    }

    //The calendar page, checks if the user has a meal plan saved in database
    public function showCalendar(){

        $loadDays = false;
        $showList = false;
        $groceryList = [];

        //If showgroceries is true, set grocery list
        if(isset($_SESSION["showGroceries"]) && !empty($_SESSION["showGroceries"])){
            $showList = $_SESSION["showGroceries"];
            if($showList){
                if(isset($_SESSION["groceries"]) && !empty($_SESSION["groceries"])){

                    $groceryList = $_SESSION["groceries"];
                }
                $_SESSION["showGroceries"] = false;
            }
        }

        //Check that user is logged in
        if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])){
            $res = $this->db->query("select * from calendars where user_id = $1;", $_SESSION["user_id"]);
            if (!empty($res)){
                $loadDays = true;
                $oldMon = $res[0]["monday"];
                $oldTue = $res[0]["tuesday"];
                $oldWed = $res[0]["wednesday"];
                $oldThu = $res[0]["thursday"];
                $oldFri = $res[0]["friday"];
                $oldSat = $res[0]["saturday"];
                $oldSun = $res[0]["sunday"];
            }
        }

        include ("templates/calendar.php");
    }

    //Saves calendar meals to database
    public function saveCalendar(){
        //Check that user is logged in and that one post value is set, since they're all set at the same time
        if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]) && isset($_POST["monday"]) && !empty($_POST["monday"])){
            $res = $this->db->query("select * from calendars where user_id = $1;", $_SESSION["user_id"]);
            //User doesn't have a calendar saved yet
            if (empty($res)){
                $this->db->query("insert into calendars (monday, tuesday, wednesday, thursday, friday, saturday, sunday, user_id) values ($1, $2, $3, $4, $5, $6, $7, $8);",
                                $_POST["monday"], $_POST["tuesday"], $_POST["wednesday"], $_POST["thursday"], $_POST["friday"], $_POST["saturday"], 
                                $_POST["sunday"], $_SESSION["user_id"]);
            }
            else{
                $success = $this->db->query("update calendars set monday = $1, tuesday = $2, wednesday = $3, thursday = $4, friday = $5,
                saturday = $6, sunday= $7 where user_id = $8;", $_POST["monday"], $_POST["tuesday"], $_POST["wednesday"], $_POST["thursday"], 
                $_POST["friday"], $_POST["saturday"], $_POST["sunday"], $_SESSION["user_id"]);
            }

            header("Location: ?command=calendar");
            return;
        }
        
    }

    //Generates a shopping list for meals on calendar, including ones not saved in database
    public function generateList(){
        //Check if there is a list of meals
        if(isset($_POST["meals"]) && !empty($_POST["meals"])){
            $mealList = json_decode($_POST["meals"]);
            $combineIng = [];
            //For each meal in calendar, find ingredients
            foreach($mealList as $meal){
                $currStr = "%" . $meal . "%";
                $res = $this->db->query("select ingredients from recipes where name like $1 and user_id = $2;", $currStr, $_SESSION["user_id"]);
                //If ingredients exist, split into array
                if(!empty($res)){
                    $ingstr = $res[0]["ingredients"];
                    $ingshort = substr($ingstr, 1, -1);
                    $striping = str_replace("\"", "", $ingshort);
                    $ingarr = explode(",", $striping);
                    //Insert each ingredient into array with name as key and amount as value
                    foreach($ingarr as $item){
                        $num = strpos($item, " ");
                        $ammount = substr($item, 0, $num);
                        $ingredient = substr($item, $num);
                        if(array_key_exists($ingredient, $combineIng)){
                            $combineIng[$ingredient] += $ammount;
                        }
                        else{
                            $combineIng[$ingredient] = $ammount;
                        }
                    }
                }
                else{
                    $combineIng["x ingredients for " . $meal] = 1;
                }

            }

            ksort($combineIng);
            $finarr = [];
            foreach($combineIng as $k => $v){
                $currStr = $v . $k;
                array_push($finarr, $currStr);
            }
            $_SESSION["groceries"] = $finarr;
            $_SESSION["showGroceries"] = true;
        }
        header("Location: ?command=calendar");
        return;
    }

    //The cookbook screen which displays a grid of cards of a user's recipes
    public function showCookbook(){
        $loggedIn = false;

        if(isset($_SESSION["name"])){
            $name = $_SESSION["name"];
            $userid = $_SESSION["user_id"];
            $recipes = $this->getRecipes($userid);
            $loggedIn = true; 
        }

        include ("templates/cookbook.php");
    }

    //The homepage of the website
    public function showHomePage(){

        $loggedIn = false;

        if(isset($_SESSION["name"])){
            $name = $_SESSION["name"];
            $loggedIn = true;
        }

        include ("templates/homepage.php");
    }

    //The page where you create a new recipe and add it to the database
    public function showRecipeCreation($emessage=""){

        $loggedIn = false;

        if(isset($_SESSION["name"])){
            $loggedIn = true;
        }

        $message = $emessage;

        include ("templates/add-recipe.php");
    }

    //Shows a detailed view of a recipe with an edit and delete button
    public function showRecipe(){

        if (isset($_POST["recipe_id"]) && !empty($_POST["recipe_id"])){
            $recipeID = $_POST["recipe_id"];
            $res = $this->db->query("select * from recipes where recipe_id = $1;", $recipeID);
            if (!empty($res)){
                $currRecipe = $res;
                //convert tags and ingredients from database string to array
                //Check if they are empty (== "{}")
                $tagstr = $currRecipe[0]["tags"];
                if($tagstr == "{}"){
                    $tagarr = [];
                }
                else{
                    $tagshort = substr($tagstr, 1, -1);
                    $striptag = str_replace("\"", "", $tagshort);
                    $tagarr = explode(",", $striptag);
                }

                $ingstr = $currRecipe[0]["ingredients"];
                if($ingstr == "{}"){
                    $ingarr = [];
                }
                else{
                    $ingshort = substr($ingstr, 1, -1);
                    $striping = str_replace("\"", "", $ingshort);
                    $ingarr = explode(",", $striping);
                }
            }
            else {
                header("Location: ?command=cookbook");
            }
        }
        else {
            header("Location: ?command=cookbook");
        }

        include ("templates/show-recipe.php");
    }

    //This is the screen that lets a user edit a recipe they already created. Needs recipe_id value from hidden input field
    public function editRecipe(){
        if (isset($_POST["recipe_id"]) && !empty($_POST["recipe_id"])){
            $recipeID = $_POST["recipe_id"];
            $res = $this->db->query("select * from recipes where recipe_id = $1;", $recipeID);
            if (!empty($res)){
                $currRecipe = $res;
                //convert tags and ingredients from database string to array
                //Check if they are empty (== "{}")
                $tagstr = $currRecipe[0]["tags"];
                if($tagstr == "{}"){
                    $tagarr = [];
                }
                else{
                    $tagshort = substr($tagstr, 1, -1);
                    $striptag = str_replace("\"", "", $tagshort);
                    $tagarr = explode(",", $striptag);
                }

                $ingstr = $currRecipe[0]["ingredients"];
                if($ingstr == "{}"){
                    $ingarr = [];
                }
                else{
                    $ingshort = substr($ingstr, 1, -1);
                    $striping = str_replace("\"", "", $ingshort);
                    $ingarr = explode(",", $striping);
                }
                
            }
            else {
                header("Location: ?command=cookbook");
            }
        }
        else {
            header("Location: ?command=cookbook");
        }

        include ("templates/edit-recipe.php");
    }

    //This function removes a recipe from the database.  Needs recipe_id value from hidden input field
    public function deleteRecipe(){
        if(isset($_POST["recipe_id"]) && !empty($_POST["recipe_id"])){
            $recipeId = $_POST["recipe_id"];
            $res = $this->db->query("delete from recipes where recipe_id = $1;", $recipeId);
            $this->showCookbook();
        }
        else {
            $this->showRecipe();
        }

    }

    //checks to see if there is a user in the database with the given email and if the password matches.  Logs in and directs to homepage if so
    public function login(){
        // user enters email
        if (isset($_POST["email"]) && !empty($_POST["email"]) &&
        isset($_POST["passwd"]) && !empty($_POST["passwd"])) {
            $res = $this->db->query("select * from users where email = $1;", $_POST["email"]);
            // account not recognized, reload
            if (empty($res)) {
                $this->errorMessage = "We don't recognize your information. Please create an account below!";
                // header("Location: ?command=''");
            }
            // account recognized! now verify password
            else {
                if (password_verify($_POST["passwd"], $res[0]["password"])) {
                    // if all good, add to session variable and enter website
                    $_SESSION["name"] = $res[0]["name"];
                    $_SESSION["email"] = $res[0]["email"];
                    $_SESSION["user_id"] = $res[0]["user_id"];
                    header("Location: ?command=enter");
                    return;}
                else {
                    $this->errorMessage = "Incorrect password!";
                }
            }
        }
        else {
            // enterred no info
            $this->errorMessage = "Please enter an email and a password!";
        }
        // default in case something goes wrong
        $this->showWelcome();
    }

    //Creates a new acount and directs to homepage if there isn't already an acount for the email.
    public function register(){
        if(isset($_POST["fullname"]) && !empty($_POST["fullname"]) && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["passwd"]) && !empty($_POST["passwd"])) {
                 // Check if user is in database
                 $res = $this->db->query("select * from users where email = $1;", $_POST["email"]);
                if (empty($res)) {
                     // User was not there, so insert them
                     // email validation
                     $email = $_POST["email"];
                     $regex = '/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/';
                     if (!preg_match($regex, $email)){
                        $this->errorMessage = "Invalid email format";
                     }
                     else {
                        $this->db->query("insert into users (name, email, password, recipe_list) values ($1, $2, $3, $4);",
                            $_POST["fullname"], $_POST["email"], password_hash($_POST["passwd"], PASSWORD_DEFAULT), '{}');
                        $_SESSION["name"] = $_POST["fullname"];
                        $_SESSION["email"] = $_POST["email"];
                        $res = $this->db->query("select * from users where email = $1;", $_POST["email"]);
                        $_SESSION["user_id"] = $res[0]["user_id"];
                        // Send user to the appropriate page (homepage)
                        header("Location: ?command=enter");
                        return;
                    }
                } else {
                     // User was in the database already
                        $this->errorMessage = "You already have an account! Please log in above.";
                }
        }
        else {
            // tried to register with blank info
            $this->errorMessage = "Name, email, and password are required to register.";
            // header("Location: ?command=login"); // might not need this
         }
         // If something went wrong, show the welcome page again
         $this->showWelcome();
    }

    //Adds a recipe to the database or updates one based on the value of updateInfo (true means update, false means add)
    public function addRecipe(){
        // if updateInfo is true, a recipe is being updated, if its false a recipe is being addded
        if(isset($_POST["recipeNameInput"]) && !empty($_POST["recipeNameInput"])){
            $updateInfo = $_POST["updateInfo"];
            if ($updateInfo === "false"){
                $res = $this->db->query("select * from recipes where name = $1 and user_id = $2;", $_POST["recipeNameInput"], $_SESSION["user_id"]);
                if (empty($res)){
                    //Builds array of ingredients if they were submitted
                    $ingstr = "{";
                    if(isset($_POST["ingredients"]) && !empty($_POST["ingredients"])){
                        $ingarr = json_decode($_POST["ingredients"]);
                        foreach($ingarr as $item){
                            $ingstr .= $item . ", ";
                        }
                        //gets rid of last comma space
                        $ingstr = substr($ingstr, 0, -2);
                    }
                    $ingstr .= "}";

                    //Builds array of tags if they were submitted
                    $tagstr = "{";
                    if(isset($_POST["tags"]) && !empty($_POST["tags"])){
                        $tagarr = json_decode($_POST["tags"]);
                        foreach($tagarr as $tag){
                            $tagstr .= $tag . ", ";
                        }
                        //gets rid of last comma space
                        $tagstr = substr($tagstr, 0, -2);
                    }
                    $tagstr .= "}";

                    // ADD RECIPE to recipes table
                    $this->db->query("insert into recipes (name, notes, ingredients, tags, instructions, user_id) values ($1, $2, $3, $4, $5, $6);",
                                $_POST["recipeNameInput"], $_POST["notesTextarea"], $ingstr, $tagstr, $_POST["recipeTextarea"], $_SESSION["user_id"]);

                    // get recipe id and add it to user's recipe_list
                    $recipeId = $this->db->query("select recipe_id from recipes where name = $1 and user_id = $2;", $_POST["recipeNameInput"], $_SESSION["user_id"]);
                    //$recipeId[0]["recipe_id"] is how to get the real recipe id, recipeId returns an array where the value is an array
                    $this->db->query("update users set recipe_list = array_append(recipe_list, $1) where user_id = $2;", $recipeId, $_SESSION["user_id"]);
    
                    // Send user to the appropriate page
                    header("Location: ?command=cookbook");
                    return;
                }
                // don't add repeat recipe
                else {
                    $this->showRecipeCreation("A recipe under that name already exists in your cookbook!");
                }
            }
            if ($updateInfo === "true") {
                //Builds array of ingredients if they were submitted
                $ingstr = "{";
                if(isset($_POST["ingredients"]) && !empty($_POST["ingredients"])){
                    $ingarr = json_decode($_POST["ingredients"]);
                    foreach($ingarr as $item){
                        $ingstr .= $item . ", ";
                    }
                    //gets rid of last comma space
                    $ingstr = substr($ingstr, 0, -2);
                }
                $ingstr .= "}";

                //Builds array of tags if they were submitted
                $tagstr = "{";
                if(isset($_POST["tags"]) && !empty($_POST["tags"])){
                    $tagarr = json_decode($_POST["tags"]);
                    foreach($tagarr as $tag){
                        $tagstr .= $tag . ", ";
                    }
                    //gets rid of last comma space
                    $tagstr = substr($tagstr, 0, -2);
                }
                $tagstr .= "}";

                $success = $this->db->query("update recipes set name = $1, notes = $2, 
                ingredients = $3, tags = $4, instructions = $5 where recipe_id = $6;",
                    $_POST["recipeNameInput"], $_POST["notesTextarea"], $ingstr, $tagstr, $_POST["recipeTextarea"], 
                    $_POST["recipe_id"]);

                //$res = $this->db->query("select * from recipes where recipe_id = $1", $_POST["recipe_id"]);
                //var_dump($res);

                header("Location: ?command=cookbook");
                return;
            }
        }
        else {
            $this->showRecipeCreation("Make sure to name your recipe!");
        }
    }

    //Returns all of the users in the database. Was only used for testing
    public function getUsers(){
        $message = "";
        $res = $this->db->query("select * from users");
        if (empty($res)){
            $message = "No users";
            return $message;
        }
        else {
            $message = $message . print_r($res);
            return $message;
        }
    }

    //Returns all the recipes for the given user
    public function getRecipes($user_id){
        $res = $this->db->query("select * from recipes where user_id = $1", $user_id);
        return $res;
    }


    //Logs the user out and directs them to the log in page
    public function logout(){
        session_destroy();
        session_start();
        header("Location: ?command=welcome");
    }

}