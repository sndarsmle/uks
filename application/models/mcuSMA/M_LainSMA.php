<?php

class M_LainSMA extends CI_model
{
    private $table = "mcu_lainsma";

    public function create($data)
    {
        $lainSMA = [
            'mcu_id' => $data['form_id'],
            'mental' => $data['mental'],
            'saran' => $data['saran'],
            'kesimpulan' => $data['kesimpulan'],
            'followup' => $data['followup'],
        ];
        $this->db->trans_start();
        $this->db->insert($this->table, $lainSMA);
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
        $lainSMA = [
            'mental' => $data['mental'],
            'saran' => $data['saran'],
            'kesimpulan' => $data['kesimpulan'],
            'followup' => $data['followup'],
        ];
        $this->db->trans_start();
        $this->db->update($this->table, $lainSMA, ["mcu_id" => $data['form_id']]);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}