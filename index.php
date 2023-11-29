<?php
//LINK TO HOMEPAGE https://cs4640.cs.virginia.edu/msh3dvn/sprint4/?command=welcome

    spl_autoload_register(function ($classname) {
        include "$classname.php";
    });
            

    $mysite = new SiteController($_GET);

    $mysite->run();