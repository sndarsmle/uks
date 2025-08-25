<?php

class M_APIMCU extends CI_model
{
    private $table = "mcu";

    function showByParentId($siswa_id){
        $this->db->select("mcu_id, mcu_code, mcu_date, mcu_ageY, mcu_ageM, periode_name, periode_monthName, periode_year")
            ->from($this->table)
            ->join("periode", "periode_id")
            ->join("dokter", "dokter_id")
            ->order_by("periode.periode_year DESC, periode.periode_created_at ASC")
            ->where("siswa_id", $siswa_id);
        return $this->db->get()->result();
    }
}