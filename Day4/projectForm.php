<?php
require "./connection.php";
require "./auth.php";

$project = [
    "pnumber"   => "",
    "pname"     => "",
    "plocation" => "",
    "dnum"      => "",
];

if (isset($_GET["pnumber"])) {

    $found = $db->show("projects", $_GET["pnumber"], "pnumber");

    if (!$found) {
        header("location:projects.php?errorMessage=" . urlencode("project not found"));
        exit;
    }

    $project = $found;
}

$pageTitle = ($project["pnumber"] == "") ? "Add Project" : "Edit Project";
require "./header.php";

$allDepartments = $db->index("departments");
?>

<h1 class="mb-4"><?php echo $pageTitle; ?></h1>

<form action="server.php" method="post" class="border border-primary w-75 p-4">

    <input type="hidden" name="pnumber" value="<?php echo $project["pnumber"]; ?>">

    <div class="mb-3">
        <label class="form-label">project name</label>
        <input class="form-control" type="text" name="pname" value="<?php echo htmlspecialchars($project["pname"]); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">location</label>
        <input class="form-control" type="text" name="plocation" value="<?php echo htmlspecialchars($project["plocation"]); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">department</label>
        <select class="form-select" name="dnum">
            <option value=""> -- no department -- </option>
            <?php
            foreach ($allDepartments as $department) {
                $selected = ($project["dnum"] == $department["dnum"]) ? "selected" : "";
                echo "<option value='" . $department["dnum"] . "' " . $selected . ">" . htmlspecialchars($department["dname"]) . "</option>";
            }
            ?>
        </select>
    </div>

    <button class="btn btn-primary" type="submit" name="btn-project">save</button>
    <a class="btn btn-secondary" href="./projects.php">cancel</a>
</form>

<?php require "./footer.php"; ?>
