
<?php

class M_MatatelingaDckbtk extends CI_model
{
    private $table = "mcu_matatelingadckbtk";

    function createRow($Data){
        $matatelingadckbtk = [
                    'mcu_id' => $Data['form_id'],
                    'mata_luar' => $Data['mata_luar'],
                    'ket_mata_luar' => $Data['ket_mata_luar'],
                    'penglihatan' => $Data['penglihatan'],
                    'ket_penglihatan' => $Data['ket_penglihatan'],
                    'kacamata' => $Data['kacamata'],
                    'ket_kacamata' => $Data['ket_kacamata'],
                    'inf_mata' => $Data['inf_mata'],
                    'ket_inf_mata' => $Data['ket_inf_mata'],
                    'ket_masalah_lain_penglihatan' => $Data['ket_masalah_lain_penglihatan'],
                    'telinga' => $Data['telinga'],
                    'ket_telinga' => $Data['ket_telinga'],
                    'kot_telinga' => $Data['kot_telinga'],
                    'ket_kot_telinga' => $Data['ket_kot_telinga'],
                    'inf_telinga' => $Data['inf_telinga'],
                    'ket_inf_telinga' => $Data['ket_inf_telinga'],
                    'tajam_pendengaran' => $Data['tajam_pendengaran'],
                    'ket_tajam_pendengaran' => $Data['ket_tajam_pendengaran'],
                    'ket_masalah_lain_pendengaran' => $Data['ket_masalah_lain_pendengaran'],
        ];
        $result = $this->db->insert($this->table, $matatelingadckbtk);
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
        $matatelingadckbtk = [
                    'mata_luar' => $Data['mata_luar'],
                    'ket_mata_luar' => $Data['ket_mata_luar'],
                    'penglihatan' => $Data['penglihatan'],
                    'ket_penglihatan' => $Data['ket_penglihatan'],
                    'kacamata' => $Data['kacamata'],
                    'ket_kacamata' => $Data['ket_kacamata'],
                    'inf_mata' => $Data['inf_mata'],
                    'ket_inf_mata' => $Data['ket_inf_mata'],
                    'ket_masalah_lain_penglihatan' => $Data['ket_masalah_lain_penglihatan'],
                    'telinga' => $Data['telinga'],
                    'ket_telinga' => $Data['ket_telinga'],
                    'kot_telinga' => $Data['kot_telinga'],
                    'ket_kot_telinga' => $Data['ket_kot_telinga'],
                    'inf_telinga' => $Data['inf_telinga'],
                    'ket_inf_telinga' => $Data['ket_inf_telinga'],
                    'tajam_pendengaran' => $Data['tajam_pendengaran'],
                    'ket_tajam_pendengaran' => $Data['ket_tajam_pendengaran'],
                    'ket_masalah_lain_pendengaran' => $Data['ket_masalah_lain_pendengaran'],
        ];
        $this->db->where("mcu_id", $Data['form_id']);
        $result = $this->db->update($this->table, $matatelingadckbtk);
        return $result;
    }
}