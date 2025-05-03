<?php

class Task {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($title, $description) {
        $stmt = $this->conn->prepare("INSERT INTO tasks (title, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $description);
        
        $success = $stmt->execute();
        $stmt->close();
        
        return $success;
    }

    public function update($id, $title, $description, $status) {
        $stmt = $this->conn->prepare("UPDATE tasks SET title = ?, description = ?, status = ? WHERE id = ?");
        $stmt->bind_param("sssi", $title, $description, $status, $id);
        
        $success = $stmt->execute();
        $stmt->close();
        
        return $success;
    }

    public function delete($id) {
        $checkStmt = $this->conn->prepare("SELECT id FROM tasks WHERE id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
        
        if ($result->num_rows === 0) {
            $checkStmt->close();
            return false;
        }
        $checkStmt->close();

        $stmt = $this->conn->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        $success = $stmt->execute();
        $affected = $stmt->affected_rows;
        $stmt->close();
        
        return $success && $affected > 0;
    }

    public function getAll() {
        return $this->conn->query("SELECT * FROM tasks ORDER BY created_at DESC");
    }

    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $task = $result->fetch_assoc();
        
        $stmt->close();
        return $task;
    }
} 