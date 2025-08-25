<?php

class M_Jadwalscreening extends CI_model
{

    function getAll()
    {
        $this->db->select("*");
        $this->db->from("jadwal_screening");
        $result =$this->db->get()->result();
        return $result;
   
    }

    function getAktif()
    {
        $this->db->select("*");
        $this->db->from("jadwal_screening");
        $this->db->where("status","Aktif");
        $result =$this->db->get()->result();
        return $result;
   
    }

    
}