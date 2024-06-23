{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<h1>Deck: {{ name }}</h1>
<p>Deck ID: {{ id }}</p>

{% endblock %}