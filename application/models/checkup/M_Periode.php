<?php

class M_Periode extends CI_model
{
    private $table = "checkup_periode";

    function getAll()
    {
        return $this->db
            ->order_by("name ASC, date ASC")
            ->get($this->table)
            ->result();
    }

    function get($id)
    {
        return $this->db
            ->order_by("name ASC, date ASC")
            ->get_where($this->table, ["id" => $id])
            ->row();
    }

    function insert($data)
    {
        $this->db->set('id', 'UUID()', FALSE);
        $checkup_periode = array(
            'thnAkademik_id' => $data['thnAkademik_id'],
            'name' => $data['name'],
            'date' => $data['date']
        );
        return $this->db->insert($this->table, $checkup_periode);
    }

    function update($data)
    {
        $checkup_periode = array(
            'name' => $data['name'],
            'date' => $data['date'],
            'updated_at' => date('Y-m-d H:i:s', time())
        );
        $this->db->update($this->table, $checkup_periode, ['id' => $data['id']]);
        return $this->db->affected_rows();
    }

    function delete($data)
    {
        $this->load->model('checkup/M_Checkup', 'mCheckUp');
        $this->mCheckUp->deleteByCheckUpPeriodeId($data['id']);
        return $this->db->delete($this->table, [
            'id' => $data['id']
        ]);
    }

    function getLastInsertId($param)
    {
        return $this->db
            ->select("id")
            ->get_where($this->table, [
                'thnAkademik_id' => $param['thnAkademik_id'],
                'name' => $param['name'],
                'date' => $param['date']
            ])
            ->row_object()
            ->id;
    }
}
