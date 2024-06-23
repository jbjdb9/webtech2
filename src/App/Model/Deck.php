<?php

namespace App\App\Model;

use App\App\Database\ORM;
use PDO, PDOException;

Class deck
{
    public $id;
    public $userId;
    public $name;
    public $cards = [];

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

    public function getCards() {
        return $this->cards;
    }

    public function setCards($cards) {
        $this->cards = $cards;
    }

    public function __construct($id = null, $userId = null, $name = null, $cards = [])
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->name = $name;
        $this->cards = $cards;
    }

    public function addCard(Card $card) {
        $this->cards[] = $card;
    }

    public function removeCard(Card $card) {
        $key = array_search($card, $this->cards);
        if ($key !== false) {
            unset($this->cards[$key]);
        }
    }

    public static function all()
    {
        $stmt = ORM::getPdo()->query('SELECT * FROM decks');
        $decks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $decks;
    }

    public function loadById($id)
    {
        $stmt = ORM::getPdo()->prepare('SELECT * FROM decks WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $deck = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($deck) {
            $this->id = $deck['id'];
            $this->userId = $deck['user_id'];
            $this->name = $deck['name'];
            // Laad de kaarten die bij dit deck horen
            $this->loadCards();
        }

    }

    private function loadCards()
    {
        $stmt = ORM::getPdo()->prepare('SELECT card_id FROM deck_cards WHERE deck_id = :deck_id');
        $stmt->execute(['deck_id' => $this->id]);
        $cardIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

        foreach ($cardIds as $cardId) {
            $card = Card::find($cardId);
            if ($card) {
                $this->addCard($card);
            }
        }
    }

    public function save()
    {
        try {
            $pdo = ORM::getPdo();
            $pdo->beginTransaction();

            if ($this->id) {
                $stmt = $pdo->prepare('UPDATE decks SET user_id = :user_id, name = :name WHERE id = :id');
                $stmt->execute([
                    'id' => $this->id,
                    'user_id' => $this->userId,
                    'name' => $this->name
                ]);
            } else {
                $stmt = $pdo->prepare('INSERT INTO decks (user_id, name) VALUES (:user_id, :name)');
                $stmt->execute([
                    'user_id' => $this->userId,
                    'name' => $this->name
                ]);
                $this->id = $pdo->lastInsertId();
            }

            // Verwijder alle kaarten die bij dit deck horen
            $stmt = $pdo->prepare('DELETE FROM deck_cards WHERE deck_id = :deck_id');
            $stmt->execute(['deck_id' => $this->id]);

            // Voeg de kaarten die bij dit deck horen opnieuw toe
            $stmt = $pdo->prepare('INSERT INTO deck_cards (deck_id, card_id) VALUES (:deck_id, :card_id)');
            foreach ($this->cards as $card) {
                $stmt->execute([
                    'deck_id' => $this->id,
                    'card_id' => $card->getId()
                ]);
            }

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function delete()
    {
        try {
            $pdo = ORM::getPdo();
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
