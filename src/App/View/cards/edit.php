{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h2 class="card-header">Edit Card {{ id }}</h2>
                <div class="card-body">
                    <form method="POST" action="/cards/{{ id }}">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="attack" class="form-label">Attack:</label>
                            <input type="number" class="form-control" id="attack" name="attack" value="{{ attack }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="defense" class="form-label">Defense:</label>
                            <input type="number" class="form-control" id="defense" name="defense" value="{{ defense }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="rarity" class="form-label">Rarity:</label>
                            <input type="text" class="form-control" id="rarity" name="rarity" value="{{ rarity }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="market_price" class="form-label">Market Price:</label>
                            <input type="number" step="0.01" class="form-control" id="market_price" name="market_price" value="{{ market_price }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}