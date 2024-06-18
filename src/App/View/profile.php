{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<div class="container mt-5">
    <div class="card" style="width: 18rem;">
        <div class="card-header">
            Profile Information
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ username }}</h5>
            <p class="card-text">Email: {{ email }}</p>
        </div>
    </div>
</div>

{% endblock %}