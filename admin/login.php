<?php
if (isset($_POST['login'])) {
   $username = $_POST['username'];
   $password = $_POST['password'];
   if ($username == "admin" && $password == "pass") {
    session_start();
    $_SESSION["user"] = "admin";
    header("Location:index.php");
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="bg-primary d-flex align-items-center" style="min-height: 100vh;">
    <div class="container">
        <div class="card border-0 shadow-lg mx-auto" style="max-width: 400px; border-radius: 15px;">
            <div class="card-body p-5">
                <h3 class="text-center fw-bold mb-4">Admin Login</h3>
                <form action="login.php" method="post">
                    <div class="mb-3">
                        <label class="form-label small text-muted">Username</label>
                        <input class="form-control bg-light" type="text" name="username" placeholder="admin">
                    </div>
                    <div class="mb-4">
                        <label class="form-label small text-muted">Password</label>
                        <input class="form-control bg-light" type="password" name="password" placeholder="••••••••">
                    </div>
                    <button class="btn btn-primary w-100 py-2 shadow-sm" type="submit" name="login">Sign In</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>