<?php

session_start();

if (!isset($_SESSION["loginUser"])) {
    header("location:login.php?error_message=you must login first");
    exit;
}

if (!isset($_SESSION["usersData"])) {
    $_SESSION["usersData"] = [];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
</head>

<body>
    <?php require "./home.php"; ?>

    <section class="m-3">

        <?php
        if (isset($_GET["message"])) {
            echo "<p class='mt-3 alert alert-success w-75 m-auto text-center'>" . $_GET["message"] . "</p>";
        }

        echo "<h1 class='text-success text-center'> All Users Data </h1>";
        echo "<p class='text-center'> welcome : " . $_SESSION["loginUser"]["userName"] . "</p>";

        echo "<table class='table table-striped table-bordered table-hover w-75 m-auto text-center'>";
        echo "<thead class='table-dark'>";
        echo "<tr>";
        echo "<th>id</th>";
        echo "<th>userName</th>";
        echo "<th>userEmail</th>";
        echo "<th>Actions</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        $id = 0;
        foreach ($_SESSION["usersData"] as $key => $user) {
            echo "<tr>";
            echo "<td>" . ++$id . "</td>";
            echo "<td>" . $user["userName"] . "</td>";
            echo "<td>" . $user["userEmail"] . "</td>";
            echo "<td>";
            echo "<a class='btn btn-danger btn-sm' href='server.php?delete=" . $key . "'>delete</a> ";
            echo "<a class='btn btn-warning btn-sm' href='updateUser.php?id=" . $key . "'>update</a>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";

        if (count($_SESSION["usersData"]) == 0) {
            echo "<p class='alert alert-info w-75 m-auto text-center'> there is no users </p>";
        }
        ?>

    </section>
</body>

</html>
