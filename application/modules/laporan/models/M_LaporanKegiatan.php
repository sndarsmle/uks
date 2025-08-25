<?php

/**
 * @property CI_DB_query_builder $db service to handle query builder based on codeigniter 3
 */

class M_LaporanKegiatan extends CI_Model
{
    private string $table = "periode";

    function showSummaryPeriodeMCUSCR($periode_id){
        $this->db->select('count(mcu_id) as jumlah_siswa, CONCAT(kelas.kelas_tingkat, kelas.kelas_rombel) as kelas, 
                            periode_id,kelas.kelas_tingkat, kelas.kelas_rombel,siswa.siswa_jenjang as jenjang')
                ->from('mcu')
                ->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left')
                ->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left')
                ->join('periode', 'periode_id', 'left')
                ->join('tahun_akademik', 'thnAkademik_id', 'left')
                ->where('periode_id',$periode_id)
                ->where('kelas.kelas_ta = thnAkademik_year')
                ->group_by('kelas, jenjang, kelas.kelas_tingkat, kelas.kelas_rombel')
                ->order_by('jenjang ASC, kelas ASC');
        return $this->db->get()->result();
    }

    function showSummaryPeriodeDCU($periode_id){
        $this->db->select('count(dcu_id) as jumlah_siswa, CONCAT(kelas.kelas_tingkat, kelas.kelas_rombel) as kelas, 
                            periode_id,kelas.kelas_tingkat, kelas.kelas_rombel,siswa.siswa_jenjang as jenjang')
                ->from('dcu')
                ->join('siswa', 'dcu.siswa_id=siswa.siswa_id', 'left')
                ->join('kelas', 'dcu.siswa_id=kelas.siswa_id', 'left')
                ->join('periode', 'periode_id', 'left')
                ->join('tahun_akademik', 'thnAkademik_id', 'left')
                ->where('periode_id',$periode_id)
                ->where('kelas.kelas_ta = thnAkademik_year')
                ->order_by('jenjang ASC, kelas ASC')
                ->group_by('kelas,jenjang, kelas.kelas_tingkat, kelas.kelas_rombel');
        return $this->db->get()->result();
    }

    /**
     * @param string $classLevel
     * @param string $groupName
     * @param string $periode
     * @param string $schoolLevel
     * @return object|array
     */
    public function showDetailPeriodeMCUSCR(string $classLevel, string $groupName, string $periode, string $schoolLevel): object|array
    {
        $this->db->select()
                ->from('mcu')
                ->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left')
                ->join('periode','mcu.periode_id=periode.periode_id', 'left')
                ->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left')
                ->join('tahun_akademik', 'thnAkademik_id', 'left')
                ->where('kelas_rombel', $groupName)
                ->where('kelas_tingkat', $classLevel)
                ->where('siswa_jenjang', $schoolLevel)
                ->where('mcu.periode_id', $periode)
                ->where('kelas.kelas_ta = thnAkademik_year')
                ->order_by('siswa_nama ASC');
        return $this->db->get()->result();
    }

    /**
     * @param string $classLevel
     * @param string $groupName
     * @param string $periode
     * @param string $schoolLevel
     * @return object|array
     */
    public function showDetailPeriodeDCU(string $classLevel, string $groupName, string $periode, string $schoolLevel): object|array
    {
        $this->db->select('*')
                ->from('dcu')
                ->join('siswa', 'dcu.siswa_id=siswa.siswa_id', 'left')
                ->join('periode','dcu.periode_id=periode.periode_id', 'left')
                ->join('kelas', 'dcu.siswa_id=kelas.siswa_id', 'left')
                ->join('tahun_akademik', 'thnAkademik_id', 'left')
                ->where('kelas_rombel', $groupName)
                ->where('kelas_tingkat', $classLevel)
                ->where('siswa_jenjang', $schoolLevel)
                ->where('dcu.periode_id', $periode)
                ->where('kelas.kelas_ta = thnAkademik_year')
                ->order_by('siswa_nama ASC');
        return $this->db->get()->result();
    }

}