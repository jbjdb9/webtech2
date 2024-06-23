<?php

try {
    // Connect to the SQLite database
    $pdo = new PDO('sqlite:database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the users table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY,
            username TEXT NOT NULL,
            email TEXT NOT NULL,
            password TEXT NOT NULL
        )
    ");

    // Create the roles table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS roles (
            id INTEGER PRIMARY KEY,
            name TEXT NOT NULL
        )
    ");

    // Create the user_roles table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS user_roles (
            user_id INTEGER NOT NULL,
            role_id INTEGER NOT NULL,
            FOREIGN KEY(user_id) REFERENCES users(id),
            FOREIGN KEY(role_id) REFERENCES roles(id)
        )
    ");

    // Create the cards table
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS cards (
        id INTEGER PRIMARY KEY,
        name TEXT NOT NULL,
        attack INTEGER NOT NULL,
        defense INTEGER NOT NULL,
        rarity TEXT NOT NULL,
        price REAL NOT NULL,
        set_id INTEGER
    )
    ");

    $pdo->exec("
    CREATE TABLE IF NOT EXISTS decks (
        id INTEGER PRIMARY KEY,
        user_id INTEGER NOT NULL,
        name TEXT NOT NULL,
        FOREIGN KEY(user_id) REFERENCES users(id)
    )
    ");

    $pdo->exec("
    CREATE TABLE IF NOT EXISTS deck_cards (
        deck_id INTEGER NOT NULL,
        card_id INTEGER NOT NULL,
        FOREIGN KEY(deck_id) REFERENCES decks(id),
        FOREIGN KEY(card_id) REFERENCES cards(id)
    )
    ");



    echo "Database tables created successfully.\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}