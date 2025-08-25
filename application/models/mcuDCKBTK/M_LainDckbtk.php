
<?php

class M_LainDckbtk extends CI_model
{
    private $table = "mcu_laindckbtk";

    function createRow($Data){
        $laindckbtk = [
            'mcu_id' => $Data['form_id'],
            'mental' => $Data['mental'],
            'saran' => $Data['saran'],
            'kesimpulan' => $Data['kesimpulan'],
            'followup' => $Data['followup'],
        ];
        $result = $this->db->insert($this->table, $laindckbtk);
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
        $laindckbtk = [
                    'mental' => $Data['mental'],
                    'saran' => $Data['saran'],
                    'kesimpulan' => $Data['kesimpulan'],
                    'followup' => $Data['followup'],
        ];
        $this->db->where("mcu_id", $Data['form_id']);
        $result = $this->db->update($this->table, $laindckbtk);
        return $result;
    }
}