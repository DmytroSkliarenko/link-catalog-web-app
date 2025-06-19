<?php
class Link {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    public function getAll() {
        $sql = "SELECT l.*, u.username as author_name 
                FROM links l 
                LEFT JOIN users u ON l.author_id = u.id 
                ORDER BY l.created_at DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM links WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getByTag($tagName) {
        $sql = "SELECT l.*, u.username as author_name 
                FROM links l 
                LEFT JOIN users u ON l.author_id = u.id
                JOIN link_tags lt ON l.id = lt.link_id
                JOIN tags t ON lt.tag_id = t.id
                WHERE t.name = ?
                ORDER BY l.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$tagName]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function create($data) {
        $sql = "INSERT INTO links (url, title, description, author_id) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['url'], 
            $data['title'], 
            $data['description'], 
            $data['author_id']
        ]);
    }
    
    public function update($id, $data) {
        $sql = "UPDATE links SET url = ?, title = ?, description = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['url'], 
            $data['title'], 
            $data['description'], 
            $id
        ]);
    }
    
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM links WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function checkUrlStatus($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return $httpCode >= 200 && $httpCode < 400;
    }
    
    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE links SET status = ?, status_updated_at = NOW() WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
}
?>
