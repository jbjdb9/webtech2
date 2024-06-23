{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h2 class="card-header">{{ name }}</h2>
                <div class="card-body">
                    <p><strong>Attack:</strong> {{ attack }}</p>
                    <p><strong>Defense:</strong> {{ defense }}</p>
                    <p><strong>Rarity:</strong> {{ rarity }}</p>
                    <p><strong>Price:</strong> {{ market_price }}</p>
                    <div class="d-flex justify-content-between">
                        <form method="POST" action="/addCardToDeck" class="w-25">
                            <div class="d-flex justify content-right gap-2">
                                <select id="deckSelect" class="form-control" name="deck_id">
                                    {% for deck in decks %}
                                    <option value="{{ deck.id }}">{{ deck.name }}</option>
                                    {% else %}
                                    <option value="" disabled>No decks found</option>
                                    {% endfor %}
                                </select>
                                <input type="hidden" name="card_id" value="{{ id }}">
                                <button type="submit" class="btn btn-outline-primary text-nowrap">
                                    Add to Deck
                                </button>
                            </div>
                        </form>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="/cards/{{ id }}/edit" class="btn btn-outline-warning">Edit</a>
                            <form method="POST" action="/cards/{{ id }}/delete" onsubmit="return confirm('Are you sure you want to delete this card?');">
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}