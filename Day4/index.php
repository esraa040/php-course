<?php
require "./connection.php";

$pageTitle = "Home";
require "./header.php";
?>

<h1 class="mb-4">Day4 : CRUD with Database</h1>

<?php
if (isset($_SESSION["loginID"])) {

    $loginUser = $db->show("users", $_SESSION["loginID"]);

    echo "<p class='lead'> welcome : " . htmlspecialchars($loginUser["name"]) . "</p>";

    $tables = [
        "users"       => "users.php",
        "departments" => "departments.php",
        "employees"   => "employees.php",
        "projects"    => "projects.php",
    ];

    echo "<div class='row'>";

    foreach ($tables as $table => $page) {
        $count = count($db->index($table));

        echo "<div class='col-md-3 mb-3'>";
        echo "<div class='card text-center'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $table . "</h5>";
        echo "<p class='display-6'>" . $count . "</p>";
        echo "<a class='btn btn-primary' href='" . $page . "'>manage</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    echo "</div>";
} else {
    echo "<p class='lead'> you are not login </p>";
    echo "<a class='btn btn-primary' href='./register.php'>Register</a> ";
    echo "<a class='btn btn-outline-primary' href='./login.php'>Login</a>";
}
?>

<?php require "./footer.php"; ?>
