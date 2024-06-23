{% extends 'base.php' %}

{% block body %}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form action="/login" method="post">
                        <div class="form-group">
                            <label for="usernameOrEmail">Username or Email:</label>
                            <input type="text" id="usernameOrEmail" name="usernameOrEmail" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group mt-2 d-flex justify-content-between align-items-center">
                            <input type="submit" value="Login" class="btn btn-primary">
                            <a href="/register" class="btn btn-link">Register account instead</a>
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