<?php

class BukuTamu {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($nama, $instansi, $tujuan, $tanggal, $waktu) {
        $stmt = $this->conn->prepare("INSERT INTO buku_tamu (nama, instansi, tujuan, tanggal, waktu) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nama, $instansi, $tujuan, $tanggal, $waktu);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function getAll($search = null) {
        $sql = "SELECT * FROM buku_tamu";
        if ($search) {
            $sql .= " WHERE nama LIKE ? OR instansi LIKE ? ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $like = "%$search%";
            $stmt->bind_param("ss", $like, $like);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result;
        } else {
            $sql .= " ORDER BY id DESC";
            return $this->conn->query($sql);
        }
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM buku_tamu WHERE id = ?");
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function update($id, $nama, $instansi, $tujuan) {
        $stmt = $this->conn->prepare("UPDATE buku_tamu SET nama = ?, instansi = ?, tujuan = ? WHERE id = ?");
        $stmt->bind_param("sssi", $nama, $instansi, $tujuan, $id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
} 