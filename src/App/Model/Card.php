<?php

namespace App\App\Model;

use App\App\Database\ORM;
use PDO;

class Card
{
    protected $id;
    protected $name;
    protected $attack;
    protected $defense;
    protected $rarity;
    protected $price;
    protected $set_id;

    public function __construct($name = '', $attack = 0, $defense = 0, $rarity = '', $price = 0.0, $set_id = null)
    {
        $this->name = $name;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->rarity = $rarity;
        $this->price = $price;
        $this->set_id = $set_id;
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

    public function getAttack() {
        return $this->attack;
    }

    public function setAttack($attack) {
        $this->attack = $attack;
    }

    public function getDefense() {
        return $this->defense;
    }

    public function setDefense($defense) {
        $this->defense = $defense;
    }

    public function getRarity() {
        return $this->rarity;
    }

    public function setRarity($rarity) {
        $this->rarity = $rarity;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getSetId() {
        return $this->set_id;
    }

    public function setSetId($set_id) {
        $this->set_id = $set_id;
    }

    public static function find($id) {
        $stmt = ORM::getPdo()->prepare('SELECT * FROM cards WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        $card = new Card();
        $card->setId($row['id']);
        $card->setName($row['name']);
        $card->setAttack($row['attack']);
        $card->setDefense($row['defense']);
        $card->setRarity($row['rarity']);
        $card->setPrice($row['price']);
        $card->setSetId($row['set_id']);

        return $card;
    }

    public static function all() {
        $pdo = ORM::getPdo();

        $stmt = $pdo->query('SELECT * FROM cards');
        $cards = [];

        while ($row = $stmt->fetch()) {
            $card = new Card();
            $card->setId($row['id']);
            $card->setName($row['name']);
            $card->setAttack($row['attack']);
            $card->setDefense($row['defense']);
            $card->setRarity($row['rarity']);
            $card->setPrice($row['price']);
            $card->setSetId($row['set_id']);
            $cards[] = $card;
        }

        return $cards;
    }

    public function save() {
        $pdo = ORM::getPdo();

        if ($this->id) {
            $stmt = $pdo->prepare('UPDATE cards SET name = :name, attack = :attack, defense = :defense, rarity = :rarity, price = :price, set_id = :set_id WHERE id = :id');
            $stmt->execute([
                'name' => $this->name,
                'attack' => $this->attack,
                'defense' => $this->defense,
                'rarity' => $this->rarity,
                'price' => $this->price,
                'set_id' => $this->set_id,
                'id' => $this->id
            ]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO cards (name, attack, defense, rarity, price, set_id) VALUES (:name, :attack, :defense, :rarity, :price, :set_id)');
            $stmt->execute([
                'name' => $this->name,
                'attack' => $this->attack,
                'defense' => $this->defense,
                'rarity' => $this->rarity,
                'price' => $this->price,
                'set_id' => $this->set_id
            ]);

            $this->id = $pdo->lastInsertId();
        }

        return true;
    }

    public function delete() {
        $pdo = ORM::getPdo();

        $stmt = $pdo->prepare('DELETE FROM cards WHERE id = :id');
        $stmt->execute(['id' => $this->id]);

        return true;
    }
}

