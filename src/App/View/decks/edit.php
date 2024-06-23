{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<h1 class="mb-4">Rename Deck: {{ name }}</h1>
<form action="/deck/{{ id }}/update" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Deck Name:</label>
        <input type="text" id="name" name="name" value="{{ name }}" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
</form>

{% endblock %}