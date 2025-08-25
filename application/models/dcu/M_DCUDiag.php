<?php

class M_DCUDiag extends CI_model
{
    private $table = "dcu_diagnosis";

    function createRow($Data, $dcuID){
        $DCU = [
            'dcu_id' => $dcuID,
            'dcuDiag_number' => $Data['form_gigi'],
            'dcuDiag_diag' => $Data['form_diag'],
            'dcuDiag_ket' => $Data['form_ket'],
        ];
        $result = $this->db->insert($this->table, $DCU);
        return $result;
    }

    function showByParentId($dcuID){
        $this->db->select("*")
                ->from($this->table)
                ->where("dcu_id", $dcuID);
        return $this->db->get()->result();
    }

    function deleteRow($rowID)
    {
        $this->db->where('dcuDiag_id', $rowID);
        return $this->db->delete($this->table);
    }
    function listOptionDiagnose()
    {
        $this->db->select("*")
                ->from('diagnose_gigi');                
        return $this->db->get()->result();
    }
}