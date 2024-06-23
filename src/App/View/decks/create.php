{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<h1>Create New Deck</h1>
<form action="/decks/create" method="POST" class="mt-4">
    <div class="mb-3">
        <label for="name" class="form-label">Deck Name:</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Save Deck</button>
</form>
{% endblock %}