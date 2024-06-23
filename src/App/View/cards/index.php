{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<div class="container">
    <h1>Cards</h1>
    <a href="/cards/create" class="btn btn-primary mb-3">Add New Card</a>
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
            No cards found
        </div>
        {% endfor %}
    </div>
</div>

{% endblock %}