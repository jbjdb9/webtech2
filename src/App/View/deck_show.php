{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}
<!DOCTYPE html>
<html>
<head>
    <title>Deck Details</title>
</head>
<body>
    <h1>Deck: <?php echo htmlspecialchars($deck->getName()); ?></h1>
    <p>Deck ID: <?php echo $deck->getId(); ?></p>
    <a href="/decks">Terug naar lijst</a>
</body>
</html>
{% endblock %}