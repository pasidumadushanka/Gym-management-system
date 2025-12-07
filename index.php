<?php
session_start();
include('dbcon.php');

$login_error = ""; // store error for later display

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['user']);
    $password = mysqli_real_escape_string($con, $_POST['pass']);
    $password = md5($password);

    $query = mysqli_query($con, "SELECT * FROM admin WHERE password='$password' and username='$username'");
    $row = mysqli_fetch_array($query);
    $num_row = mysqli_num_rows($query);

    if ($num_row > 0) {
        $_SESSION['user_id'] = $row['user_id'];
        header('Location: admin/index.php'); // redirect works now
        exit(); // important!
    } else {
        $login_error = "Invalid Username and Password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gym System Admin</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Montserrat', sans-serif;
        height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
        overflow: hidden;
    }

    #loginbox {
        background: rgba(20, 20, 20, 0.95);
        padding: 3rem 3rem;
        border-radius: 1.5rem;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
        width: 100%;
        max-width: 500px;
        transform: translateY(-50px);
        opacity: 0;
        animation: slideFadeIn 1s forwards;
    }

    @keyframes slideFadeIn {
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    #loginbox h3 img {
        width: 130px;
        display: block;
        margin: 0 auto 1.5rem auto;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .form-control {
        background: #1f1f1f;
        border: 1px solid #444;
        color: #eee;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #ff6b6b;
    }

    .input-group-text {
        background: #ff6b6b;
        color: #fff;
        border: none;
    }

    .btn-login {
        background: linear-gradient(45deg, #ff416c, #ff4b2b);
        color: #fff;
        font-weight: 700;
        padding: 0.9rem 1rem;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(255, 75, 43, 0.5);
    }

    .links {
        display: flex;
        justify-content: space-between;
        margin-top: 1.2rem;
    }

    .links a {
        color: #ff6b6b;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .links a:hover {
        color: #ff4b2b;
    }

    .alert {
        margin-top: 1rem;
    }
</style>
</head>
<body>

<div id="loginbox" class="card p-4">
    <form id="loginform" method="POST" class="form-vertical">
        <div class="text-center mb-4">
            <h3><img src="img/icontest3.png" alt="Logo"></h3>
        </div>

        <?php if(!empty($login_error)){ ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $login_error ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } ?>

        <div class="mb-4">
            <div class="input-group input-group-lg">
                <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                <input type="text" name="user" class="form-control" placeholder="Username" required>
            </div>
        </div>

        <div class="mb-4">
            <div class="input-group input-group-lg">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="pass" class="form-control" placeholder="Password" required>
            </div>
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-login btn-lg" name="login" value="Admin Login">Admin Login</button>
        </div>

        <div class="links">
            <a href="customer/index.php">Customer Login</a>
            <a href="staff/index.php">Staff Login</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
