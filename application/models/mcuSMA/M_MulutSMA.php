<?php

class M_MulutSMA extends CI_model
{
    private $table = "mcu_mulutsma";

    public function create($data)
    {
        $mulutSMA = [
            'mcu_id' => $data['form_id'],
            'bibir' => $data['bibir'],
            'sudut_mulut' => $data['sudut_mulut'],
            'sariawan' => $data['sariawan'],
            'lidah' => $data['lidah'],
            'luka_lain' => $data['luka_lain'],
            'ket_masalah_lain_rongga_mulut' => $data['ket_masalah_lain_rongga_mulut'],
        ];
        $this->db->trans_start();
        $result = $this->db->insert($this->table, $mulutSMA);
        $this->db->trans_complete();
        return $result;
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
        $mulutSMA = [
            'bibir' => $data['bibir'],
            'sudut_mulut' => $data['sudut_mulut'],
            'sariawan' => $data['sariawan'],
            'lidah' => $data['lidah'],
            'luka_lain' => $data['luka_lain'],
            'ket_masalah_lain_rongga_mulut' => $data['ket_masalah_lain_rongga_mulut'],
        ];
        $this->db->trans_start();
        $result = $this->db->update($this->table, $mulutSMA, ['mcu_id' => $data['mcu_id']]);
        $this->db->trans_complete();
        return $result;
    }
}