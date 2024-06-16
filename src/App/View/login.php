<form action="/login" method="post">
    <label for="usernameOrEmail">Username or Email:</label>
    <input type="text" id="usernameOrEmail" name="usernameOrEmail" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <input type="submit" value="Login">
</form>

<p>{{ error }}</p>