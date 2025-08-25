<?php

class M_Divisi extends CI_model
{

    function showAll(){
        //$this->db->select("divisi_id, divisi_nama");
        //$this->db->from("divisi");
        //$this->db->order_by("divisi_nama", "ASC");
        //return $this->db->get()->result();
    }

    function findById($divisiID){
        $this->db->select("divisi_id, divisi_nama");
        $this->db->from("divisi");
        $this->db->where("divisi_id", $divisiID);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0];
        }
        return $result;
    }
}