<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Babussalamku</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS utama -->
    <link rel="stylesheet" href="../css/style.css">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0a1929 0%, #1e3a5f 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 0 auto 15px;
            color: #0a1929;
        }

        .login-title {
            text-align: center;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .login-subtitle {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            border: none;
            color: #0a1929;
            font-weight: 600;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<div class="login-card">

    <div class="logo-icon">🕌</div>
    <h4 class="login-title">Login Admin</h4>
    <p class="login-subtitle">Pondok Pesantren Babussalam</p>

    <form action="../php/proses_login.php" method="POST">

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Masuk Dashboard
        </button>

    </form>

</div>

</body>
</html>
