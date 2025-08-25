<?php

/**
 * model for table thn_akademik based on codeigniter 3
 * @property mixed $db this is codeigniter 3 database plugin
 */
class M_Thakademik extends CI_Model
{
    private string $table = 'tahun_akademik';

    /**
     * @param $data
     * @return bool
     */
    public function createRow($data): bool
    {
        $thAkademik = [
            'thnAkademik_yearstart' => $data['form_thmulai'],
            'thnAkademik_yearend' => $data['form_thselesai'],
            'thnAkademik_year' => $data['form_th'],
        ];
        return $this->db->insert($this->table, $thAkademik);
    }

    /**
     * @param $rowId
     * @return stdClass
     */
    public function findById($rowId): stdClass
    {
        $this->db->select('*')
            ->from($this->table)
            ->where('thnAkademik_id', $rowId);
        return $this->db->get()->row();
    }

    /**
     * @return array
     */
    public function showAll(): array
    {
        $this->db->select('*')
            ->from($this->table)
            ->order_by('thnAkademik_yearstart', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * @return array
     */
    public function showAllSummary(): array
    {
        $this->db->select('tahun_akademik.*, 
                            (SELECT COUNT(*) FROM periode 
                            WHERE periode.thnAkademik_id = tahun_akademik.thnAkademik_id) 
                            AS thnAkademik_totalperiode')
            ->from($this->table)
            ->order_by('thnAkademik_yearstart', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * @param $params
     * @param $data
     * @return bool
     */
    public function update($params, $data): bool
    {
        $this->db->trans_begin();
        $this->db->where($params)
            ->update($this->table, $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    /**
     * @param $rowId
     * @return bool
     */
    public function deleteRow($rowId): bool
    {
        $this->db->where('thnAkademik_id', $rowId);
        return $this->db->delete($this->table);
    }

    public function getTahunAkademikIdByActive()
    {
        return $this->db
            ->select('thnAkademik_id')
            ->get_where($this->table, ['thnAkademik_active' => 1])
            ->row_object()
            ->thnAkademik_id ?? null;
    }

    public function getActive()
    {
        return $this->db
            ->select('*')
            ->get_where($this->table, ['thnAkademik_active' => 1])
            ->row_object();
    }
}