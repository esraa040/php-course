<?php
require "./connection.php";
require "./auth.php";

$user = [
    "id"    => "",
    "name"  => "",
    "email" => "",
];

if (isset($_GET["id"])) {

    $found = $db->show("users", $_GET["id"]);

    if (!$found) {
        header("location:users.php?errorMessage=" . urlencode("user not found"));
        exit;
    }

    $user = $found;
}

$pageTitle = ($user["id"] == "") ? "Add User" : "Edit User";
require "./header.php";
?>

<h1 class="mb-4"><?php echo $pageTitle; ?></h1>

<form action="server.php" method="post" class="border border-primary w-75 p-4">

    <input type="hidden" name="id" value="<?php echo $user["id"]; ?>">

    <div class="mb-3">
        <label class="form-label">name</label>
        <input class="form-control" type="text" name="name" value="<?php echo htmlspecialchars($user["name"]); ?>">
        <small class="text-muted">letters only , at least 3 characters</small>
    </div>

    <div class="mb-3">
        <label class="form-label">email</label>
        <input class="form-control" type="text" name="email" value="<?php echo htmlspecialchars($user["email"]); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">password</label>
        <input class="form-control" type="password" name="password">
        <small class="text-muted">
            <?php echo ($user["id"] == "") ? "at least 8 characters , one capital letter , one small letter and one number" : "leave it empty to keep the old password"; ?>
        </small>
    </div>

    <button class="btn btn-primary" type="submit" name="btn-user">save</button>
    <a class="btn btn-secondary" href="./users.php">cancel</a>
</form>

<?php require "./footer.php"; ?>
