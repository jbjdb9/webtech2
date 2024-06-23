{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h2 class="card-header">Add New Card</h2>
                <div class="card-body">
                    <form method="POST" action="/cards/create">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="attack" class="form-label">Attack:</label>
                            <input type="number" class="form-control" id="attack" name="attack" required>
                        </div>
                        <div class="mb-3">
                            <label for="defense" class="form-label">Defense:</label>
                            <input type="number" class="form-control" id="defense" name="defense" required>
                        </div>
                        <div class="mb-3">
                            <label for="rarity" class="form-label">Rarity:</label>
                            <input type="text" class="form-control" id="rarity" name="rarity" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price:</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Card</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}