
<?php

class M_MatatelingaSMP extends CI_model
{
    private $table = "mcu_matatelingasmp";

    function createRow($Data){
        $bersihSMP = [
                    'mcu_id' => $Data['form_id'],
                    'mata_luar' => $Data['mata_luar'],
                    'penglihatan' => $Data['penglihatan'],
                    'ket_penglihatan' => $Data['ket_penglihatan'],
                    'buta_warna' => $Data['buta_warna'],
                    'inf_mata' => $Data['inf_mata'],
                    'telinga' => $Data['telinga'],
                    'kot_telinga' => $Data['kot_telinga'],
                    'inf_telinga' => $Data['inf_telinga'],
                    'ket_masalah_lain_pendengaran' => $Data['ket_masalah_lain_pendengaran'],
        ];
        $result = $this->db->insert($this->table, $bersihSMP);
        return $result;
    }

    function findByParentId($mcuID){
        return $this->db->select("*")
                ->from($this->table)
                ->where("mcu_id", $mcuID)
                ->get()
                ->row_object();
    }

    function updateRow($Data){
        $bersihSMP = [
                    'mata_luar' => $Data['mata_luar'],
                    'penglihatan' => $Data['penglihatan'],
                    'ket_penglihatan' => $Data['ket_penglihatan'],
                    'buta_warna' => $Data['buta_warna'],
                    'inf_mata' => $Data['inf_mata'],
                    'telinga' => $Data['telinga'],
                    'kot_telinga' => $Data['kot_telinga'],
                    'inf_telinga' => $Data['inf_telinga'],
                    'ket_masalah_lain_pendengaran' => $Data['ket_masalah_lain_pendengaran'],
        ];
        $this->db->where("mcu_id", $Data['form_id']);
        $result = $this->db->update($this->table, $bersihSMP);
        return $result;
    }
}