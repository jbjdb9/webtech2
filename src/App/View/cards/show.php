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
                    <div class="d-flex justify-content-start gap-2">
                        <a href="/cards/{{ id }}/edit" class="btn btn-primary mr-2">Edit</a>
                        <form method="POST" action="/cards/{{ id }}/delete" onsubmit="return confirm('Are you sure you want to delete this card?');">
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}