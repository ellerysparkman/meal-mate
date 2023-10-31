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
            case "register":
                $this->register();
            case "enter":
                $this->showHomePage();
                break;
            case "guess":
                $this->submitGuess();
                break;
            case "quit":
                $this->showGameOver();
                break;
            case "logout":
                $this->logout();
            default:
                $this->showWelcome();
                break;
        }
    }

    public function showWelcome(){       
        $message = "";
        if (!empty($this->errorMessage))
            $message .= "<p class='alert alert-danger'>".$this->errorMessage."</p>";
        include("templates/welcome.php");
    }

    public function showCalendar(){
        include ("templates/calendar.html");
    }

    public function showCookbook(){
        include ("templates/cookbook.html");
    }

    public function showHomePage(){
        $name = $_SESSION["name"];
        $email = $_SESSION["email"];
        $message = $this->getUsers();

        include ("templates/homepage.php");
    }


    public function submitGuess() {
        $message = "";

        $words = $_SESSION['words'];
        $answers = $_SESSION["answers"];
        
        // FIND CATEGORY COUNTS
        // initialize all to 0
        $catCounts = [];
        foreach ($answers as $key => $value) {
            $catCounts[$key] = 0;
        }    
        // make sure guess is legit   
        if (isset($_POST["guess"])) {
            $guess = $_POST["guess"];}
        else {
            die("You did not input a guess.");
        }
        
        $toprint = implode(', ', $guessWordArray);
        // print guess regardless
        $_SESSION["guesses"] = $_SESSION["guesses"] . " \n" . "Guess: " . $toprint . " --> " . $wordsAway . " away.";
        $_SESSION["num_guesses"] += 1;

        if (count($words)==0){
            $this->showGameOver();
        }
        else {
        $this->showGame($message, $words, $answers);
        }
     

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
                    $_SESSION["score"] = $res[0]["score"];
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
                        $this->db->query("insert into users (email, password) values ($1, $2);",
                            $_POST["email"], password_hash($_POST["passwd"], PASSWORD_DEFAULT), 0);
                        $_SESSION["name"] = $_POST["fullname"];
                        $_SESSION["email"] = $_POST["email"];
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
                return;
        }

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




    public function logout(){
        session_destroy();
        session_start();
    }

}


