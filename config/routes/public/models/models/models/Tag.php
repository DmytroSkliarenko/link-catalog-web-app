<?php
class Tag {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    public function getAll() {
        return $this->db->query("SELECT * FROM tags ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function create($name) {
        $stmt = $this->db->prepare("INSERT IGNORE INTO tags (name) VALUES (?)");
        return $stmt->execute([$name]);
    }
    
    public function getOrCreate($name) {
        $this->create($name);
        $stmt = $this->db->prepare("SELECT id FROM tags WHERE name = ?");
        $stmt->execute([$name]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
