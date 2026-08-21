<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">Day2</a>
    <div class="collapse navbar-collapse show">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="./index.php">Home</a>
        </li>
        <?php if (isset($_SESSION["loginUser"])) { ?>
          <li class="nav-item">
            <a class="nav-link" href="./allUsers.php">All Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="./server.php?logout=1">Logout</a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="./register.php">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./login.php">Login</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
