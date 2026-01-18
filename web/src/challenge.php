<?php
require 'config.php';
require 'header.php';

$slug = $_GET['c'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM challenges WHERE slug = ? AND active = 1");
$stmt->execute([$slug]);
$challenge = $stmt->fetch();

if (!$challenge) {
    echo "<p class='text-red-400'>Challenge non trovata</p>";
    require 'footer.php';
    exit;
}
?>

<div class="max-w-xl mx-auto bg-gray-800 p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-2"><?= htmlspecialchars($challenge['title']) ?></h2>

    <p class="text-gray-300 mb-4"><?= nl2br(htmlspecialchars($challenge['description'])) ?></p>

    <div class="bg-black p-4 rounded text-green-400 font-mono mb-4">
        IODJ{FHVVDU_H_DPLFR}
    </div>

    <form method="POST" action="submit_flag.php" class="space-y-3">
        <input type="hidden" name="challenge_id" value="<?= $challenge['id'] ?>">
        <input name="flag" placeholder="FLAG{...}"
               class="w-full p-2 rounded bg-gray-900 border border-gray-600">
        <button class="w-full bg-green-600 p-2 rounded hover:bg-green-700">
            Invia flag
        </button>
    </form>
</div>

<?php require 'footer.php'; ?>
