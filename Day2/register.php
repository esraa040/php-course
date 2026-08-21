<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <?php require "./home.php"; ?>

    <section class="m-3">
        <form action="server.php" method="post" class="border border-primary w-75 m-auto p-5">
            <h2 class="text-center">Register</h2>

            <input class="form-control m-3" type="text" name="userName" placeholder="Enter Your Name" required>

            <input class="form-control m-3" type="email" name="userEmail" placeholder="Enter Your Email" required>

            <input class="form-control m-3" type="password" name="userPassword" placeholder="Enter Your Password" required>

            <input class="btn btn-primary m-3" type="submit" value="Register" name="btn-register">
        </form>
    </section>
</body>

</html>
