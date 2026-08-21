<?php

session_start();

if (!isset($_SESSION["loginUser"])) {
    header("location:login.php?error_message=you must login first");
    exit;
}

if (!isset($_GET["id"]) || !isset($_SESSION["usersData"][$_GET["id"]])) {
    header("location:allUsers.php?message=user not found");
    exit;
}

$id   = $_GET["id"];
$user = $_SESSION["usersData"][$id];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>

<body>
    <?php require "./home.php"; ?>

    <section class="m-3">
        <form action="server.php" method="post" class="border border-warning w-75 m-auto p-5">
            <h2 class="text-center">Update User</h2>

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="oldEmail" value="<?php echo $user["userEmail"]; ?>">

            <input class="form-control m-3" type="text" name="userName" value="<?php echo $user["userName"]; ?>" required>

            <input class="form-control m-3" type="email" name="userEmail" value="<?php echo $user["userEmail"]; ?>" required>

            <input class="btn btn-warning m-3" type="submit" value="Update" name="btn-update">
            <a class="btn btn-secondary m-3" href="./allUsers.php">Cancel</a>
        </form>
    </section>
</body>

</html>
