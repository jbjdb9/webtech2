<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Trading Card Game</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cards">Cards</a>
                </li>
                {% if @@ROLE == Premium or @@ROLE == Admin %}
                    <li class="nav-item">
                        <a class="nav-link" href="/decks">Decks</a>
                    </li>
                {% endif %}
                {% if @@ROLE == Admin %}
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Admin</a>
                    </li>
                {% endif %}
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/profile">{{ @@USERNAME }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/logout">Log out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>