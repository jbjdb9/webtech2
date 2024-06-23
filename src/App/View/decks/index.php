{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<div class="container">
    <h1 class="display-1">Decks</h1>
    <a href="/decks/create" class="btn btn-primary mb-3">Add new deck</a>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Deck Name</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            {% for deck in decks %}
            <tr>
                <td>{{ deck.name }}</td>
                <td>
                    <a href="/deck/{{ deck.id }}" class="btn btn-info">View</a>
                    <a href="/deck/{{ deck.id }}/edit" class="btn btn-warning">Rename</a>
                    <a href="/deck/{{ deck.id }}/delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this deck?');">Delete</a>
                </td>
            </tr>
            {% else %}
            <tr>
                <td colspan="2">No decks found</td>
            </tr>
            {% endfor %}
            </tbody>
        </table>
    </div>
</div>

{% endblock %}