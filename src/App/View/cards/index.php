{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<h1>Cards</h1>
    <a href="/cards/create">Add New Card</a>
    <ul>
        {% for card in cards %}
            <li>
                <a href="/cards/{{ card.id }}">
                    {{ card.name }}
                </a>
            </li>
        {% else %}
            No cards found
        {% endfor %}
    </ul>

{% endblock %}