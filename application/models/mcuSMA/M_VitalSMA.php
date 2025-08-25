<?php

class M_VitalSMA extends CI_model
{
    private $table = "mcu_vitalsmp";

    public function create($data)
    {
        $vitalSMA = [
            'mcu_id' => $data['form_id'],
            'vital_tekananDarahmm' => $data['form_tekananDarahmm'],
            'vital_tekananDarahhg' => $data['form_tekananDarahhg'],
            'vital_nadi' => $data['form_nadi'],
            'vital_freqNafas' => $data['form_freqNafas'],
            'vital_suhu' => $data['form_suhu'],
            'vital_bisingJantung' => $data['form_bisingJantung'],
            'vital_bisingParu' => $data['form_bisingParu'],
        ];
        $this->db->trans_start();
        $result = $this->db->insert($this->table, $vitalSMA);
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
        $vitalSMA = [
            'vital_tekananDarahmm' => $data['form_tekananDarahmm'],
            'vital_tekananDarahhg' => $data['form_tekananDarahhg'],
            'vital_nadi' => $data['form_nadi'],
            'vital_freqNafas' => $data['form_freqNafas'],
            'vital_suhu' => $data['form_suhu'],
            'vital_bisingJantung' => $data['form_bisingJantung'],
            'vital_bisingParu' => $data['form_bisingParu'],
        ];
        $this->db->trans_start();
        $result = $this->db->update($this->table, $vitalSMA, ['mcu_id' => $data['form_id']]);
        $this->db->trans_complete();
        return $result;
    }
}