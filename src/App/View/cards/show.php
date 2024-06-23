{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<h1>{{ name }}</h1>
<p>Attack: {{ attack }}</p>
<p>Defense: {{ defense }}</p>
<p>Rarity: {{ rarity }}</p>
<p>Price: {{ market_price }}</p>
<a href="/cards/{{ id }}/edit">Edit</a>
<form method="POST" action="/cards/{{ id }}/delete">
    <button type="submit">Delete</button>
</form>

{% endblock %}