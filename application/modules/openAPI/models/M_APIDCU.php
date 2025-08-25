<?php

class M_APIDCU extends CI_model
{
    private $table = "dcu";

    function showByParentId($siswa_id){
        $this->db->select("dcu_id, dcu_code, dcu_date, dcu_ageY, dcu_ageM, periode_name, periode_monthName, periode_year")
            ->from($this->table)
            ->join("periode", "periode_id")
            ->join("dokter", "dokter_id")
            ->order_by("periode.periode_year DESC, periode.periode_created_at ASC")
            ->where("siswa_id", $siswa_id);
        return $this->db->get()->result();
    }
}