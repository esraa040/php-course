<?php

$email  = "";
$errors = [];

if (isset($_POST["login"])) {

    $email    = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email)) {
        $errors[] = "email is required";
    }
    if (empty($password)) {
        $errors[] = "password is required";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 2 - login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1 class="mb-4">Task 2 : login page</h1>

        <?php
        if (count($errors) > 0) {
            echo "<div class='alert alert-danger w-50'>";
            echo "<ul class='mb-0'>";
            foreach ($errors as $error) {
                echo "<li>" . $error . "</li>";
            }
            echo "</ul>";
            echo "</div>";
        }

        if (isset($_POST["login"]) && count($errors) == 0) {
            echo "<div class='alert alert-success w-50'> welcome : " . $email . "</div>";
        }
        ?>

        <form action="" method="post" class="w-50">

            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="iti@iti.com" value="<?php echo $email; ?>">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="********">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label for="remember" class="form-check-label">remember me</label>
            </div>

            <button type="submit" name="login" class="btn btn-primary">login</button>
            <a href="./task2-register.php" class="btn btn-link">create new account</a>

        </form>
    </div>

</body>

</html>
