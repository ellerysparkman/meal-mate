<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

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

    public function showWelcome(){       
        $message = "";
        if (!empty($this->errorMessage))
            $message .= "<p class='alert alert-danger'>".$this->errorMessage."</p>";

        $loggedIn = false;

        if(isset($_SESSION["name"])){
            $name = $_SESSION["name"];
            $loggedIn = true;
        }

        include("templates/welcome.php");
    }

    public function showCalendar(){
        include ("templates/calendar.html");
    }

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

    public function showHomePage(){

        $loggedIn = false;

        if(isset($_SESSION["name"])){
            $name = $_SESSION["name"];
            $loggedIn = true;
        }

        include ("templates/homepage.php");
    }

    public function showRecipeCreation($emessage=""){

        $loggedIn = false;

        if(isset($_SESSION["name"])){
            $loggedIn = true;
        }

        $message = $emessage;

        include ("templates/add-recipe.php");
    }

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

    //This will show the edit screen.  For the edit logic, just have a hidden field checking if its 
    //insert or edit and then check that and use the insert recipe function again
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

    //public function deleteRecipe($recipeId){
        //$res = $this->db->query("delete from recipes where recipe_id = $1;", $recipeId);
        //$this->showCookbook();
        //return;
    //}

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

    public function addRecipe(){
        // if isset recipe
        // add recipe to user
        if(isset($_POST["recipeNameInput"]) && !empty($_POST["recipeNameInput"])){
            $res = $this->db->query("select * from recipes where name = $1 and user_id = $2;", $_POST["recipeNameInput"], $_SESSION["user_id"]);
            if (empty($res)){
                // add recipe to recipes table, currently the tags and ingredients don't work
                $this->db->query("insert into recipes (name, notes, ingredients, tags, instructions, user_id) values ($1, $2, $3, $4, $5, $6);",
                            $_POST["recipeNameInput"], $_POST["notesTextarea"], '{}', '{}', $_POST["recipeTextarea"], $_SESSION["user_id"]);
                // get recipe id and add it to user's recipe_list
                $recipeId = $this->db->query("select recipe_id from recipes where name = $1 and user_id = $2;", $_POST["recipeNameInput"], $_SESSION["user_id"]);
                $this->db->query("update users set recipe_list = array_append(recipe_list, $1) where user_id = $2;", $recipeId, $_SESSION["user_id"]);

                // Send user to the appropriate page (homepage)
                header("Location: ?command=cookbook");
                return;
            }
            else {
                $this->showRecipeCreation("A recipe under that name already exists in your cookbook!");
            }
        }
        else {
            $this->showRecipeCreation("You need to name your recipe before creating it!");
        }
        //$this->showCookbook();

    }

    public function getUsers(){
        $message = "";
        $res = $this->db->query("select * from users");
        if (empty($res)){
            $message = "shit's empty";
            return $message;
        }
        else {
            $message = $message . print_r($res);
            return $message;
        }
    }

    public function getRecipes($user_id){
        $res = $this->db->query("select * from recipes where user_id = $1", $user_id);
        return $res;
    }


    public function logout(){
        session_destroy();
        session_start();
        header("Location: ?command=welcome");
    }

}