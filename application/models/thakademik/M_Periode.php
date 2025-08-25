<?php

/**
 * model for table thn_akademik based on codeigniter 3
 * @property mixed $db this is codeigniter 3 database plugin
 */
class M_Periode extends CI_Model
{
    private string $table = 'periode';

    /**
     * @param $data
     * @return bool
     */
    public function createRow($data): bool
    {
        $Periode = [
            'thnAkademik_id' => $data['form_id'],
            'periode_name' => $data['form_kegiatan'],
            'periode_monthName' => $data['form_bulan'],
            'periode_year' => $data['form_thn'],
        ];
        return $this->db->insert($this->table, $Periode);
    }

    /**
     * @param $rowId
     * @return stdClass
     */
    public function findById($rowId): stdClass
    {
        $this->db->select('*')
            ->from($this->table)
            ->where('periode_id', $rowId);
        return $this->db->get()->row();
    }

    function findByActive()
    {
        $this->db->select('*')
            ->from($this->table)
            ->where('periode_active', 1);
        return $this->db->get()->result();
    }

    /**
     * @return array
     */
    public function showAll(): array
    {
        $this->db->select('*')
            ->from($this->table);
        return $this->db->get()->result();
    }

    /**
     * @param $thnId
     * @return array
     */
    public function showByParentId($thnId): array
    {
        $this->db->select('*')
            ->from($this->table)
            ->where('thnAkademik_id', $thnId);
        return $this->db->get()->result();
    }

    function showSummaryByParentId($thnId)
    {
        $this->db->select('periode.*, 
                            (SELECT COUNT(*) FROM mcu 
                                    WHERE mcu.periode_id = periode.periode_id) AS periode_members, 
                            (SELECT COUNT(*) FROM dcu 
                                    WHERE dcu.periode_id = periode.periode_id) AS periode_member_dcu')
            ->from($this->table)
            ->where('thnAkademik_id', $thnId)
            ->order_by('periode_year', 'DESC')
            ->order_by('periode_created_at', 'DESC');
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

    function getOnePeriodeMcu($periode_id)
    {
        $this->db->select('count(mcu_id) as jumlah_siswa, CONCAT(kelas.kelas_tingkat, kelas.kelas_rombel) as kelas, 
                            periode_id,kelas.kelas_tingkat, kelas.kelas_rombel,siswa.siswa_jenjang as jenjang');
        $this->db->from('mcu');
        $this->db->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left');
        $this->db->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left');
        $this->db->where('periode_id', $periode_id);
        $this->db->group_by('kelas, jenjang');

        return $this->db->get()->result();
    }

    function getOnePeriodeDcu($periode_id)
    {
        $this->db->select('count(dcu_id) as jumlah_siswa, CONCAT(kelas.kelas_tingkat, kelas.kelas_rombel) as kelas, 
                            periode_id,kelas.kelas_tingkat, kelas.kelas_rombel,siswa.siswa_jenjang as jenjang');
        $this->db->from('dcu');
        $this->db->join('siswa', 'dcu.siswa_id=siswa.siswa_id', 'left');
        $this->db->join('kelas', 'dcu.siswa_id=kelas.siswa_id', 'left');
        $this->db->where('periode_id', $periode_id);
        $this->db->group_by('kelas,jenjang');

        return $this->db->get()->result();
    }

    function getOneClassOnePeriodeMcu($kelas_tingkat, $kelas_rombel, $periode)
    {
        $this->db->select('*');
        $this->db->from('mcu');
        $this->db->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left');
        $this->db->join('periode', 'mcu.periode_id=periode.periode_id', 'left');
        $this->db->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left');
        $this->db->where('kelas_rombel', $kelas_rombel);
        $this->db->where('kelas_tingkat', $kelas_tingkat);
        $this->db->where('mcu.periode_id', $periode);
        return $this->db->get()->result();
    }

    function getOneClassOnePeriodeDcu($kelas_tingkat, $kelas_rombel, $periode)
    {
        $this->db->select('*');
        $this->db->from('dcu');
        $this->db->join('siswa', 'dcu.siswa_id=siswa.siswa_id', 'left');
        $this->db->join('periode', 'dcu.periode_id=periode.periode_id', 'left');
        $this->db->join('kelas', 'dcu.siswa_id=kelas.siswa_id', 'left');
        $this->db->where('kelas_rombel', $kelas_rombel);
        $this->db->where('kelas_tingkat', $kelas_tingkat);
        $this->db->where('dcu.periode_id', $periode);
        return $this->db->get()->result();
    }

}