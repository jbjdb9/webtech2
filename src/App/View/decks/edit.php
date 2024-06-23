{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<h1>Edit Deck: {{ name }}</h1>
<form action="/deck/update/{{ id }}" method="post">
    <label for="name">Deck Name:</label>
    <input type="text" id="name" name="name" value="{{ name }}" required>
    <label for="user_id">User ID:</label>
    <input type="text" id="user_id" name="user_id" value="{{ @@USERID }}" required>
    <button type="submit">Save Changes</button>
</form>

{% endblock %}