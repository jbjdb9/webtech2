{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<h2>Edit card {{ id }}</h2>

<form method="POST" action="/cards/{{ id }}">
    <input type="hidden" name="_method" value="PUT">
    <label for="name">Name</label>
    <input type="text" name="name" value="{{ name }}">
    <label for="attack">Attack</label>
    <input type="number" name="attack" value="{{ attack }}">
    <label for="defense">Defense</label>
    <input type="number" name="defense" value="{{ defense }}">
    <label for="rarity">Rarity</label>
    <input type="text" name="rarity" value="{{ rarity }}">
    <label for="market_price">Market Price</label>
    <input type="number" name="market_price" value="{{ market_price }}">
    <button type="submit">Save</button>
</form>

{% endblock %}