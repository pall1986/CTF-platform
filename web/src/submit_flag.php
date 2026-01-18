<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$challenge_id = $_POST['challenge_id'] ?? null;
$flag_input = $_POST['flag'] ?? '';

if (!$challenge_id || !$flag_input) {
    die('<p style="color:red;">Errore: dati mancanti!</p>');
}

// Prendi la challenge dal DB
$stmt = $pdo->prepare("SELECT * FROM challenges WHERE id = :id AND active = 1");
$stmt->execute([':id' => $challenge_id]);
$challenge = $stmt->fetch();

if (!$challenge) {
    die('<p style="color:red;">Challenge non trovata!</p>');
}

// Controlla flag
if (trim($flag_input) === $challenge['flag']) {
    // Verifica se già risolta
    $stmt = $pdo->prepare("SELECT * FROM solves WHERE user_id = :uid AND challenge_id = :cid");
    $stmt->execute([':uid' => $user_id, ':cid' => $challenge_id]);
    $solved = $stmt->fetch();

    if (!$solved) {
        $stmt = $pdo->prepare("INSERT INTO solves (user_id, challenge_id) VALUES (:uid, :cid)");
        $stmt->execute([':uid' => $user_id, ':cid' => $challenge_id]);
    }

    echo '
    <div style="background-color:#d4edda; color:#155724; border:1px solid #c3e6cb; padding:10px; border-radius:5px; text-align:center;">
        ✅ Flag corretta! Hai guadagnato ' . $challenge['points'] . ' punti.<br>
        <a href="dashboard.php" style="text-decoration:none;color:#155724;font-weight:bold;">Torna alla dashboard</a>
    </div>
    ';
} else {
    echo '
    <div style="background-color:#f8d7da; color:#721c24; border:1px solid #f5c6cb; padding:10px; border-radius:5px; text-align:center;">
        ❌ Flag errata! Riprova.<br>
        <a href="challenge.php?c=' . htmlspecialchars($challenge['slug']) . '" style="text-decoration:none;color:#721c24;font-weight:bold;">Torna alla sfida</a>
    </div>
    ';
}
