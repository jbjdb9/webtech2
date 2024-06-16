{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<h1>Username: {{ username }}</h1>
<p>Email: {{ email }}</p>

{% endblock %}