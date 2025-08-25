
<?php

class M_LainSD extends CI_model
{
    private $table = "mcu_lainsd";

    function createRow($Data){
        $lainsd = [
            'mcu_id' => $Data['form_id'],
            'mental' => $Data['mental'],
            'saran' => $Data['saran'],
            'kesimpulan' => $Data['kesimpulan'],
            'followup' => $Data['followup'],
        ];
        $result = $this->db->insert($this->table, $lainsd);
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
        $lainsd = [
                    'mental' => $Data['mental'],
                    'saran' => $Data['saran'],
                    'kesimpulan' => $Data['kesimpulan'],
                    'followup' => $Data['followup'],
        ];
        $this->db->where("mcu_id", $Data['form_id']);
        $result = $this->db->update($this->table, $lainsd);
        return $result;
    }
}