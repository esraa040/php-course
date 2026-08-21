<?php
require "./connection.php";
require "./auth.php";

$pageTitle = "Users";
require "./header.php";

$allUsers = $db->index("users");
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Users</h1>
    <a class="btn btn-success" href="./userForm.php">+ Add User</a>
</div>

<?php
if (count($allUsers) == 0) {
    echo "<div class='alert alert-info'> there is no users </div>";
} else {

    echo "<table class='table table-striped table-bordered table-hover'>";
    echo "<thead class='table-dark'>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>name</th>";
    echo "<th>email</th>";
    echo "<th>Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($allUsers as $user) {
        echo "<tr>";
        echo "<td>" . $user["id"] . "</td>";
        echo "<td>" . htmlspecialchars($user["name"]) . "</td>";
        echo "<td>" . htmlspecialchars($user["email"]) . "</td>";
        echo "<td>";
        echo "<a class='btn btn-warning btn-sm' href='userForm.php?id=" . $user["id"] . "'>edit</a> ";
        echo "<a class='btn btn-danger btn-sm' href='server.php?delete=1&table=users&id=" . $user["id"] . "' onclick='return confirm(\"are you sure ?\")'>delete</a>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}
?>

<?php require "./footer.php"; ?>
