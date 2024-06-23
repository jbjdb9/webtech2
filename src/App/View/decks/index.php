{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<h1>Decks</h1>
<a href="/deck/create">Add new deck</a>
<ul>
    {% for deck in decks %}
        <li>
            {{ deck.name }}
            - <a href="/deck/{{ deck.id }}">View</a>
            - <a href="/deck/{{ deck.id }}/edit">Edit</a>
            - <a href="/deck/{{ deck.id }}/delete" onclick="return confirm('Are you sure you want to delete this deck?');">Delete</a>
        </li>
    {% else %}
        <li>No decks found</li>
    {% endfor %}
</ul>

{% endblock %}