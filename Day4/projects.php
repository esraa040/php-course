<?php
require "./connection.php";
require "./auth.php";

$pageTitle = "Projects";
require "./header.php";

$allProjects = $db->index("projects");

$departmentNames = [];
foreach ($db->index("departments") as $department) {
    $departmentNames[$department["dnum"]] = $department["dname"];
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Projects</h1>
    <a class="btn btn-success" href="./projectForm.php">+ Add Project</a>
</div>

<?php
if (count($allProjects) == 0) {
    echo "<div class='alert alert-info'> there is no projects </div>";
} else {

    echo "<table class='table table-striped table-bordered table-hover'>";
    echo "<thead class='table-dark'>";
    echo "<tr>";
    echo "<th>pnumber</th>";
    echo "<th>pname</th>";
    echo "<th>plocation</th>";
    echo "<th>department</th>";
    echo "<th>Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($allProjects as $project) {

        $departmentName = isset($departmentNames[$project["dnum"]]) ? $departmentNames[$project["dnum"]] : "-";

        echo "<tr>";
        echo "<td>" . $project["pnumber"] . "</td>";
        echo "<td>" . htmlspecialchars($project["pname"]) . "</td>";
        echo "<td>" . htmlspecialchars($project["plocation"]) . "</td>";
        echo "<td>" . htmlspecialchars($departmentName) . "</td>";
        echo "<td>";
        echo "<a class='btn btn-warning btn-sm' href='projectForm.php?pnumber=" . $project["pnumber"] . "'>edit</a> ";
        echo "<a class='btn btn-danger btn-sm' href='server.php?delete=1&table=projects&id=" . $project["pnumber"] . "' onclick='return confirm(\"are you sure ?\")'>delete</a>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}
?>

<?php require "./footer.php"; ?>
