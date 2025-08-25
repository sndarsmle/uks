<?php

class M_APIOTP extends CI_model
{
    private $table = "api_otp";

    function createRow($data){
        return $this->db->insert($this->table, $data);
    }

    function updateRow($data, $siswaID){
        $this->db->where("siswa_id", $siswaID);
        return $this->db->update($this->table, $data);
    }

    function findByParentId($siswaID){
        $this->db->select("*")
                ->from($this->table)
                ->where("siswa_id", $siswaID);
        return $this->db->get()->row();
    }

    function findByUnique($siswaID, $code){
        $this->db->select("*, TIMESTAMPDIFF(Minute,otp_updated_at, now()) as otp_range")
                ->from($this->table)
                ->where("siswa_id", $siswaID)
                ->where("otp_code", $code);
        return $this->db->get()->row();
    }
}