<?php
require "./connection.php";
require "./auth.php";

$employee = [
    "ssn"     => "",
    "fname"   => "",
    "lname"   => "",
    "bdate"   => "",
    "address" => "",
    "gender"  => "",
    "salary"  => "",
    "dnum"    => "",
];

if (isset($_GET["ssn"])) {

    $found = $db->show("employees", $_GET["ssn"], "ssn");

    if (!$found) {
        header("location:employees.php?errorMessage=" . urlencode("employee not found"));
        exit;
    }

    $employee = $found;
}

$pageTitle = ($employee["ssn"] == "") ? "Add Employee" : "Edit Employee";
require "./header.php";

$allDepartments = $db->index("departments");
?>

<h1 class="mb-4"><?php echo $pageTitle; ?></h1>

<form action="server.php" method="post" class="border border-primary w-75 p-4">

    <input type="hidden" name="ssn" value="<?php echo $employee["ssn"]; ?>">

    <div class="mb-3">
        <label class="form-label">first name</label>
        <input class="form-control" type="text" name="fname" value="<?php echo htmlspecialchars($employee["fname"]); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">last name</label>
        <input class="form-control" type="text" name="lname" value="<?php echo htmlspecialchars($employee["lname"]); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">birth date</label>
        <input class="form-control" type="date" name="bdate" value="<?php echo $employee["bdate"]; ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">address</label>
        <input class="form-control" type="text" name="address" value="<?php echo htmlspecialchars($employee["address"]); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label d-block">gender</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="male" value="male"
                <?php echo ($employee["gender"] == "male") ? "checked" : ""; ?>>
            <label class="form-check-label" for="male">male</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="female" value="female"
                <?php echo ($employee["gender"] == "female") ? "checked" : ""; ?>>
            <label class="form-check-label" for="female">female</label>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">salary</label>
        <input class="form-control" type="number" step="0.01" name="salary" value="<?php echo $employee["salary"]; ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">department</label>
        <select class="form-select" name="dnum">
            <option value=""> -- no department -- </option>
            <?php
            foreach ($allDepartments as $department) {
                $selected = ($employee["dnum"] == $department["dnum"]) ? "selected" : "";
                echo "<option value='" . $department["dnum"] . "' " . $selected . ">" . htmlspecialchars($department["dname"]) . "</option>";
            }
            ?>
        </select>
    </div>

    <button class="btn btn-primary" type="submit" name="btn-employee">save</button>
    <a class="btn btn-secondary" href="./employees.php">cancel</a>
</form>

<?php require "./footer.php"; ?>
