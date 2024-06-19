<!DOCTYPE html>
<html>
<head>
    <title><?= $card->getName() ?></title>
</head>
<body>
    <h1><?= $card->getName() ?></h1>
    <p>Attack: <?= $card->getAttack() ?></p>
    <p>Defense: <?= $card->getDefense() ?></p>
    <p>Rarity: <?= $card->getRarity() ?></p>
    <p>Price: <?= $card->getPrice() ?></p>
    <a href="/cards/<?= $card->getId() ?>/edit">Edit</a>
    <form method="POST" action="/cards/<?= $card->getId() ?>">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit">Delete</button>
    </form>
</body>
</html>