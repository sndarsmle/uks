
<?php

class M_VitalSMP extends CI_model
{
    private $table = "mcu_vitalsmp";

    function createRow($Data){
        $vitalSMP = [
            'mcu_id' => $Data['form_id'],
            'vital_tekananDarahmm' => $Data['form_tekananDarahmm'],
            'vital_tekananDarahhg' => $Data['form_tekananDarahhg'],
            'vital_nadi' => $Data['form_nadi'],
            'vital_freqNafas' => $Data['form_freqNafas'],
            'vital_suhu' => $Data['form_suhu'],
            'vital_bisingJantung' => $Data['form_bisingJantung'],
            'vital_bisingParu' => $Data['form_bisingParu'],
        ];
        $result = $this->db->insert($this->table, $vitalSMP);
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
        $vitalSMP = [
            'vital_tekananDarahmm' => $Data['form_tekananDarahmm'],
            'vital_tekananDarahhg' => $Data['form_tekananDarahhg'],
            'vital_nadi' => $Data['form_nadi'],
            'vital_freqNafas' => $Data['form_freqNafas'],
            'vital_suhu' => $Data['form_suhu'],
            'vital_bisingJantung' => $Data['form_bisingJantung'],
            'vital_bisingParu' => $Data['form_bisingParu'],
        ];
        $this->db->where("mcu_id", $Data['form_id']);
        $result = $this->db->update($this->table, $vitalSMP);
        return $result;
    }
}