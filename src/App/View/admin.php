{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<p>This is a test</p>

<p>These are your roles: {{ roles }}</p>

{% endblock %}