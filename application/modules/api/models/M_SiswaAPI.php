<?php

class M_SiswaAPI extends CI_model
{
    private $table = "coba_siswa";

    function showByUnique($name, $jenjang){
        $this->db->select("idsiswa, nis, nama");
        $this->db->from($this->table);
        $this->db->like("nama", $name);
        $this->db->where("jenjang", $jenjang);
        if($jenjang == 22){
            $this->db->or_where("jenjang", 11);
        }
        return $this->db->get()->result();
    }
}