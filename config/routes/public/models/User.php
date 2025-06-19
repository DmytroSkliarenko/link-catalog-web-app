<?php
class User {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    public function authenticate($username, $password) {
        $stmt = $this->db->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
    
    public function create($username, $password, $email = null) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $hashedPassword, $email]);
    }
}
?>
