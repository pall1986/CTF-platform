<?php
require 'config.php';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {

        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$_POST['username']]);

        if ($stmt->fetch()) {
            $error = "⚠ Username già esistente";
        } else {
            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$_POST['username'], $hash]);
            $success = "✅ Registrazione completata!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<title>CTF Register</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 flex items-center justify-center h-screen text-gray-100">

<div class="bg-gray-800 p-8 rounded-xl shadow-xl w-full max-w-md">
    <h1 class="text-3xl font-bold text-center text-green-400 mb-6">
        📝 Registrazione
    </h1>

    <?php if ($error): ?>
        <div class="bg-red-900 text-red-300 p-3 rounded mb-4">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="bg-green-900 text-green-300 p-3 rounded mb-4">
            <?= htmlspecialchars($success) ?>
            <br>
            <a href="index.php" class="underline">Vai al login</a>
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
            Registrati
        </button>
    </form>

    <p class="text-center mt-4 text-gray-400">
        Hai già un account?
        <a href="index.php" class="text-green-400 hover:underline">
            Login
        </a>
    </p>
</div>

</body>
</html>
