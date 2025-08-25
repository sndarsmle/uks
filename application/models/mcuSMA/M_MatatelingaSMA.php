<?php

class M_MatatelingaSMA extends CI_model
{
    private $table = "mcu_matatelingasma";

    public function create($data)
    {
        $mataTelingaSMA = [
            'mcu_id' => $data['form_id'],
            'mata_luar' => $data['mata_luar'],
            'penglihatan' => $data['penglihatan'],
            'ket_penglihatan' => $data['ket_penglihatan'],
            'buta_warna' => $data['buta_warna'],
            'inf_mata' => $data['inf_mata'],
            'telinga' => $data['telinga'],
            'kot_telinga' => $data['kot_telinga'],
            'inf_telinga' => $data['inf_telinga'],
            'ket_masalah_lain_pendengaran' => $data['ket_masalah_lain_pendengaran'],
        ];
        $this->db->trans_start();
        $this->db->insert($this->table, $mataTelingaSMA);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function findByParentId($mcu_id)
    {
        return $this->db
            ->select("*")
            ->from($this->table)
            ->where("mcu_id", $mcu_id)
            ->get()
            ->row_object();
    }

    public function update($data)
    {
        $mataTelingaSMA = [
            'mata_luar' => $data['mata_luar'],
            'penglihatan' => $data['penglihatan'],
            'ket_penglihatan' => $data['ket_penglihatan'],
            'buta_warna' => $data['buta_warna'],
            'inf_mata' => $data['inf_mata'],
            'telinga' => $data['telinga'],
            'kot_telinga' => $data['kot_telinga'],
            'inf_telinga' => $data['inf_telinga'],
            'ket_masalah_lain_pendengaran' => $data['ket_masalah_lain_pendengaran'],
        ];
        $this->db->trans_start();
        $this->db->update($this->table, $mataTelingaSMA, ["mcu_id" => $data['form_id']]);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}