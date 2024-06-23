{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}
<!DOCTYPE html>
<html>
<head>
    <title>Decks Lijst</title>
</head>
<body>
    <h1>Decks</h1>
    <a href="/deck/create">Nieuw Deck Toevoegen</a>
    <ul>
        <?php foreach ($decks as $deck): ?>
            <li>
                <?php echo htmlspecialchars($deck->getName()); ?>
                - <a href="/deck/show/<?php echo $deck->getId(); ?>">Bekijken</a>
                - <a href="/deck/edit/<?php echo $deck->getId(); ?>">Bewerken</a>
                - <a href="/deck/delete/<?php echo $deck->getId(); ?>" onclick="return confirm('Weet je zeker dat je dit deck wilt verwijderen?');">Verwijderen</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
{% endblock %}