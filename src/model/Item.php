<?php
class Item {
    protected $id;
    protected $name;
    protected $description;
    protected $type;
    protected $effect;
    protected $image;
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function getEffect() {
        return $this->effect;
    }

    public function setEffect($effect) {
        $this->effect = $effect;
        return $this;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    public function save() {
        $stmt = $this->db->prepare("INSERT INTO items (name, description, type, effect, image) VALUES (:name, :description, :type, :effect, :image)");
        $stmt->bindValue(':name', $this->getName());
        $stmt->bindValue(':description', $this->getDescription());
        $stmt->bindValue(':type', $this->getType());
        $stmt->bindValue(':effect', $this->getEffect());
        $stmt->bindValue(':image', $this->getImage());
        return $stmt->execute();
    }

    public static function delete($db, $id): bool {
        try {
            $stmt = $db->prepare("DELETE FROM items WHERE id = :id");
            $stmt->bindValue(":id", $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al borrar el ítem: " . $e->getMessage());
        }
    }
}
?>