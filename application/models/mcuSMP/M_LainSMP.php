
<?php

class M_LainSMP extends CI_model
{
    private $table = "mcu_lainsmp";

    function createRow($Data){
        $bersihSMP = [
            'mcu_id' => $Data['form_id'],
            'mental' => $Data['mental'],
            'saran' => $Data['saran'],
            'kesimpulan' => $Data['kesimpulan'],
            'followup' => $Data['followup'],
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
                    'mental' => $Data['mental'],
                    'saran' => $Data['saran'],
                    'kesimpulan' => $Data['kesimpulan'],
                    'followup' => $Data['followup'],
        ];
        $this->db->where("mcu_id", $Data['form_id']);
        $result = $this->db->update($this->table, $bersihSMP);
        return $result;
    }
}