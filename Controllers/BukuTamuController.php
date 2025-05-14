<?php
require_once __DIR__ . '/../Configs/database.php';
require_once __DIR__ . '/../Models/BukuTamu.php';

class BukuTamuController
{
    private $bukuTamuModel;
    private $msg = '';
    private $msgTimestamp;

    public function __construct($conn)
    {
        $this->bukuTamuModel = new BukuTamu($conn);
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

    private function sanitizeInput($data)
    {
        $sanitized = [];
        foreach ($data as $key => $value) {
            $sanitized[$key] = strip_tags(trim($value));
        }
        return $sanitized;
    }

    public function createTamu($nama, $instansi, $tujuan)
    {
        $data = $this->sanitizeInput([
            'nama' => $nama,
            'instansi' => $instansi,
            'tujuan' => $tujuan
        ]);

        if (empty($data['nama']) || empty($data['instansi']) || empty($data['tujuan'])) {
            $this->setMessage("Semua field wajib diisi.");
            return false;
        }

        $tanggal = date('Y-m-d');
        $waktu = date('H:i:s');

        if ($this->bukuTamuModel->create($data['nama'], $data['instansi'], $data['tujuan'], $tanggal, $waktu)) {
            $this->setMessage("Data tamu berhasil disimpan!");
            return true;
        }
        $this->setMessage("Gagal menyimpan data tamu.");
        return false;
    }

    public function getAllTamu($search = null)
    {
        return $this->bukuTamuModel->getAll($search);
    }

    public function deleteTamu($id)
    {
        $id = intval($id);
        if ($this->bukuTamuModel->delete($id)) {
            $this->setMessage("Data tamu berhasil dihapus!");
            return true;
        }
        $this->setMessage("Gagal menghapus data tamu.");
        return false;
    }
} 