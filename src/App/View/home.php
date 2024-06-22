{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}
<p>Your current score is: {{ score }}</p>

<p>Role: {{ role }}</p>

{% if role == Admin %}
    <p>You are an admin.</p>
{% endif %}
{% endblock %}