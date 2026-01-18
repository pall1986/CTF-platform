<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>CTF Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen">

<nav class="bg-gray-800 p-4 flex justify-between items-center shadow">
    <div class="text-xl font-bold text-green-400">🏴‍☠️ CTF Platform</div>
    <div class="space-x-4">
        <a href="dashboard.php" class="hover:text-green-400">Dashboard</a>
        <a href="leaderboard.php" class="hover:text-green-400">Classifica</a>
        <span class="text-sm text-gray-300">
            👤 <?= htmlspecialchars($_SESSION['username'] ?? '') ?>
        </span>
        <a href="logout.php" class="text-red-400 hover:text-red-300">Logout</a>
    </div>
</nav>

<div class="container mx-auto p-6">
