<?php

class M_Sync extends CI_model
{
    private $tableSync = "sync";

    function create($count, $userID, $type){
        $syncData = [
            'sync_count' => $count,
            'sync_type' => $type,
            'user_id' => $userID,
        ];
        $result = $this->db->insert($this->tableSync, $syncData);
        return $result;
    }

    function showAll(){
        $this->db->select('sync_count, sync_created_at, sync_type, nama_user');
        $this->db->from($this->tableSync);
        $this->db->join('user', 'user_id', 'left');
        $this->db->order_by('sync_created_at', 'desc');
        return $this->db->get()->result();
    }

}