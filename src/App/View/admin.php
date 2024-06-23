{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<p>This is a test</p>

<p>These are your roles: {{ @@ROLE }}</p>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
<!--        <th scope="col">Roles</th>-->
    </tr>
    </thead>
    <tbody>
    {% for user in users %}
    <tr>
        <td>{{ user.username }}</td>
        <td>{{ user.email }}</td>
<!--        <td>{{ user.role }}</td>-->
    </tr>
    {% else %}
    <tr>
        <td colspan="3">No users found</td>
    </tr>
    {% endfor %}
    </tbody>
</table>

{% endblock %}