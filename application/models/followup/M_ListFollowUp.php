<?php

class M_ListFollowUp extends CI_model
{
    private $table = "followup_list";
    
    function showByClass($class){
        $this->db->select("followup_list.*
                    , followup.followup_id
                    , SUM(`followup_detail`.`isfinish` = 1) AS jml_selesai
                    , SUM(`followup_detail`.`isfinish` = 0) AS jml_proses
                ")
                ->from($this->table)
                ->join('followup', 'followup_list.mcu_id = followup.mcu_id', 'left')
                ->join('followup_detail', 'followup.followup_id = followup_detail.followup_id', 'left')
                ->where('siswa_kelas', $class)
                ->group_by('`followup`.`followup_id`, `followup_list`.`mcu_id`, `followup_list`.`followup`, `followup_list`.`siswa_id`')
                ->order_by('mcu_created_at', 'ASC');
        return $this->db->get()->result();
    }
}