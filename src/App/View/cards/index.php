<!DOCTYPE html>
<html>
<head>
    <title>Cards</title>
</head>
<body>
    <h1>Cards</h1>
    <?php if (!empty($cards)): ?>
        <ul>
            <?php foreach ($cards as $card): ?>
                <li>
                    <h2><?php echo htmlspecialchars($card->getName(), ENT_QUOTES, 'UTF-8'); ?></h2>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No cards found.</p>
    <?php endif; ?>
</body>
</html>