<?php
require "./connection.php";
require "./auth.php";

$department = [
    "dnum"           => "",
    "dname"          => "",
    "mgr_ssn"        => "",
    "mgr_start_date" => "",
];

if (isset($_GET["dnum"])) {

    $found = $db->show("departments", $_GET["dnum"], "dnum");

    if (!$found) {
        header("location:departments.php?errorMessage=" . urlencode("department not found"));
        exit;
    }

    $department = $found;
}

$pageTitle = ($department["dnum"] == "") ? "Add Department" : "Edit Department";
require "./header.php";
?>

<h1 class="mb-4"><?php echo $pageTitle; ?></h1>

<form action="server.php" method="post" class="border border-primary w-75 p-4">

    <input type="hidden" name="dnum" value="<?php echo $department["dnum"]; ?>">

    <div class="mb-3">
        <label class="form-label">department name</label>
        <input class="form-control" type="text" name="dname" value="<?php echo htmlspecialchars($department["dname"]); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">manager ssn</label>
        <input class="form-control" type="number" name="mgr_ssn" value="<?php echo $department["mgr_ssn"]; ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">manager start date</label>
        <input class="form-control" type="date" name="mgr_start_date" value="<?php echo $department["mgr_start_date"]; ?>">
    </div>

    <button class="btn btn-primary" type="submit" name="btn-department">save</button>
    <a class="btn btn-secondary" href="./departments.php">cancel</a>
</form>

<?php require "./footer.php"; ?>
