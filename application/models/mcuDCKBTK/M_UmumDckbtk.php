
<?php

class M_UmumDckbtk extends CI_model
{
    private $table = "mcu_umum_dckbtk";

    function createRow($Data){
        $umumdckbtk = [
            'mcu_id' => $Data['form_id'],
            'mata' => $Data['mata'],
            'ket_mata' => $Data['ket_mata'],
            'hidung' => $Data['hidung'],
            'ket_hidung' => $Data['ket_hidung'],
            'rongga_mulut' => $Data['rongga_mulut'],
            'ket_rongga_mulut' => $Data['ket_rongga_mulut'],
            'jantung' => $Data['jantung'],
            'ket_jantung' => $Data['ket_jantung'],
            'paru' => $Data['paru'],
            'ket_paru' => $Data['ket_paru'],
            'neurologi' => $Data['neurologi'],
            'rambut' => $Data['rambut'],
            'ket_rambut' => $Data['ket_rambut'],
            'kulit' => $Data['kulit'],
            'ket_kulit' => $Data['ket_kulit'],
            'kuku' => $Data['kuku'],
            'ket_kuku' => $Data['ket_kuku'],
        ];
        $result = $this->db->insert($this->table, $umumdckbtk);
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
        $umumdckbtk = [
            'mata' => $Data['mata'],
            'ket_mata' => $Data['ket_mata'],
            'hidung' => $Data['hidung'],
            'ket_hidung' => $Data['ket_hidung'],
            'rongga_mulut' => $Data['rongga_mulut'],
            'ket_rongga_mulut' => $Data['ket_rongga_mulut'],
            'jantung' => $Data['jantung'],
            'ket_jantung' => $Data['ket_jantung'],
            'paru' => $Data['paru'],
            'ket_paru' => $Data['ket_paru'],
            'neurologi' => $Data['neurologi'],
            'rambut' => $Data['rambut'],
            'ket_rambut' => $Data['ket_rambut'],
            'kulit' => $Data['kulit'],
            'ket_kulit' => $Data['ket_kulit'],
            'kuku' => $Data['kuku'],
            'ket_kuku' => $Data['ket_kuku'],
        ];
        $this->db->where("mcu_id", $Data['form_id']);
        $result = $this->db->update($this->table, $umumdckbtk);
        return $result;
    }
}