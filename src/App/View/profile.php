{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<h1>Username: {{ @@USERNAME }}</h1>
<p>Email: {{ email }}</p>

{% endblock %}