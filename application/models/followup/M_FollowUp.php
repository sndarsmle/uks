<?php

class M_FollowUp extends CI_model
{
    private $table = "followup";

    function createRow($Data){
        $FollowUP = [
            'mcu_id' => $Data['form_id'],
            'followup_url' => $Data['form_url'],
        ];
        $result = $this->db->insert($this->table, $FollowUP);
        return $result;
    }

    function getRowId($Data){
        $FollowUP = [
            'mcu_id' => $Data['form_id'],
            'followup_url' => $Data['form_url'],
        ];
        $this->db->select("followup_id")
                ->from($this->table)
                ->where($FollowUP);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0]->followup_id;
        }
        return $result;
    }

    function get($id) {
        return $this->db
            ->join('followup_list', 'followup.mcu_id = followup_list.mcu_id')
            ->join('siswa', 'followup_list.siswa_id = siswa.siswa_id')
            ->get_where($this->table, ["followup.followup_id" => $id])
            ->row();
    }
}