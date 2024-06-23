{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<h1>Create New Deck</h1>
<form action="/deck/store" method="post">
    <label for="name">Deck Name:</label>
    <input type="text" id="name" name="name" required>
    <label for="user_id">User ID:</label>
    <input type="text" id="user_id" name="user_id" required>
    <button type="submit">Save Deck</button>
</form>

{% endblock %}