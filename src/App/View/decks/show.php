{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<h1>Deck: <?php echo htmlspecialchars($deck->getName()); ?></h1>
<p>Deck ID: <?php echo $deck->getId(); ?></p>
<a href="/decks">Back to deck list</a>

{% endblock %}