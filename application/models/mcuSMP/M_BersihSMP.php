
<?php

class M_BersihSMP extends CI_model
{
    private $table = "mcu_bersihsmp";

    function createRow($Data){
        $bersihSMP = [
            'mcu_id' => $Data['form_id'],
            'rambut' => $Data['rambut'],
            'kulit' => $Data['kulit'],
            'ket_kulit' => $Data['ket_kulit'],
            'kulit_sisik' => $Data['kulit_sisik'],
            'kulit_memar' => $Data['kulit_memar'],
            'kulit_sayat' => $Data['kulit_sayat'],
            'kulit_koreng' => $Data['kulit_koreng'],
            'kulit_koreng_sukar' => $Data['kulit_koreng_sukar'],
            'kulit_suntik' => $Data['kulit_suntik'],
            'kuku' => $Data['kuku'],
        ];
        $result = $this->db->insert($this->table, $bersihSMP);
        return $result;
    }

    function findByParentId($mcuID){
        return $this->db->select("*")
                ->from($this->table)
                ->where("mcu_id", $mcuID)
                ->get()
                ->row_object();
    }

    function updateRow($Data){
        $bersihSMP = [
                    'rambut' => $Data['rambut'],
                    'kulit' => $Data['kulit'],
                    'ket_kulit' => $Data['ket_kulit'],
                    'kulit_sisik' => $Data['kulit_sisik'],
                    'kulit_memar' => $Data['kulit_memar'],
                    'kulit_sayat' => $Data['kulit_sayat'],
                    'kulit_koreng' => $Data['kulit_koreng'],
                    'kulit_koreng_sukar' => $Data['kulit_koreng_sukar'],
                    'kulit_suntik' => $Data['kulit_suntik'],
                    'kuku' => $Data['kuku'],
        ];
        $this->db->where("mcu_id", $Data['form_id']);
        $result = $this->db->update($this->table, $bersihSMP);
        return $result;
    }
}