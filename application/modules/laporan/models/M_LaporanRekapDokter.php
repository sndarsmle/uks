<?php

class M_LaporanRekapDokter extends CI_model
{
    function showSummaryDoctorPeriodeMCUSCR($periode_id){
        return $this->db->select("
                    dokter.dokter_username
                    , dokter.dokter_fullname
                    , siswa.siswa_nama
                    , siswa.siswa_nis
                    , (
                        SELECT CONCAT(kelas.kelas_tingkat, kelas.kelas_rombel) 
                        FROM kelas 
                        WHERE kelas.siswa_id = mcu.siswa_id 
                        ORDER BY kelas.kelas_ta DESC 
                        LIMIT 1
                    ) AS siswa_kelas
                    , mcu_code
                ")
                ->from('mcu')
                ->join('siswa', 'siswa_id', 'left')
                ->join('dokter', 'dokter_id', 'left')
                ->where('mcu.periode_id', $periode_id)
                ->where('dokter.dokter_username IS NOT NULL')
                ->order_by('dokter.dokter_username ASC, siswa_kelas ASC, siswa_nama ASC')
                ->get()
                ->result_object();
    }

    function showSummaryDoctorPeriodeDCU($periode_id){
        return $this->db->select("
                    dokter.dokter_username
                    , dokter.dokter_fullname
                    , siswa.siswa_nama
                    , siswa.siswa_nis
                    , (
                        SELECT CONCAT(kelas.kelas_tingkat, kelas.kelas_rombel) 
                        FROM kelas 
                        WHERE kelas.siswa_id = dcu.siswa_id 
                        ORDER BY kelas.kelas_ta DESC 
                        LIMIT 1
                    ) AS siswa_kelas
                    , dcu_code
                ")
                ->from('dcu')
                ->join('siswa', 'USING (siswa_id)', 'left')
                ->join('dokter', 'USING (dokter_id)', 'left')
                ->where('dcu.periode_id', $periode_id)
                ->where('dokter.dokter_username IS NOT NULL')
                ->order_by('dokter.dokter_username ASC, siswa_kelas ASC, siswa_nama ASC')
                ->get()
                ->result_object();
    }
}