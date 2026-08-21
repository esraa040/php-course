<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : "Day4"; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">Day4 CRUD</a>
            <div class="collapse navbar-collapse show">
                <ul class="navbar-nav me-auto">
                    <?php if (isset($_SESSION["loginID"])) { ?>
                        <li class="nav-item"><a class="nav-link" href="./users.php">Users</a></li>
                        <li class="nav-item"><a class="nav-link" href="./departments.php">Departments</a></li>
                        <li class="nav-item"><a class="nav-link" href="./employees.php">Employees</a></li>
                        <li class="nav-item"><a class="nav-link" href="./projects.php">Projects</a></li>
                        <li class="nav-item"><a class="nav-link text-warning" href="./server.php?logout=1">Logout</a></li>
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="./register.php">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="./login.php">Login</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php
        if (isset($_GET["successMessage"])) {
            echo "<div class='alert alert-success'>" . htmlspecialchars($_GET["successMessage"]) . "</div>";
        }

        if (isset($_GET["errorMessage"])) {
            echo "<div class='alert alert-danger'>" . htmlspecialchars($_GET["errorMessage"]) . "</div>";
        }
        ?>
