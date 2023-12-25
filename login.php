<?php
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectm";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if a user with the given username exists
    if ($stmt->num_rows == 1) {
        // Fetch the user data
        $stmt->bind_result($id, $dbUsername, $dbPassword);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $dbPassword)) {
            // Password is correct, create a session
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $dbUsername;

            // Redirect to the home page or wherever you want
            header("Location: index.php");
            exit();
        } else {
            // Password is incorrect
            $_SESSION['error'] = "Invalid password";
        }
    } else {
        // No user found with the provided username
        $_SESSION['error'] = "Invalid username";
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!-- Your HTML login form goes here -->


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="fontawesome/css/all.css" />
    <title>Login</title>
  </head>

  <header>
    <nav
      class="navbar navbar-expand-lg fixed-top navbar-light bg-custom shadow-sm p-1 mb-3 bg-white"
    >
      <div class="container">
        <a class="navbar-brand" href="/">
          <img src="assets/images/svmmer.png" width="160px" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="mr-auto"></div>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <i class="fa fa-home"></i>
                Home</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/status.html">
                <i class="fa fa-search"></i>
                Cek Pesanan</a
              >
            </li>
            <li class="nav-item">
              <a class="btn btn-outline-primary" href="/login.php">
                <i class="fa fa-sign-in-alt"></i>
                Masuk</a
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <body>
    <br /><br /><br /><br />

    <div class="container mt-4">
      <div class="row justify-content-center" style="margin: 0px">
        <div class="col-md-12 col-sm-12 col-lg-8">
          <div class="card">
            <div class="card-body">
              <h5>Masuk</h5>
              <hr />
              <form method="POST">
                <div class="">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required="" />
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required="" />
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-original mt-3" name="login">
                        <i class="fas fa-sign-in-alt"></i> Masuk
                    </button>
                </div>
                  <div class="mb-3">
                      Belum punya akun? <a href="register.php">Daftar Sekarang</a><br />
                      <button type="submit" class="btn btn-original mt-3" name="submit">
                          <i class="fas fa-paper-plane"></i> Daftar Sekarang
                      </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="container py-5 p-4">
      <div class="row">
        <div class="col-7">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="d-block mb-2"
          >
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="14.31" y1="8" x2="20.05" y2="17.94"></line>
            <line x1="9.69" y1="8" x2="21.17" y2="8"></line>
            <line x1="7.38" y1="12" x2="13.12" y2="2.06"></line>
            <line x1="9.69" y1="16" x2="3.95" y2="6.06"></line>
            <line x1="14.31" y1="16" x2="2.83" y2="16"></line>
            <line x1="16.62" y1="12" x2="10.88" y2="21.94"></line>
          </svg>
          <p>Svmmergram adalah layanan topup game termurah di Indonesia.</p>
          <small class="d-block mb-3 text-muted">©2023, uas_pemweb_kelas-B</small>
        </div>
        <div class="col-5">
          <h5>About</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">About</a></li>
            <li><a class="text-muted" href="#">Privacy</a></li>
            <li><a class="text-muted" href="#">Terms</a></li>
          </ul>
        </div>
      </div>
    </footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
      crossorigin="anonymous"
    ></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>
