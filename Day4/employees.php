<?php
require "./connection.php";
require "./auth.php";

$pageTitle = "Employees";
require "./header.php";

$allEmployees = $db->index("employees");

$departmentNames = [];
foreach ($db->index("departments") as $department) {
    $departmentNames[$department["dnum"]] = $department["dname"];
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Employees</h1>
    <a class="btn btn-success" href="./employeeForm.php">+ Add Employee</a>
</div>

<?php
if (count($allEmployees) == 0) {
    echo "<div class='alert alert-info'> there is no employees </div>";
} else {

    echo "<table class='table table-striped table-bordered table-hover'>";
    echo "<thead class='table-dark'>";
    echo "<tr>";
    echo "<th>ssn</th>";
    echo "<th>fname</th>";
    echo "<th>lname</th>";
    echo "<th>bdate</th>";
    echo "<th>address</th>";
    echo "<th>gender</th>";
    echo "<th>salary</th>";
    echo "<th>department</th>";
    echo "<th>Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($allEmployees as $employee) {

        $departmentName = isset($departmentNames[$employee["dnum"]]) ? $departmentNames[$employee["dnum"]] : "-";

        echo "<tr>";
        echo "<td>" . $employee["ssn"] . "</td>";
        echo "<td>" . htmlspecialchars($employee["fname"]) . "</td>";
        echo "<td>" . htmlspecialchars($employee["lname"]) . "</td>";
        echo "<td>" . $employee["bdate"] . "</td>";
        echo "<td>" . htmlspecialchars($employee["address"]) . "</td>";
        echo "<td>" . $employee["gender"] . "</td>";
        echo "<td>" . $employee["salary"] . "</td>";
        echo "<td>" . htmlspecialchars($departmentName) . "</td>";
        echo "<td>";
        echo "<a class='btn btn-warning btn-sm' href='employeeForm.php?ssn=" . $employee["ssn"] . "'>edit</a> ";
        echo "<a class='btn btn-danger btn-sm' href='server.php?delete=1&table=employees&id=" . $employee["ssn"] . "' onclick='return confirm(\"are you sure ?\")'>delete</a>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}
?>

<?php require "./footer.php"; ?>
