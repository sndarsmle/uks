
<?php

class M_GiziDckbtk extends CI_model
{
    private $table = "mcu_gizi_dckbtk";

    function createRow($Data){
        $giziDckbtk = [
            'mcu_id' => $Data['form_id'],
            'bb' => $Data['bb'],
            'tb' => $Data['tb'],
            'lk' => $Data['lk'],
            'lla' => $Data['lla'],
            'lp' => $Data['lp'],
            'pimt' => $Data['pimt'],
            'status_gizi' => $Data['status_gizi'],
            'bbperu' => $Data['bbperu'],
            'anemia' => $Data['anemia'],
        ];
        $result = $this->db->insert($this->table, $giziDckbtk);
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
        $giziDckbtk = [
            'bb' => $Data['bb'],
            'tb' => $Data['tb'],
            'lk' => $Data['lk'],
            'lla' => $Data['lla'],
            'lp' => $Data['lp'],
            'pimt' => $Data['pimt'],
            'status_gizi' => $Data['status_gizi'],
            'bbperu' => $Data['bbperu'],
            'anemia' => $Data['anemia'],
        ];
        $this->db->where("mcu_id", $Data['form_id']);
        $result = $this->db->update($this->table, $giziDckbtk);
        return $result;
    }
}