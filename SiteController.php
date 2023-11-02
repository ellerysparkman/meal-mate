<?php

// https://www.w3schools.com/php/php_form_url_email.asp

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
            case "calendar":
                $this->showCalendar();
                break;
            case "logout":
                $this->logout();
                break;
            case "showadd":
                $this->showAddRecipe();
                break;
            case "addrecipe":
                $this->addRecipe();
                break;
            case "showrecipe":
                $this->showRecipe();
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

        if (isset($_POST["testmess"]) && !empty($_POST["testmess"])){
            $message = $_POST["testmess"];
        }
        include("templates/welcome.php");
    }

    public function showCalendar(){
        include ("templates/calendar.php");
    }

    public function showCookbook(){
        if(isset($_SESSION["name"])){
            $name = $_SESSION["name"];
            $user_id = $_SESSION["user_id"];
            $recipes = $this->getRecipes($user_id);
            $loggedIn = true;
        }
        $res = $this->db->query("select * from recipes");
        $recipes = print_r($res);

        include ("templates/cookbook.php");
    }

    public function showAddRecipe(){
        $loggedIn = false;

        if(isset($_SESSION["name"])){
            $loggedIn = true;
        }
        include ("templates/add-recipe.php");
    }

    public function showHomePage(){
        $name = $_SESSION["name"];
        $email = $_SESSION["email"];
        $user_id = $_SESSION["user_id"];
        $message = $this->getUsers();
        $m1 = $this->getRecipes($user_id);
        include ("templates/homepage.php");
    }

    public function showRecipe($recipeId){
        $res = $this->db->query("select * from recipes where recipe_id = $1;", $recipeId);
        if (!empty($res)){
            $recipe_id = $res[0]["recipe_id"];
            $recipe_name = $res[0]["name"];
            $notes = $res[0]["notes"];
            $ingredients = $res[0]["ingredients"]; 
            $tags = $res[0]["tags"]; 
            $instructions= $res[0]["instructions"]; 
            $user_id = $res[0]["user_id"]; 
        }
        return;
    }

    public function editRecipe($recipeId, ...$param){
        // TO DO 
        $ingredients = '{}';
        $instructions = '{}';
        $res = $this->db->query("update recipes set ingredients = $1, instructions = $2 where recipe_id = $3;", $ingredients, $instructions, $recipeID);
        $this->showRecipe();
    }

    public function deleteRecipe($recipeId){
        $res = $this->db->query("delete from recipes where recipe_id = $1;", $recipeId);
        $this->showCookbook();
        return;
    }


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
        // default in case somethign goes wrong
        $this->showWelcome();
    }

    public function register(){
        if(isset($_POST["fullname"]) && !empty($_POST["fullname"]) &&
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["passwd"]) && !empty($_POST["passwd"])) {
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
                        return;}
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
        if(isset($_POST["fullname"]) && !empty($_POST["fullname"])){
        if(isset($_POST["recipeNameInput"]) && !empty($_POST["recipeNameInput"])){
            $res = $this->db->query("select * from recipes where name = $1;", $_POST["recipeNameInput"]);
            if (empty($res)){
                // add recipe to recipes table, currently the tags and ingredients don't work
                $this->db->query("insert into recipes (name, notes, ingredients, tags, instructions, user_id) values ($1, $2, $3, $4, $5, $6);",
                            $_POST["recipeNameInput"], $_POST["notesTextarea"], '{}', '{}', $_POST["recipeTextarea"], $_SESSION["user_id"]);
                // get recipe id and add it to user's recipe_list
                $recipeId = $this->db->query("select recipe_id from recipes where name = $1;", $_POST["recipeNameInput"]);
                $this->db->query("update users set recipe_list = array_append(recipe_list, $1) where user_id = $2;", $recipeId, $_SESSION["user_id"]);

                // Send user to the appropriate page (homepage)
                header("Location: ?command=cookbook");
                return;
            }
            else {
                $this->errorMessage = "A recipe under that name already exists in your cookbook!";
            }
        }
        else {
            $this->errorMessage = "You need to name your recipe before creating it!";
        }
        $this->showCookbook();

    }}



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
        $m = '';
        $m = $m . print_r($res);
        return $m;
    }


    public function logout(){
        session_destroy();
        session_start();
    }

}


