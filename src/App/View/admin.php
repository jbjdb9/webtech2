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
        <th scope="col">Roles</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    {% for user in users %}
    <tr>
        <td>{{ user.username }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.role }}</td>
        <td>
            <div class="d-flex justify-content-start gap-2">
                <form method="POST" action="/admin/{{ user.id }}/assign-admin">
                    <input type="hidden" name="id" value="{{ user.id }}">
                    <button type="submit" class="btn btn-outline-primary">Assign Admin</button>
                </form>
                <form method="POST" action="/admin/{{ user.id }}/revoke-admin">
                    <input type="hidden" name="id" value="{{ user.id }}">
                    <button type="submit" class="btn btn-outline-warning">Revoke Admin</button>
                </form>
                <form method="POST" action="/admin/{{ user.id }}/delete" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>
            </div>
        </td>
    </tr>
    {% else %}
    <tr>
        <td colspan="3">No users found</td>
    </tr>
    {% endfor %}
    </tbody>
</table>

{% endblock %}