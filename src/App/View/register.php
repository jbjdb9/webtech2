{% extends 'base.php' %}

{% block body %}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form action="/register" method="post">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                        </div>
                        <div class="form-group mt-2 d-flex justify-content-between align-items-center">
                            <input type="submit" value="Register" class="btn btn-primary">
                            <a href="/login" class="btn btn-link">Log in instead</a>
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