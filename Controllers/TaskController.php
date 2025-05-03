<?php
require_once __DIR__ . '/../Configs/database.php';
require_once __DIR__ . '/../Models/Task.php';

class TaskController
{
    private $taskModel;
    private $msg = '';
    private $msgTimestamp;

    public function __construct($conn)
    {
        $this->taskModel = new Task($conn);
        $this->msgTimestamp = 0;
    }

    public function getMessage()
    {
        if ($this->msgTimestamp > 0 && (time() - $this->msgTimestamp) >= 3) {
            $this->resetMessage();
        }
        return $this->msg;
    }

    public function resetMessage()
    {
        $this->msg = '';
        $this->msgTimestamp = 0;
    }

    private function setMessage($message)
    {
        $this->msg = $message;
        $this->msgTimestamp = time();
    }

    private function validateTaskInput($data) 
    {
        $errors = [];
        
        if (empty(trim($data['title']))) {
            $errors[] = "Judul task tidak boleh kosong.";
        }
        
        if (empty(trim($data['description']))) {
            $errors[] = "Deskripsi task tidak boleh kosong.";
        }
        
        if (isset($data['status'])) {
            $valid_status = ['pending', 'completed'];
            if (!in_array($data['status'], $valid_status)) {
                $errors[] = "Status task tidak valid.";
            }
        }
        
        return $errors;
    }

    private function sanitizeInput($data) 
    {
        $sanitized = [];
        foreach ($data as $key => $value) {
            $sanitized[$key] = strip_tags(trim($value));
        }
        return $sanitized;
    }

    public function createTask($title, $description)
    {
        $data = $this->sanitizeInput([
            'title' => $title,
            'description' => $description
        ]);

        $errors = $this->validateTaskInput($data);
        
        if (!empty($errors)) {
            $this->setMessage("Error: " . implode(" ", $errors));
            return false;
        }

        if ($this->taskModel->create($data['title'], $data['description'])) {
            $this->setMessage("Task created successfully!");
            return true;
        }
        
        $this->setMessage("Error: Failed to create task.");
        return false;
    }

    public function updateTask($id, $title, $description, $status)
    {
        if (!is_numeric($id)) {
            $this->setMessage("Error: Invalid task ID");
            return false;
        }

        $data = $this->sanitizeInput([
            'title' => $title,
            'description' => $description,
            'status' => $status
        ]);

        $errors = $this->validateTaskInput($data);
        
        if (!empty($errors)) {
            $this->setMessage("Error: " . implode(" ", $errors));
            return false;
        }

        if ($this->taskModel->update($id, $data['title'], $data['description'], $data['status'])) {
            $this->setMessage("Task updated successfully!");
            return true;
        }
        
        $this->setMessage("Error: Failed to update task.");
        return false;
    }

    public function deleteTask($id)
    {
        if (!is_numeric($id)) {
            $this->setMessage("Error: Invalid task ID");
            return false;
        }

        if ($this->taskModel->delete($id)) {
            $this->setMessage("Task deleted successfully!");
            return true;
        }
        
        $this->setMessage("Error: Failed to delete task.");
        return false;
    }

    public function getAllTasks()
    {
        return $this->taskModel->getAll();
    }
}
?>