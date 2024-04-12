<?php

session_start();

function is_logged_in() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../Login/login.php");
        die();
    }
}

function get_user_role() {
    if (!isset($_SESSION['user_id'])) {
        return FALSE;
    } else {
        return $_SESSION['user_id'];
    }
}


function get_user_id() {
    if (isset($_SESSION['user_id'])) {
        return $_SESSION['user_id'];
    } else {
        return FALSE; // Or return null; depending on your preference
    }
}
 

