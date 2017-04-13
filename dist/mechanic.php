<?php
if ($login->isUserLoggedIn() == true && $login->checkUserLevel() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    include("adminHeader.php");

} elseif ($login->isUserLoggedIn() == true && $login->checkUserLevel() == false) {
    include("normalHeader.php");

} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    include("login.php"); }

include_once "map.php";
include_once ("footer.php");
