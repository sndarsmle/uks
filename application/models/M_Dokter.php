<?php

class M_Dokter extends CI_model
{
    private $table = "dokter";

    function findById($dokterID){
         $this->db->select('dokter_fullname, dokter_signature')
            ->from($this->table)
            ->where('dokter_id',$dokterID);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0];
        }
        return $result;
    }
}
?>