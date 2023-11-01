<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Note that these are for the local Docker container
    $host = "localhost";
    $port = "5432";
    $database = "msh3dvn";
    $user = "msh3dvn";
    $password = ""; 

    $dbHandle = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

    if ($dbHandle) {
        echo "Success connecting to database";
    } else {
        echo "An error occurred connecting to the database";
    }

    // Drop tables and sequences
    $res  = pg_query($dbHandle, "drop sequence if exists recipe_seq cascade;");
    $res  = pg_query($dbHandle, "drop sequence if exists user_seq cascade;");
    $res  = pg_query($dbHandle, "drop table if exists recipes;");
    $res  = pg_query($dbHandle, "drop table if exists users;");

    // Create sequences
    $res  = pg_query($dbHandle, "create sequence recipe_seq;");
    $res  = pg_query($dbHandle, "create sequence user_seq;");

    // Create tables.  
    //recipe_list is an array of recipe ids created by the user
    $res  = pg_query($dbHandle, "create table users (
        user_id  int primary key default nextval('user_seq'),
        name text,
        email text,
        password text,
        recipe_list int[] 
    );");
    
    $res  = pg_query($dbHandle, "create table recipes (
            recipe_id      int primary key default nextval('recipe_seq'),
            name           text,
            notes          text,
            ingredients    text[],
            tags           text[],
            instructions   text,
            user_id        int references users(user_id)
    );");
    

    // Read json and insert the trivia questions into the database
    // Note: the URL is updated due to changes on the CS web server
    //$questions = json_decode(
        //file_get_contents("http://ford.cs.virginia.edu/trivia.json"), true);

    $res = pg_prepare($dbHandle, "myinsert", "insert into users (name, email, password, recipe_list) values ($1, $2, $3, $4);");
    $testa = array(1, 2, 3, 4);
    $res = pg_execute($dbHandle, "myinsert", ["fname", "test@gmail.com", "passwd", '{1, 2, 3}']);
    $result = pg_query($dbHandle, "select * from users");
    $arraya = pg_fetch_assoc($result);
    echo "<br>";
    var_dump($arraya);
    echo "<br>";
    echo "Recipe:";
    echo "<br>";

    $res = pg_prepare($dbHandle, "myinsert2", "insert into recipes (name, notes, ingredients, tags, instructions, user_id) values ($1, $2, $3, $4, $5, $6);");
    $res = pg_execute($dbHandle, "myinsert2", ["Pancakes", "Make for breakfast", '{eggs, milk, sugar}', '{sweet, fast, easy, breakfast}', "first mix flour and sugar in a medium bowl", 1]);
    $result = pg_query($dbHandle, "select * from recipes");
    $arraya = pg_fetch_assoc($result);
    var_dump($arraya);
