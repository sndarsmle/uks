
<?php

class M_MulutSMP extends CI_model
{
    private $table = "mcu_mulutsmp";

    function createRow($Data){
        $mulutSMP = [
            'mcu_id' => $Data['form_id'],
            'bibir' => $Data['bibir'],
            'sudut_mulut' => $Data['sudut_mulut'],
            'sariawan' => $Data['sariawan'],
            'lidah' => $Data['lidah'],
            'luka_lain' => $Data['luka_lain'],
            'ket_masalah_lain_rongga_mulut' => $Data['ket_masalah_lain_rongga_mulut'],
        ];
        $result = $this->db->insert($this->table, $mulutSMP);
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
        $mulutSMP = [
            'bibir' => $Data['bibir'],
            'sudut_mulut' => $Data['sudut_mulut'],
            'sariawan' => $Data['sariawan'],
            'lidah' => $Data['lidah'],
            'luka_lain' => $Data['luka_lain'],
            'ket_masalah_lain_rongga_mulut' => $Data['ket_masalah_lain_rongga_mulut'],
        ];
        $this->db->where("mcu_id", $Data['form_id']);
        $result = $this->db->update($this->table, $mulutSMP);
        return $result;
    }
}