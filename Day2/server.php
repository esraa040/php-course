<?php

session_start();

if (!isset($_SESSION["usersData"])) {
    $_SESSION["usersData"] = [];
}

if (isset($_POST["btn-register"])) {

    $user = [
        "userName"     => $_POST["userName"],
        "userEmail"    => $_POST["userEmail"],
        "userPassword" => $_POST["userPassword"],
    ];

    array_push($_SESSION["usersData"], $user);

    header("location:login.php?message=register successfully");
    exit;
}

if (isset($_POST["btn-login"])) {

    $userEmail    = $_POST["userEmail"];
    $userPassword = $_POST["userPassword"];
    $found        = false;

    foreach ($_SESSION["usersData"] as $user) {
        if (($user["userEmail"] == $userEmail) && ($user["userPassword"] == $userPassword)) {
            $found = true;
            $_SESSION["loginUser"] = $user;
            header("location:allUsers.php?message=login Successfully");
            exit;
        }
    }

    if (!$found) {
        header("location:login.php?error_message=check your email or password");
        exit;
    }
}

if (isset($_GET["logout"])) {
    unset($_SESSION["loginUser"]);
    header("location:login.php?message=logout successfully");
    exit;
}

if (isset($_GET["delete"])) {

    if (!isset($_SESSION["loginUser"])) {
        header("location:login.php?error_message=you must login first");
        exit;
    }

    $id = $_GET["delete"];

    if (isset($_SESSION["usersData"][$id])) {
        unset($_SESSION["usersData"][$id]);
        $_SESSION["usersData"] = array_values($_SESSION["usersData"]);
    }

    header("location:allUsers.php?message=user deleted successfully");
    exit;
}

if (isset($_POST["btn-update"])) {

    if (!isset($_SESSION["loginUser"])) {
        header("location:login.php?error_message=you must login first");
        exit;
    }

    $id = $_POST["id"];

    if (isset($_SESSION["usersData"][$id])) {
        $_SESSION["usersData"][$id]["userName"]  = $_POST["userName"];
        $_SESSION["usersData"][$id]["userEmail"] = $_POST["userEmail"];

        if ($_SESSION["loginUser"]["userEmail"] == $_POST["oldEmail"]) {
            $_SESSION["loginUser"] = $_SESSION["usersData"][$id];
        }
    }

    header("location:allUsers.php?message=user updated successfully");
    exit;
}

header("location:index.php");
exit;
