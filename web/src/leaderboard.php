<?php
require 'config.php';
require 'header.php';

$users = $pdo->query("
SELECT u.username, SUM(c.points) AS score
FROM users u
LEFT JOIN solves s ON u.id = s.user_id
LEFT JOIN challenges c ON s.challenge_id = c.id
GROUP BY u.id
ORDER BY score DESC
")->fetchAll();
?>

<h1 class="text-3xl font-bold mb-6">🏆 Classifica</h1>

<table class="w-full bg-gray-800 rounded shadow">
<tr class="bg-gray-700">
    <th class="p-3">#</th>
    <th>Utente</th>
    <th>Punteggio</th>
</tr>

<?php $i=1; foreach ($users as $u): ?>
<tr class="<?= $i<=3 ? 'bg-yellow-900' : '' ?>">
    <td class="p-3"><?= $i++ ?></td>
    <td><?= htmlspecialchars($u['username']) ?></td>
    <td class="text-green-400 font-bold"><?= $u['score'] ?? 0 ?></td>
</tr>
<?php endforeach; ?>
</table>

<?php require 'footer.php'; ?>
