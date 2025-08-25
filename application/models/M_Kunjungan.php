<?php

class M_Kunjungan extends CI_Model
{
    function createRow($Data)
    {
        $Kunjungan = [
            'hari' => $Data['form_hari'],
            'tgl_kunjungan' => $Data['form_tgl_kunjugan'],
            'jam_datang' => $Data['form_jam_datang'],
            'jam_keluar' => $Data['form_jam_keluar'],
            'idsiswa' => $Data['form_idsiswa'],
            'nama' => $Data['form_nama'],
            'kelas' => $Data['form_kelas'],
            'keluhan' => $Data['form_keluhan'],
            'penanganan' => $Data['form_penanganan'],
            'hasil' => $Data['form_hasil'],

        ];
        $result = $this->db->insert('kunjungan', $Kunjungan);
        return $result;
    }

    /**
     * @param $params
     * @return stdClass
     */
    public function find($params): stdClass
    {
        $this->db->select('*')
            ->from('kunjungan')
            ->where($params);
        return $this->db->get()->row();
    }

    /**
     * @return array
     */
    public function showAll(): array
    {
        $this->db->select('*')
            ->from('kunjungan')
            ->order_by('tgl_kunjungan', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * @param $params
     * @param $data
     * @return bool
     */
    public function update($params, $data): bool
    { //sek
        $this->db->trans_begin();
        $this->db->where($params)
            ->update('kunjungan', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function hapusKunjungan($idkunjungan)
    {
        $this->db->where('idkunjungan', $idkunjungan);
        $this->db->delete('kunjungan');
    }
}