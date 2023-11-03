<?php

// https://www.w3schools.com/php/php_form_url_email.asp
//Both Ellery and Maya worked a lot on this

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

    //The calendar page, doesn't really do anything right now
    public function showCalendar(){
        include ("templates/calendar.php");
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
                    // ADD RECIPE to recipes table, currently the tags and ingredients don't work
                    $this->db->query("insert into recipes (name, notes, ingredients, tags, instructions, user_id) values ($1, $2, $3, $4, $5, $6);",
                                $_POST["recipeNameInput"], $_POST["notesTextarea"], '{}', '{}', $_POST["recipeTextarea"], $_SESSION["user_id"]);
                    // get recipe id and add it to user's recipe_list
                    $recipeId = $this->db->query("select recipe_id from recipes where name = $1 and user_id = $2;", $_POST["recipeNameInput"], $_SESSION["user_id"]);
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
                $success = $this->db->query("update recipes set name = $1, notes = $2, 
                ingredients = $3, tags = $4, instructions = $5 where recipe_id = $6;",
                    $_POST["recipeNameInput"], $_POST["notesTextarea"], '{}', '{}', $_POST["recipeTextarea"], 
                    $_POST["recipe_id"]);
                header("Location: ?command=cookbook");
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