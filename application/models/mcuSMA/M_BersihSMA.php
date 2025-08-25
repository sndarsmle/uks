<?php

class M_BersihSMA extends CI_model
{
    private $table = "mcu_bersihsma";

    public function create($data)
    {
        $bersihSMA = [
            'mcu_id' => $data['form_id'],
            'rambut' => $data['rambut'],
            'kulit' => $data['kulit'],
            'ket_kulit' => $data['ket_kulit'],
            'kulit_sisik' => $data['kulit_sisik'],
            'kulit_memar' => $data['kulit_memar'],
            'kulit_sayat' => $data['kulit_sayat'],
            'kulit_koreng' => $data['kulit_koreng'],
            'kulit_koreng_sukar' => $data['kulit_koreng_sukar'],
            'kulit_suntik' => $data['kulit_suntik'],
            'kuku' => $data['kuku'],
        ];
        $this->db->trans_start();
        $this->db->insert($this->table, $bersihSMA);
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
        $bersihSMA = [
            'rambut' => $data['rambut'],
            'kulit' => $data['kulit'],
            'ket_kulit' => $data['ket_kulit'],
            'kulit_sisik' => $data['kulit_sisik'],
            'kulit_memar' => $data['kulit_memar'],
            'kulit_sayat' => $data['kulit_sayat'],
            'kulit_koreng' => $data['kulit_koreng'],
            'kulit_koreng_sukar' => $data['kulit_koreng_sukar'],
            'kulit_suntik' => $data['kulit_suntik'],
            'kuku' => $data['kuku'],
        ];
        $this->db->trans_start();
        $this->db->update($this->table, $bersihSMA, ["mcu_id" => $data['form_id']]);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}