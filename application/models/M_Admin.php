<?php

class M_Admin extends CI_model
{

    function getAll(){
        $this->db->select("*");
        $this->db->from("user");
        $this->db->order_by("user_id", "ASC");
        return $this->db->get()->result();
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

    function insert($isi)
    {
        $this->db->insert('user',$isi);
    }

    // function aktivasiSingle($user_id)
    // {
    //     $this->db->select("user_status");
    //     $this->db->from("user");
    //     $this->db->where("user_id", $user_id);
    //     $this->db->set('user_status','Aktif');



    // }
    function aktivasiSingle($user_id, $status){
        $this->db->set("user_status", $status);
        $this->db->where("user_id", $user_id);
        return $this->db->update("user");
    }
}