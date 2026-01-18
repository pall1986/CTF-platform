<?php
require 'config.php';
require 'header.php';

$user_id = $_SESSION['user_id'];

$solved = $pdo->prepare("
    SELECT challenge_id FROM solves WHERE user_id = ?
");
$solved->execute([$user_id]);
$solved_ids = array_column($solved->fetchAll(), 'challenge_id');

$challenges = $pdo->query("
    SELECT * FROM challenges WHERE active = 1 ORDER BY points ASC
")->fetchAll();
?>

<h1 class="text-3xl font-bold mb-6">🎯 Sfide disponibili</h1>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
<?php foreach ($challenges as $c): 
    $done = in_array($c['id'], $solved_ids);
?>
<div class="rounded-lg p-5 shadow-lg 
<?= $done ? 'bg-green-900' : 'bg-gray-800' ?>">

    <h2 class="text-xl font-bold"><?= htmlspecialchars($c['title']) ?></h2>

    <p class="text-gray-300 mt-2"><?= htmlspecialchars($c['description']) ?></p>

    <div class="mt-4 flex justify-between items-center">
        <span class="text-yellow-400 font-semibold">
            ⭐ <?= $c['points'] ?> punti
        </span>

        <?php if ($done): ?>
            <span class="text-green-400 font-bold">✔ Risolta</span>
        <?php else: ?>
            <a href="challenge.php?c=<?= urlencode($c['slug']) ?>"
               class="bg-green-600 px-4 py-1 rounded hover:bg-green-700">
               Vai
            </a>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; ?>
</div>

<?php require 'footer.php'; ?>
