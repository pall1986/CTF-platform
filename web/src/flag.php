<?php
require 'config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $challenge_id = $_POST['challenge_id'] ?? '';
    $user_flag = $_POST['flag'] ?? '';

    if (empty($challenge_id) || empty($user_flag)) {
        $message = "Sfida e flag obbligatorie!";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM challenges WHERE id = :id AND flag = :flag");
        $stmt->execute([':id' => $challenge_id, ':flag' => $user_flag]);
        $challenge = $stmt->fetch();

        if ($challenge) {
            $stmt_check = $pdo->prepare("SELECT * FROM solved WHERE user_id = :uid AND challenge_id = :cid");
            $stmt_check->execute([':uid' => $user_id, ':cid' => $challenge_id]);

            if (!$stmt_check->fetch()) {
                $stmt_insert = $pdo->prepare("INSERT INTO solved (user_id, challenge_id) VALUES (:uid, :cid)");
                $stmt_insert->execute([':uid' => $user_id, ':cid' => $challenge_id]);

                $stmt_score = $pdo->prepare("UPDATE users SET score = score + :points WHERE id = :uid");
                $stmt_score->execute([':points' => $challenge['points'], ':uid' => $user_id]);

                $message = "Flag corretta! Punteggio aggiornato.";
            } else {
                $message = "Hai già risolto questa sfida!";
            }
        } else {
            $message = "Flag errata!";
        }
    }
}
?>

<h2>Invia Flag</h2>

<form method="POST">
    Sfida (ID): <input name="challenge_id" required><br>
    Flag: <input name="flag" required><br>
    <button type="submit">Invia</button>
</form>

<?php
if ($message) echo "<p style='color:green;'>$message</p>";
?>
