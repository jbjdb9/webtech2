{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<body>
    <h1>Add New Card</h1>
    <form method="POST" action="/cards/create">
        <label>Name: <input type="text" name="name"></label>
        <label>Attack: <input type="number" name="attack"></label>
        <label>Defense: <input type="number" name="defense"></label>
        <label>Rarity: <input type="text" name="rarity"></label>
        <label>Price: <input type="number" step="0.01" name="price"></label>
        <button type="submit">Add Card</button>
    </form>
</body>

{% endblock %}