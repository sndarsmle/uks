<?php

class M_GiziSMA extends CI_model
{
    private $table = "mcu_gizi_sma";

    public function create($data)
    {
        $giziSMA = [
            'mcu_id' => $data['form_id'],
            'bb' => $data['bb'],
            'tb' => $data['tb'],
            'lk' => $data['lk'],
            'lla' => $data['lla'],
            'lp' => $data['lp'],
            'pimt' => $data['pimt'],
            'status_gizi' => $data['status_gizi'],
            'stun' => $data['stun'],
            'anemia' => $data['anemia'],
        ];
        $this->db->trans_start();
        $this->db->insert($this->table, $giziSMA);
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
        $giziSMA = [
            'bb' => $data['bb'],
            'tb' => $data['tb'],
            'lk' => $data['lk'],
            'lla' => $data['lla'],
            'lp' => $data['lp'],
            'pimt' => $data['pimt'],
            'status_gizi' => $data['status_gizi'],
            'stun' => $data['stun'],
            'anemia' => $data['anemia'],
        ];
        $this->db->trans_start();
        $this->db->update($this->table, $giziSMA, ["mcu_id" => $data['form_id']]);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}