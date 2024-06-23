{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<h1 class="display-1">Welcome, {{ @@USERNAME }}</h1>

{% if @@ROLE == Admin %}
    <h2>You are an admin.</h2>
{% endif %}
{% endblock %}