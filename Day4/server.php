<?php

require "./connection.php";

function nullIfEmpty($value)
{
    return (isset($value) && trim($value) !== "") ? $value : null;
}

function back($page, $type, $message)
{
    header("location:" . $page . "?" . $type . "=" . urlencode($message));
    exit;
}

function mustLogin()
{
    if (!isset($_SESSION["loginID"])) {
        back("login.php", "errorMessage", "you must login first");
    }
}

$namePattern     = '/^[a-zA-Z ]{3,}$/';
$passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/';
$passwordMessage = "password must be at least 8 characters with one capital letter , one small letter and one number";

/* ============================ register ============================ */

if (isset($_POST["btn-register"])) {

    $userName     = trim($_POST["userName"]);
    $userEmail    = trim($_POST["userEmail"]);
    $userPassword = $_POST["userPassword"];

    $keep = "&userName=" . urlencode($userName) . "&userEmail=" . urlencode($userEmail);

    if (!preg_match($namePattern, $userName)) {
        header("location:register.php?errorMessage=" . urlencode("enter a valid name , letters only and at least 3 characters") . $keep);
        exit;
    }

    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        header("location:register.php?errorMessage=" . urlencode("enter a valid email") . $keep);
        exit;
    }

    if (!preg_match($passwordPattern, $userPassword)) {
        header("location:register.php?errorMessage=" . urlencode($passwordMessage) . $keep);
        exit;
    }

    if ($db->findBy("users", "email", $userEmail)) {
        header("location:register.php?errorMessage=" . urlencode("email already exist") . $keep);
        exit;
    }

    $db->create("users", [
        "name"     => $userName,
        "email"    => $userEmail,
        "password" => password_hash($userPassword, PASSWORD_DEFAULT),
    ]);

    back("login.php", "successMessage", "register successfully , now login");
}

/* ============================== login ============================= */

if (isset($_POST["btn-login"])) {

    $userEmail    = trim($_POST["userEmail"]);
    $userPassword = $_POST["userPassword"];

    $user = $db->findBy("users", "email", $userEmail);

    if ($user && password_verify($userPassword, $user["password"])) {
        $_SESSION["loginID"] = $user["id"];
        back("index.php", "successMessage", "login successfully");
    }

    back("login.php", "errorMessage", "check your email or password");
}

/* ============================= logout ============================= */

if (isset($_GET["logout"])) {
    unset($_SESSION["loginID"]);
    session_destroy();
    back("login.php", "successMessage", "logout successfully");
}

/* ============================== users ============================= */

if (isset($_POST["btn-user"])) {

    mustLogin();

    $id           = $_POST["id"];
    $userName     = trim($_POST["name"]);
    $userEmail    = trim($_POST["email"]);
    $userPassword = $_POST["password"];

    $backPage = ($id != "") ? "userForm.php?id=" . $id . "&" : "userForm.php?";

    if (!preg_match($namePattern, $userName)) {
        header("location:" . $backPage . "errorMessage=" . urlencode("enter a valid name , letters only and at least 3 characters"));
        exit;
    }

    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        header("location:" . $backPage . "errorMessage=" . urlencode("enter a valid email"));
        exit;
    }

    $sameEmail = $db->findBy("users", "email", $userEmail);

    if ($sameEmail && $sameEmail["id"] != $id) {
        header("location:" . $backPage . "errorMessage=" . urlencode("email already exist"));
        exit;
    }

    if ($id == "") {

        if (!preg_match($passwordPattern, $userPassword)) {
            header("location:" . $backPage . "errorMessage=" . urlencode($passwordMessage));
            exit;
        }

        $db->create("users", [
            "name"     => $userName,
            "email"    => $userEmail,
            "password" => password_hash($userPassword, PASSWORD_DEFAULT),
        ]);

        back("users.php", "successMessage", "user created successfully");
    }

    $data = [
        "name"  => $userName,
        "email" => $userEmail,
    ];

    if (trim($userPassword) !== "") {

        if (!preg_match($passwordPattern, $userPassword)) {
            header("location:" . $backPage . "errorMessage=" . urlencode($passwordMessage));
            exit;
        }

        $data["password"] = password_hash($userPassword, PASSWORD_DEFAULT);
    }

    $db->update("users", $id, $data);

    back("users.php", "successMessage", "user updated successfully");
}

/* =========================== departments ========================== */

if (isset($_POST["btn-department"])) {

    mustLogin();

    $id   = $_POST["dnum"];
    $data = [
        "dname"          => trim($_POST["dname"]),
        "mgr_ssn"        => nullIfEmpty($_POST["mgr_ssn"]),
        "mgr_start_date" => nullIfEmpty($_POST["mgr_start_date"]),
    ];

    if ($data["dname"] === "") {
        back("departmentForm.php", "errorMessage", "department name is required");
    }

    if ($id == "") {
        $db->create("departments", $data);
        back("departments.php", "successMessage", "department created successfully");
    }

    $db->update("departments", $id, $data, "dnum");
    back("departments.php", "successMessage", "department updated successfully");
}

/* ============================ employees =========================== */

if (isset($_POST["btn-employee"])) {

    mustLogin();

    $id   = $_POST["ssn"];
    $data = [
        "fname"   => trim($_POST["fname"]),
        "lname"   => trim($_POST["lname"]),
        "bdate"   => nullIfEmpty($_POST["bdate"]),
        "address" => nullIfEmpty($_POST["address"]),
        "gender"  => nullIfEmpty($_POST["gender"]),
        "salary"  => nullIfEmpty($_POST["salary"]),
        "dnum"    => nullIfEmpty($_POST["dnum"]),
    ];

    if ($data["fname"] === "" || $data["lname"] === "") {
        back("employeeForm.php", "errorMessage", "first name and last name are required");
    }

    if ($id == "") {
        $db->create("employees", $data);
        back("employees.php", "successMessage", "employee created successfully");
    }

    $db->update("employees", $id, $data, "ssn");
    back("employees.php", "successMessage", "employee updated successfully");
}

/* ============================= projects =========================== */

if (isset($_POST["btn-project"])) {

    mustLogin();

    $id   = $_POST["pnumber"];
    $data = [
        "pname"     => trim($_POST["pname"]),
        "plocation" => nullIfEmpty($_POST["plocation"]),
        "dnum"      => nullIfEmpty($_POST["dnum"]),
    ];

    if ($data["pname"] === "") {
        back("projectForm.php", "errorMessage", "project name is required");
    }

    if ($id == "") {
        $db->create("projects", $data);
        back("projects.php", "successMessage", "project created successfully");
    }

    $db->update("projects", $id, $data, "pnumber");
    back("projects.php", "successMessage", "project updated successfully");
}

/* ============================== delete ============================ */

if (isset($_GET["delete"])) {

    mustLogin();

    $keys = [
        "users"       => "id",
        "departments" => "dnum",
        "employees"   => "ssn",
        "projects"    => "pnumber",
    ];

    $table = $_GET["table"];
    $id    = $_GET["id"];

    if (!isset($keys[$table])) {
        back("index.php", "errorMessage", "unknown table");
    }

    if ($table == "users" && $id == $_SESSION["loginID"]) {
        back("users.php", "errorMessage", "you can not delete the user you are login with");
    }

    $db->delete($table, $id, $keys[$table]);

    back($table . ".php", "successMessage", "deleted successfully");
}

header("location:index.php");
exit;
