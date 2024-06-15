{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}
<p>Your current score is: {{ score }}</p>
{% endblock %}