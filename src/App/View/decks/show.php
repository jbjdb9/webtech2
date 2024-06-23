{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<h1>Deck: {{ name }}</h1>
<p>Deck ID: {{ id }}</p>

<h2>Cards in this deck:</h2>
<div class="row">
    {% for card in cards %}
    <div class="col-md-2 mb-2">
        <div class="card">
            <div class="card-header">
                {{ card.id }}
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    {{ card.name }}
                </h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Attack: {{ card.attack }}</li>
                    <li class="list-group-item">Defense: {{ card.defense }}</li>
                    <li class="list-group-item">Rarity: {{ card.rarity }}</li>
                </ul>
                <a href="/cards/{{ card.id }}" class="btn btn-primary mt-2">View Card</a>
            </div>
        </div>
    </div>
    {% else %}
    <div class="col-12">
        No cards in this deck
    </div>
    {% endfor %}
</div>

{% endblock %}