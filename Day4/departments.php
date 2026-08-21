<?php
require "./connection.php";
require "./auth.php";

$pageTitle = "Departments";
require "./header.php";

$allDepartments = $db->index("departments");
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Departments</h1>
    <a class="btn btn-success" href="./departmentForm.php">+ Add Department</a>
</div>

<?php
if (count($allDepartments) == 0) {
    echo "<div class='alert alert-info'> there is no departments </div>";
} else {

    echo "<table class='table table-striped table-bordered table-hover'>";
    echo "<thead class='table-dark'>";
    echo "<tr>";
    echo "<th>dnum</th>";
    echo "<th>dname</th>";
    echo "<th>mgr_ssn</th>";
    echo "<th>mgr_start_date</th>";
    echo "<th>Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($allDepartments as $department) {
        echo "<tr>";
        echo "<td>" . $department["dnum"] . "</td>";
        echo "<td>" . htmlspecialchars($department["dname"]) . "</td>";
        echo "<td>" . $department["mgr_ssn"] . "</td>";
        echo "<td>" . $department["mgr_start_date"] . "</td>";
        echo "<td>";
        echo "<a class='btn btn-warning btn-sm' href='departmentForm.php?dnum=" . $department["dnum"] . "'>edit</a> ";
        echo "<a class='btn btn-danger btn-sm' href='server.php?delete=1&table=departments&id=" . $department["dnum"] . "' onclick='return confirm(\"are you sure ?\")'>delete</a>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}
?>

<?php require "./footer.php"; ?>
