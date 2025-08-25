
<?php

class M_CetakMcu extends CI_model
{


    function createRow($Data)
    {
        $lainsd = [
            'mcu_id' => $Data['form_id'],
            'mental' => $Data['mental'],
            'saran' => $Data['saran'],
            'kesimpulan' => $Data['kesimpulan'],
            'followup' => $Data['followup'],
        ];
        $result = $this->db->insert($this->table, $lainsd);
        return $result;
    }

    function findByParentId($mcuID)
    {
        $this->db->select("*")
            ->from($this->table)
            ->where("mcu_id", $mcuID);
        $result = $this->db->get()->result();
        if ($result) {
            $result = $result[0];
        }
        return $result;
    }

    function updateRow($Data)
    {
        $lainsd = [
            'mental' => $Data['mental'],
            'saran' => $Data['saran'],
            'kesimpulan' => $Data['kesimpulan'],
            'followup' => $Data['followup'],
        ];
        $this->db->where("mcu_id", $Data['form_id']);
        $result = $this->db->update($this->table, $lainsd);
        return $result;
    }
    function getNama($idsiswa)
    {
        $this->db->select('siswa_nama, siswa_nis');
        $this->db->from('siswa');
        $this->db->where('siswa_id', $idsiswa);
        $result = $this->db->get()->result();
        if ($result) {
            $result = $result[0];
        }
        return $result;
    }
    function getdatemcu($idsiswa)
    {
        $this->db->select('*');
        $this->db->from('mcu')
            ->join("periode", "periode_id", "LEFT")
            ->where('siswa_id', $idsiswa)
            ->order_by("mcu_created_at", "DSC");

        $result = $this->db->get()->result();
        return $result;
    }
    function getIdSiswa($mcu_id)
    {
        $this->db->select('dokter_id, siswa_id, periode_name')
                ->from('mcu')
                ->join('periode','periode_id')
                ->where('mcu_id', $mcu_id);
        $result = $this->db->get()->result();
        if ($result) {
            $result = $result[0];
        }
        return $result;
    }
    function getIdSiswaArray($mcu_id)
    {
        $this->db->select('siswa_id');
        $this->db->from('mcu');
        $this->db->where('mcu_id', $mcu_id);
        $result = $this->db->get()->result_array();
        if ($result) {
            $result = $result[0];
        }
        return $result;
    }
    function getOneMcuKodeSMP($mcu_id, $gender)
    {
        $this->db->distinct();

        $this->db->select("*")
            ->from('mcu');



        if ($gender == "L") {
            $this->db->join('imt_laki', '(mcu.mcu_ageY = imt_laki.tahun_usia AND mcu.mcu_ageM = imt_laki.bulan_usia)', 'left');
        } else if ($gender == 'P') {
            $this->db->join('imt_perempuan', 'mcu.mcu_ageY = imt_perempuan.tahun_usia AND mcu.mcu_ageM = imt_perempuan.bulan_usia', 'left');
        }

        $this->db->join("siswa", "mcu.siswa_id = siswa.siswa_id", "LEFT")
            ->join('kelas', 'mcu.siswa_id = kelas.siswa_id', 'LEFT')
            ->join("periode", "periode_id", "LEFT")
            ->join("mcu_bersihsmp", "mcu_id", "LEFT")
            ->join("mcu_gizi_smp", "mcu_id", "LEFT")
            ->join("mcu_matatelingasmp", "mcu_id", "LEFT")
            ->join("mcu_mulutsmp", "mcu_id", "LEFT")
            ->join("mcu_vitalsmp", "mcu_id", "LEFT")
            ->join("mcu_lainsmp", "mcu_id", "LEFT")

            ->where("mcu_id", $mcu_id);
        $this->db->select('concat(periode.periode_monthName," ", periode.periode_year) as jadwal_mcu');
        $this->db->select('pimt as imt');

        return $this->db->get()->result();
    }
    function grafikSmp($siswa_id, $gender)
    {
        $this->db->distinct();
        $this->db->select('pimt as imt
            , concat(periode.periode_monthName," ", periode.periode_year) as jadwal_mcu
            , mcu_date as tgl_periksa
            , tahun_usia
            , bulan_usia
            , batas_atas
            , batas_bawah');
        $this->db->from('mcu')
            ->join("mcu_gizi_smp", "mcu_id", "LEFT")
            ->join("periode", "periode_id", "LEFT");
        if ($gender == "L") {
            $this->db->join('imt_laki', '(mcu.mcu_ageY = imt_laki.tahun_usia AND mcu.mcu_ageM = imt_laki.bulan_usia)', 'left');
        } else if ($gender == 'P') {
            $this->db->join('imt_perempuan', 'mcu.mcu_ageY = imt_perempuan.tahun_usia AND mcu.mcu_ageM = imt_perempuan.bulan_usia', 'left');
        }

        // $this->db->where('kode_mcu',$kode_mcu);
        // return $this->db->get()->result();
        $this->db->where('siswa_id', $siswa_id);
        $this->db->order_by('tgl_periksa', 'ASC');
        return $this->db->get()->result();
    }
    function getOneMcuKodeSD($mcu_id, $gender)
    {
        $this->db->distinct();

        $this->db->select("*")
            ->from('mcu');



        if ($gender == "L") {
            $this->db->join('imt_laki', '(mcu.mcu_ageY = imt_laki.tahun_usia AND mcu.mcu_ageM = imt_laki.bulan_usia)', 'left');
        } else if ($gender == 'P') {
            $this->db->join('imt_perempuan', 'mcu.mcu_ageY = imt_perempuan.tahun_usia AND mcu.mcu_ageM = imt_perempuan.bulan_usia', 'left');
        }

        $this->db->join("siswa", "mcu.siswa_id = siswa.siswa_id", "LEFT")
            ->join('kelas', 'mcu.siswa_id = kelas.siswa_id', 'LEFT')
            ->join("periode", "periode_id", "LEFT")
            ->join("mcu_umum_sd", "mcu_id", "LEFT")
            ->join("mcu_gizi_sd", "mcu_id", "LEFT")
            ->join("mcu_matatelingasd", "mcu_id", "LEFT")
            ->join("mcu_mulut_sd", "mcu_id", "LEFT")
            ->join("mcu_lainsd", "mcu_id", "LEFT")

            ->where("mcu_id", $mcu_id);
        $this->db->select('concat(periode.periode_monthName," ", periode.periode_year) as jadwal_mcu');
        $this->db->select('pimt as imt');

        return $this->db->get()->result();
    }
    function grafikSd($siswa_id, $gender)
    {
        $this->db->distinct();
        $this->db->select('
            pimt as imt
            , concat(periode.periode_monthName," ", periode.periode_year) as jadwal_mcu
            , mcu_date as tgl_periksa
            , tahun_usia
            , bulan_usia
            , batas_atas
            , batas_bawah
        ');
        $this->db->from('mcu')
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
    function getOneMcuKodeDCKB($mcu_id, $gender)
    {
        $this->db->distinct();

        $this->db->select("*")
            ->from('mcu');

        if ($gender == "L") {
            $this->db->join('imt_laki', '(mcu.mcu_ageY = imt_laki.tahun_usia AND mcu.mcu_ageM = imt_laki.bulan_usia)', 'left');
        } else if ($gender == 'P') {
            $this->db->join('imt_perempuan', 'mcu.mcu_ageY = imt_perempuan.tahun_usia AND mcu.mcu_ageM = imt_perempuan.bulan_usia', 'left');
        }

        $this->db->join("siswa", "mcu.siswa_id = siswa.siswa_id", "LEFT")
            ->join('kelas', 'mcu.siswa_id = kelas.siswa_id', 'LEFT')
            ->join("periode", "periode_id", "LEFT")
            ->join("mcu_umum_dckbtk", "mcu_id", "LEFT")
            ->join("mcu_gizi_dckbtk", "mcu_id", "LEFT")
            ->join("mcu_matatelingadckbtk", "mcu_id", "LEFT")
            ->join("mcu_mulut_dckbtk", "mcu_id", "LEFT")
            ->join("mcu_laindckbtk", "mcu_id", "LEFT")
            ->where("mcu_id", $mcu_id);
        $this->db->select('concat(periode.periode_monthName," ", periode.periode_year) as jadwal_mcu');
        $this->db->select('pimt as imt');

        return $this->db->get()->result();
    }
    function grafikDCKB($siswa_id, $gender, $thnAkademik_id = null)
    {
        $this->db->distinct();
        $this->db->select('pimt as imt
            , concat(periode.periode_monthName," ", periode.periode_year) as jadwal_mcu
            , mcu_date as tgl_periksa
            , tahun_usia
            , bulan_usia
            , batas_atas
            , batas_bawah');
        $this->db->from('mcu')
            ->join("mcu_gizi_dckbtk", "mcu_id", "LEFT")
            ->join("periode", "periode_id", "LEFT");
        if ($gender == "L") {
            $this->db->join('imt_laki', '(mcu.mcu_ageY = imt_laki.tahun_usia AND mcu.mcu_ageM = imt_laki.bulan_usia)', 'left');
        } else if ($gender == 'P') {
            $this->db->join('imt_perempuan', 'mcu.mcu_ageY = imt_perempuan.tahun_usia AND mcu.mcu_ageM = imt_perempuan.bulan_usia', 'left');
        }

        // $this->db->where('kode_mcu',$kode_mcu);
        // return $this->db->get()->result();
        $this->db->where('siswa_id', $siswa_id);
        $this->db->order_by('tgl_periksa', 'ASC');
        return $this->db->get()->result();
    }

    function getReport($periode, $kelas_tingkat, $kelas_rombel, $jenjang)
    {
        if ($jenjang == "22" || $jenjang == "11") {
            $this->db->select('*
                , (CASE `mcu_gizi_dckbtk`.`status_gizi`
                        WHEN "1" THEN "Sangat Kurus"
                        WHEN "2" THEN "Kurus"
                        WHEN "3" THEN "Normal"
                        WHEN "4" THEN "Gemuk"
                        WHEN "5" THEN "Sangat Gemuk"
                    END) AS status_gizi_text
                , ( CASE `mcu_gizi_dckbtk`.`bbperu`
                    WHEN "1" THEN "Normal"
                    WHEN "2" THEN "Gizi Kurang"
                    WHEN "3" THEN "Gizi Lebih"
                END) AS bbperu_text
                , ( CASE `mcu_gizi_dckbtk`.`anemia`
                    WHEN "1" THEN "Tidak"
                    WHEN "2" THEN "Ya"
                END) AS anemia_text');
        } else if ($jenjang == "33") {
            $this->db->select('*
                , (CASE `mcu_gizi_sd`.`status_gizi`
                        WHEN "1" THEN "Sangat Kurus"
                        WHEN "2" THEN "Kurus"
                        WHEN "3" THEN "Normal"
                        WHEN "4" THEN "Gemuk"
                        WHEN "5" THEN "Sangat Gemuk"
                        END) AS status_gizi_text
                , ( CASE `mcu_gizi_sd`.`stun`
                        WHEN "1" THEN "Normal"
                        WHEN "2" THEN "Pendek"
                        END) AS stun_text
                , ( CASE `mcu_gizi_sd`.`anemia`
                        WHEN "1" THEN "Tidak"
                        WHEN "2" THEN "Ya"
                        END) AS anemia_text');
        } else if ($jenjang == "44") {
            $this->db->select('*
                , (CASE `mcu_gizi_smp`.`status_gizi`
                        WHEN "1" THEN "Sangat Kurus"
                        WHEN "2" THEN "Kurus"
                        WHEN "3" THEN "Normal"
                        WHEN "4" THEN "Gemuk"
                        WHEN "5" THEN "Sangat Gemuk"
                        END) AS status_gizi_text
                , ( CASE `mcu_gizi_smp`.`stun`
                        WHEN "1" THEN "Normal"
                        WHEN "2" THEN "Pendek"
                        END) AS stun_text
                , ( CASE `mcu_gizi_smp`.`anemia`
                        WHEN "1" THEN "Tidak"
                        WHEN "2" THEN "Ya"
                        END) AS anemia_text');
        }
        $this->db->from('mcu')
            ->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left')
            ->join('periode', 'mcu.periode_id=periode.periode_id', 'left')
            ->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left')
            ->join('tahun_akademik', 'thnAkademik_id', 'left');
        if ($jenjang == "22" || $jenjang == "11") {
            $this->db->join('mcu_gizi_dckbtk', 'mcu.mcu_id=mcu_gizi_dckbtk.mcu_id', 'left');
        }
        else if ($jenjang == "33") {
            $this->db->join('mcu_gizi_sd', 'mcu.mcu_id=mcu_gizi_sd.mcu_id', 'left');
        }
        else if ($jenjang == "44") {
            $this->db->join('mcu_gizi_smp', 'mcu.mcu_id=mcu_gizi_smp.mcu_id', 'left');
        }

        $this->db->where('kelas_rombel', $kelas_rombel)
            ->where('kelas_tingkat', $kelas_tingkat)
            ->where('siswa_jenjang', $jenjang)
            ->where('mcu.periode_id', $periode)
            ->where('kelas.kelas_ta = thnAkademik_year')
            ->order_by('siswa_nama ASC');

        return $this->db->get()->result();
    }

    function getReport2($kelas_tingkat, $kelas_rombel, $periode)
    {
        $this->db->select('*
            , (CASE `mcu_gizi_dckbtk`.`status_gizi`
                    WHEN "1" THEN "Sangat Kurus"
                    WHEN "2" THEN "Kurus"
                    WHEN "3" THEN "Normal"
                    WHEN "4" THEN "Gemuk"
                    WHEN "5" THEN "Sangat Gemuk"
                END) AS status_gizi_text
            , ( CASE `mcu_gizi_dckbtk`.`bbperu`
                WHEN "1" THEN "Normal"
                WHEN "2" THEN "Gizi Kurang"
                WHEN "3" THEN "Gizi Lebih"
            END) AS bbperu_text
            , ( CASE `mcu_gizi_dckbtk`.`anemia`
                WHEN "1" THEN "Tidak"
                WHEN "2" THEN "Ya"
            END) AS anemia_text');
        $this->db->from('mcu');
        $this->db->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left');
        $this->db->join('periode', 'mcu.periode_id=periode.periode_id', 'left');
        $this->db->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left');
        $this->db->join('mcu_gizi_dckbtk', 'mcu.mcu_id=mcu_gizi_dckbtk.mcu_id', 'left');

        $this->db->where('kelas_rombel', $kelas_rombel);
        $this->db->where('kelas_tingkat', $kelas_tingkat);
        $this->db->where('mcu.periode_id', $periode);

        return $this->db->get()->result();
    }
}
