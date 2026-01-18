<?php
require 'config.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "❌ Username o password errati";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<title>CTF Login</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 flex items-center justify-center h-screen text-gray-100">

<div class="bg-gray-800 p-8 rounded-xl shadow-xl w-full max-w-md">
    <h1 class="text-3xl font-bold text-center text-green-400 mb-6">
        🏴‍☠️ CTF Platform
    </h1>

    <?php if ($error): ?>
        <div class="bg-red-900 text-red-300 p-3 rounded mb-4">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
        <input name="username"
               placeholder="👤 Username"
               required
               class="w-full p-3 rounded bg-gray-900 border border-gray-700 focus:outline-none focus:border-green-500">

        <input type="password"
               name="password"
               placeholder="🔒 Password"
               required
               class="w-full p-3 rounded bg-gray-900 border border-gray-700 focus:outline-none focus:border-green-500">

        <button class="w-full bg-green-600 p-3 rounded font-bold hover:bg-green-700 transition">
            Login
        </button>
    </form>

    <p class="text-center mt-4 text-gray-400">
        Non hai un account?
        <a href="register.php" class="text-green-400 hover:underline">
            Registrati
        </a>
    </p>
</div>

</body>
</html>
