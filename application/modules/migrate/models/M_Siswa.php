<?php

class M_Siswa extends CI_Model
{
    private $table = "siswa";

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up($number = 0)
    {
        switch ($number) {
            case 1:
                $this->case_001();
                break;
            default:
                echo "Migration not found!<br>";
        }
    }

    private function case_001()
    {
        if (!$this->db->field_exists('siswa_updated_at', $this->table)) {
            $fields = [
                'siswa_updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
            ];
            $this->dbforge->add_column($this->table, $fields);
            echo "Migrate table {$this->table} success!<br>";
            die();
        }
        echo "Migrate table {$this->table} failed!<br>";
    }
}