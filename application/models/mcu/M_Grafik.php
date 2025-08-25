<?php
class M_Grafik extends CI_model{

    public function getGraphSMA($siswa_id, $gender)
    {
        $this->db->distinct()
            ->select('
                pimt as imt
                , concat(periode.periode_monthName," ", periode.periode_year) as jadwal_mcu
                , mcu_date as tgl_periksa
                , tahun_usia
                , bulan_usia
                , batas_atas
                , batas_bawah
            ')
            ->from('mcu')
            ->join("mcu_gizi_sma", "mcu_id", "LEFT")
            ->join("periode", "periode_id", "LEFT");
        if ($gender == "L") {
            $this->db->join('imt_laki', '(mcu.mcu_ageY = imt_laki.tahun_usia AND mcu.mcu_ageM = imt_laki.bulan_usia)', 'left');
        } else if ($gender == 'P') {
            $this->db->join('imt_perempuan', 'mcu.mcu_ageY = imt_perempuan.tahun_usia AND mcu.mcu_ageM = imt_perempuan.bulan_usia', 'left');
        }
        $this->db->where('siswa_id', $siswa_id);
        $this->db->order_by('tgl_periksa', 'ASC');
        return $this->db->get()->result();
    }

    function getGraphSMP($siswa_id, $gender)
    {
        $this->db->distinct()
            ->select('
                pimt as imt
                , concat(periode.periode_monthName," ", periode.periode_year) as jadwal_mcu
                , mcu_date as tgl_periksa
                , tahun_usia
                , bulan_usia
                , batas_atas
                , batas_bawah
            ')
            ->from('mcu')
            ->join("mcu_gizi_smp", "mcu_id", "LEFT")
            ->join("periode", "periode_id", "LEFT");
            if ($gender == "L") {
                $this->db->join('imt_laki', '(mcu.mcu_ageY = imt_laki.tahun_usia AND mcu.mcu_ageM = imt_laki.bulan_usia)', 'left');
            } else if ($gender == 'P') {
                $this->db->join('imt_perempuan', 'mcu.mcu_ageY = imt_perempuan.tahun_usia AND mcu.mcu_ageM = imt_perempuan.bulan_usia', 'left');
            }
        $this->db->where('siswa_id', $siswa_id);
        $this->db->order_by('tgl_periksa', 'ASC');
        return $this->db->get()->result();
    }

    function getGraphSD($siswa_id, $gender)
    {
        $this->db->distinct()
            ->select('
                pimt as imt
                , concat(periode.periode_monthName," ", periode.periode_year) as jadwal_mcu
                , mcu_date as tgl_periksa
                , tahun_usia
                , bulan_usia
                , batas_atas
                , batas_bawah
            ')
            ->from('mcu')
            ->join("mcu_gizi_sd", "mcu_id", "LEFT")
            ->join("periode", "periode_id", "LEFT");
            if ($gender == "L") {
                $this->db->join('imt_laki', '(mcu.mcu_ageY = imt_laki.tahun_usia AND mcu.mcu_ageM = imt_laki.bulan_usia)', 'left');
            } else if ($gender == 'P') {
                $this->db->join('imt_perempuan', 'mcu.mcu_ageY = imt_perempuan.tahun_usia AND mcu.mcu_ageM = imt_perempuan.bulan_usia', 'left');
            }
        $this->db->where('siswa_id', $siswa_id);
        $this->db->order_by('tgl_periksa', 'ASC');
        return $this->db->get()->result();
    }

    function getGraphDCKBTK($siswa_id, $gender)
    {
        $this->db->distinct()
            ->select('
                pimt as imt
                , concat(periode.periode_monthName," ", periode.periode_year) as jadwal_mcu
                , mcu_date as tgl_periksa
                , tahun_usia
                , bulan_usia
                , batas_atas
                , batas_bawah
            ')
            ->from('mcu')
            ->join("mcu_gizi_dckbtk", "mcu_id", "LEFT")
            ->join("periode", "periode_id", "LEFT");
            if ($gender == "L") {
                $this->db->join('imt_laki', '(mcu.mcu_ageY = imt_laki.tahun_usia AND mcu.mcu_ageM = imt_laki.bulan_usia)', 'left');
            } else if ($gender == 'P') {
                $this->db->join('imt_perempuan', 'mcu.mcu_ageY = imt_perempuan.tahun_usia AND mcu.mcu_ageM = imt_perempuan.bulan_usia', 'left');
            }
        $this->db->where('siswa_id', $siswa_id);
        $this->db->order_by('tgl_periksa', 'ASC');
        return $this->db->get()->result();
    }
}