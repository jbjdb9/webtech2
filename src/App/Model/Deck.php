<?php

namespace App\App\Model;

use App\App\Database\Database;
use PDO, PDOException;

Class Deck
{
    public $id;
    public $userId;
    public $name;
    public $cards = [];

    public function __construct($id = null, $userId = null, $name = null, $cards = [])
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->name = $name;
        $this->cards = $cards;
    }


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getCards()
    {
        $stmt = Database::getPdo()->prepare('SELECT card_id FROM deck_cards WHERE deck_id = :deck_id');
        $stmt->execute(['deck_id' => $this->id]);
        $cardIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

        $cards = [];
        foreach ($cardIds as $cardId) {
            $card = Card::getById($cardId);
            if ($card) {
                $cards[] = $card;
            }
        }

        return $cards;
    }

    public function setCards($cards) {
        $this->cards = $cards;
    }

    public function addCard(Card $card)
    {
        // Check if the card is already in the deck
        $stmt = Database::getPdo()->prepare('SELECT * FROM deck_cards WHERE deck_id = :deck_id AND card_id = :card_id');
        $stmt->execute(['deck_id' => $this->id, 'card_id' => $card->getId()]);
        $existingCard = $stmt->fetch(PDO::FETCH_ASSOC);

        // If the card is not in the deck, insert it
        if (!$existingCard) {
            $sql = "INSERT INTO deck_cards (deck_id, card_id) VALUES (?, ?)";
            $stmt = Database::getPdo()->prepare($sql);
            $stmt->execute([$this->id, $card->getId()]);
        }
    }

    public function removeCard(Card $card) {
        $stmt = Database::getPdo()->prepare('DELETE FROM deck_cards WHERE deck_id = :deck_id AND card_id = :card_id');
        $stmt->execute(['deck_id' => $this->id, 'card_id' => $card->getId()]);
    }

    public static function all()
    {
        $stmt = Database::getPdo()->query('SELECT * FROM decks');
        $decks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $decks;
    }
    public static function getAllByUserId($user_id)
    {
        $stmt = Database::getPdo()->prepare('SELECT * FROM decks WHERE user_id = :user_id');
        $stmt->execute(['user_id' => $user_id]);
        $decks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $decks;
    }

    public static function getById($id)
    {
        $stmt = Database::getPdo()->prepare('SELECT * FROM decks WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $deckData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($deckData) {
            $deck = new Deck();
            $deck->id = $deckData['id'];
            $deck->userId = $deckData['user_id'];
            $deck->name = $deckData['name'];
            // Load the cards that belong to this deck
            $deck->loadCards();

            return $deck;
        }

        return null;
    }

    private function loadCards()
    {
        $stmt = Database::getPdo()->prepare('SELECT card_id FROM deck_cards WHERE deck_id = :deck_id');
        $stmt->execute(['deck_id' => $this->id]);
        $cardIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

        foreach ($cardIds as $cardId) {
            $card = Card::getById($cardId);
            if ($card) {
                $this->addCard($card);
            }
        }
    }

    public function create()
    {
        try {
            $pdo = Database::getPdo();
            $stmt = $pdo->prepare('INSERT INTO decks (user_id, name) VALUES (:user_id, :name)');
            $stmt->execute([
                'user_id' => $this->userId,
                'name' => $this->name
            ]);
            $this->id = $pdo->lastInsertId();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function update()
    {
        try {
            $stmt = Database::getPdo()->prepare('UPDATE decks SET name = :name WHERE id = :id');
            $stmt->execute([
                'name' => $this->name,
                'id' => $this->id
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete()
    {
        try {
            $pdo = Database::getPdo();
            $pdo->beginTransaction();

            $stmt = $pdo->prepare('DELETE FROM deck_cards WHERE deck_id = :deck_id');
            $stmt->execute(['deck_id' => $this->id]);

            $stmt = $pdo->prepare('DELETE FROM decks WHERE id = :id');
            $stmt->execute(['id' => $this->id]);

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo $e->getMessage();
            return false;
        }
    }
}
