<?php
require "./connection.php";

$pageTitle = "Login";
require "./header.php";
?>

<h1 class="mb-4">Login</h1>

<form action="server.php" method="post" class="border border-primary w-75 p-4">

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input class="form-control" type="email" name="userEmail" placeholder="Enter Your Email">
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input class="form-control" type="password" name="userPassword" placeholder="Enter Your Password">
    </div>

    <input class="btn btn-primary" type="submit" value="login" name="btn-login">
    <a class="btn btn-link" href="./register.php">create new account</a>
</form>

<?php require "./footer.php"; ?>
