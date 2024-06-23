{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}
<!DOCTYPE html>
<html>
<head>
    <title>Nieuw Deck</title>
</head>
<body>
    <h1>Nieuw Deck maken</h1>
    <form action="/deck/store" method="post">
        <label for="name">Deck Naam:</label>
        <input type="text" id="name" name="name" required>
        <label for="user_id">Gebruiker ID:</label>
        <input type="text" id="user_id" name="user_id" required>
        <button type="submit">Deck Opslaan</button>
    </form>
</body>
</html>
{% endblock %}