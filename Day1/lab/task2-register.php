<?php

$name   = "";
$email  = "";
$age    = "";
$gender = "";
$city   = "";
$errors = [];

if (isset($_POST["register"])) {

    $name     = isset($_POST["name"])     ? $_POST["name"]     : "";
    $email    = isset($_POST["email"])    ? $_POST["email"]    : "";
    $age      = isset($_POST["age"])      ? $_POST["age"]      : "";
    $gender   = isset($_POST["gender"])   ? $_POST["gender"]   : "";
    $city     = isset($_POST["city"])     ? $_POST["city"]     : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $confirm  = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : "";

    if (empty($name)) {
        $errors[] = "name is required";
    }
    if (empty($email)) {
        $errors[] = "email is required";
    }
    if (empty($password)) {
        $errors[] = "password is required";
    }
    if ($password != $confirm) {
        $errors[] = "password and confirm password are not the same";
    }
    if (empty($gender)) {
        $errors[] = "gender is required";
    }
    if (!isset($_POST["agree"])) {
        $errors[] = "you must agree to the terms";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 2 - register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1 class="mb-4">Task 2 : register page</h1>

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

        if (isset($_POST["register"]) && count($errors) == 0) {

            echo "<div class='alert alert-success w-50'> account created successfully </div>";

            $user = [
                "name"   => $name,
                "email"  => $email,
                "age"    => $age,
                "gender" => $gender,
                "city"   => $city
            ];

            echo "<table class='table table-striped table-bordered w-50'>";
            echo "<thead class='table-dark'>";
            echo "<tr><th>key</th><th>value</th></tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($user as $key => $value) {
                echo "<tr>";
                echo "<td>" . $key . "</td>";
                echo "<td>" . $value . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }
        ?>

        <form action="" method="post" class="w-50">

            <div class="mb-3">
                <label for="name" class="form-label">name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="basmala" value="<?php echo $name; ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="iti@iti.com" value="<?php echo $email; ?>">
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">age</label>
                <input type="number" name="age" id="age" class="form-control" value="<?php echo $age; ?>">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">confirm password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label d-block">gender</label>

                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" id="male" value="male" class="form-check-input"
                        <?php echo ($gender == "male") ? "checked" : ""; ?>>
                    <label for="male" class="form-check-label">male</label>
                </div>

                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" id="female" value="female" class="form-check-input"
                        <?php echo ($gender == "female") ? "checked" : ""; ?>>
                    <label for="female" class="form-check-label">female</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">city</label>
                <select name="city" id="city" class="form-select">
                    <?php
                    $cities = ["cairo", "sadat", "menoufia", "alex"];
                    foreach ($cities as $item) {
                        $selected = ($city == $item) ? "selected" : "";
                        echo "<option value='" . $item . "' " . $selected . ">" . $item . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="agree" id="agree" class="form-check-input">
                <label for="agree" class="form-check-label">i agree to the terms</label>
            </div>

            <button type="submit" name="register" class="btn btn-success">register</button>
            <a href="./task2-login.php" class="btn btn-link">i have an account</a>

        </form>
    </div>

</body>

</html>
