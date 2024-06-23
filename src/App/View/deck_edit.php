{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}
<!DOCTYPE html>
<html>
<head>
    <title>Deck Bewerken</title>
</head>
<body>
    <h1>Deck Bewerken: <?php echo htmlspecialchars($deck->getName()); ?></h1>
    <form action="/deck/update/<?php echo $deck->getId(); ?>" method="post">
        <label for="name">Deck Naam:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($deck->getName()); ?>" required>
        <label for="user_id">Gebruiker ID:</label>
        <input type="text" id="user_id" name="user_id" value="<?php echo htmlspecialchars($deck->getUserId()); ?>" required>
        <button type="submit">Wijzigingen Opslaan</button>
    </form>
</body>
</html>
{% endblock %}