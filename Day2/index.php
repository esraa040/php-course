<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day2 - Home</title>
</head>

<body>
    <?php require "./home.php"; ?>

    <section class="m-3">
        <h1 class="text-center text-primary">Day2 : Super Global Variables</h1>

        <?php
        if (isset($_SESSION["loginUser"])) {
            echo "<p class='text-center'> welcome : " . $_SESSION["loginUser"]["userName"] . "</p>";
            echo "<p class='text-center'><a class='btn btn-success' href='./allUsers.php'>go to all users</a></p>";
        } else {
            echo "<p class='text-center'> you are not login </p>";
            echo "<p class='text-center'>";
            echo "<a class='btn btn-primary' href='./register.php'>Register</a> ";
            echo "<a class='btn btn-outline-primary' href='./login.php'>Login</a>";
            echo "</p>";
        }
        ?>
    </section>
</body>

</html>
