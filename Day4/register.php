<?php
require "./connection.php";

$pageTitle = "Register";
require "./header.php";
?>

<h1 class="mb-4">Register</h1>

<form action="server.php" method="post" class="border border-primary w-75 p-4">

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input class="form-control" type="text" name="userName" placeholder="Enter Your Name"
            value="<?php echo isset($_GET["userName"]) ? htmlspecialchars($_GET["userName"]) : ""; ?>">
        <small class="text-muted">letters only , at least 3 characters</small>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input class="form-control" type="text" name="userEmail" placeholder="Enter Your Email"
            value="<?php echo isset($_GET["userEmail"]) ? htmlspecialchars($_GET["userEmail"]) : ""; ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input class="form-control" type="password" name="userPassword" placeholder="Enter Your Password">
        <small class="text-muted">at least 8 characters , one capital letter , one small letter and one number</small>
    </div>

    <input class="btn btn-primary" type="submit" value="Register" name="btn-register">
    <a class="btn btn-link" href="./login.php">i have an account</a>
</form>

<?php require "./footer.php"; ?>
