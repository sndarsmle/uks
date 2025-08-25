<?php

class M_FollowUpDetail extends CI_model
{
    private $table = "followup_detail";

    function getAll($followup_id){
        return $this->db
            ->order_by('tgl_followup DESC')
            ->get_where($this->table, [
                'followup_id' => $followup_id
            ])
            ->result();
    }

    function get($id) {
        return $this->db
            ->get_where($this->table, ["id" => $id])
            ->row();
    }

    function insert($data){
        $this->db->set('id', 'UUID()', FALSE);
        $followup_detail = array(
            'followup_id' => $data['followup_id'],
            'tgl_followup' => $data['tgl_followup'],
            'respon' => $data['respon'],
            'isfinish' => $data['isfinish']
        );
        return $this->db->insert($this->table, $followup_detail);
    }

    function update($data){
        $followup_detail = array(
            'tgl_followup' => $data['tgl_followup'],
            'respon' => $data['respon'],
            'isfinish' => $data['isfinish'],
            'updated_at' => date('Y-m-d H:i:s', time())
        );
        $this->db->update($this->table, $followup_detail, ['id' => $data['id']]);
		return $this->db->affected_rows();
    }

    function delete($data) {
        return $this->db->delete($this->table, [
            'id' => $data['id']
        ]);
    }
}