<!DOCTYPE html>
<html>
<head>
    <title>Cards</title>
</head>
<body>
    <h1>Cards</h1>
    <a href="/cards/create">Add New Card</a>
    <ul>
        <?php foreach ($cards as $card): ?>
            <li>
                <a href="/cards/<?= $card->getId() ?>">
                    <?= $card->getName() ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>