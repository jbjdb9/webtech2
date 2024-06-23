{% extends 'base.php' %}

{% block header %}
{% include 'header.php' %}
{% endblock %}

{% block body %}

<h1 class="display-1">Profile</h1>
<h2>Username: {{ @@USERNAME }}</h2>
<h2>Email: {{ @@EMAIL }}</h2>

<form method="POST" action="/profile/buy-premium" onsubmit="return confirm('Are you sure you want to buy premium? It costs about $3.50');">
    <input type="hidden" name="id" value="{{ @@USERID }}">
    {% ifundefined @@ROLE %}
    <button type="submit" class="btn btn-warning">Buy Premium</button>
    {% endif %}
</form>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Update Profile</div>
                <div class="card-body">
                    <form method="POST" action="/profile/update">
                        <div class="form-group">
                            <label for="username">New Username:</label>
                            <input type="text" id="username" name="username" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">New Email:</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">New Password:</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirm New Password:</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="current_password">Current Password:</label>
                            <input type="password" id="current_password" name="current_password" class="form-control" required>
                        </div>

                        <div class="form-group mt-2">
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </form>
                    {% ifdefined error %}
                    <div class="alert alert-danger mt-4" role="alert">
                    {{ error }}
                    </div>
                    {% endif %}
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}