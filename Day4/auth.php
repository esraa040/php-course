<?php

if (!isset($_SESSION["loginID"])) {
    header("location:login.php?errorMessage=you must login first");
    exit;
}

$loginUser = $db->show("users", $_SESSION["loginID"]);

if (!$loginUser) {
    unset($_SESSION["loginID"]);
    header("location:login.php?errorMessage=you must login first");
    exit;
}
