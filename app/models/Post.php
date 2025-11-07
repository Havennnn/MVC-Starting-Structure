<?php
namespace App\Models;

use Core\Model;

class Post extends Model
{
    public function create(string $title, string $body): bool
    {
        $sql = "INSERT INTO posts (title, body) VALUES (:title, :body)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'title' => $title,
            'body'  => $body
        ]);
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM posts ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}
