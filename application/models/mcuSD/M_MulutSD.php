
<?php

class M_MulutSD extends CI_model
{
    private $table = "mcu_mulut_sd";

    function createRow($Data){
        $umumSD = [
            'mcu_id' => $Data['form_id'],
            'bibir' => $Data['bibir'],
            'sudut_mulut' => $Data['sudut_mulut'],
            'sariawan' => $Data['sariawan'],
            'lidah' => $Data['lidah'],
            'luka_lain' => $Data['luka_lain'],
            'ket_masalah_lain_rongga_mulut' => $Data['ket_masalah_lain_rongga_mulut'],
            'caries' => $Data['caries'],
            'ket_caries' => $Data['ket_caries'],
            'gigi_dep' => $Data['gigi_dep'],
            'ket_masalah_lain_gigi_gusi' => $Data['ket_masalah_lain_gigi_gusi'],
        ];
        $result = $this->db->insert($this->table, $umumSD);
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
        $umumSD = [
            'mcu_id' => $Data['form_id'],
            'bibir' => $Data['bibir'],
            'sudut_mulut' => $Data['sudut_mulut'],
            'sariawan' => $Data['sariawan'],
            'lidah' => $Data['lidah'],
            'luka_lain' => $Data['luka_lain'],
            'ket_masalah_lain_rongga_mulut' => $Data['ket_masalah_lain_rongga_mulut'],
            'caries' => $Data['caries'],
            'ket_caries' => $Data['ket_caries'],
            'gigi_dep' => $Data['gigi_dep'],
            'ket_masalah_lain_gigi_gusi' => $Data['ket_masalah_lain_gigi_gusi'],
        ];
        $this->db->where("mcu_id", $Data['form_id']);
        $result = $this->db->update($this->table, $umumSD);
        return $result;
    }
}