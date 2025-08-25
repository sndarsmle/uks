<?php

class M_Profile extends CI_model
{

    public function get($param) {
        return $this->db
            ->query(
                "(
                    SELECT 
                        siswa.siswa_id
                        , mcu.mcu_id AS id
                        , mcu.mcu_date AS periode_date
                        , periode.periode_name
                        , periode.periode_monthName
                        , periode.periode_year
                        , tahun_akademik.thnAkademik_yearstart
                        , tahun_akademik.thnAkademik_yearend
                    FROM siswa
                    JOIN kelas on siswa.siswa_id = kelas.siswa_id
                    JOIN mcu ON siswa.siswa_id = mcu.siswa_id
                    JOIN periode ON mcu.periode_id = periode.periode_id
                    JOIN tahun_akademik ON periode.thnAkademik_id = tahun_akademik.thnAkademik_id
                    WHERE siswa.siswa_id = ?
                    AND siswa.siswa_status = 1
                    AND kelas.kelas_ta = (SELECT thnAkademik_year FROM tahun_akademik WHERE thnAkademik_id = ?)
                )
                UNION ALL
                (
                    SELECT 
                        siswa.siswa_id
                        , dcu.dcu_id AS id
                        , dcu.dcu_date AS periode_date
                        , periode.periode_name
                        , periode.periode_monthName
                        , periode.periode_year
                        , tahun_akademik.thnAkademik_yearstart
                        , tahun_akademik.thnAkademik_yearend
                    FROM siswa
                    JOIN kelas on siswa.siswa_id = kelas.siswa_id
                    JOIN dcu ON siswa.siswa_id = dcu.siswa_id
                    JOIN periode ON dcu.periode_id = periode.periode_id
                    JOIN tahun_akademik ON periode.thnAkademik_id = tahun_akademik.thnAkademik_id
                    WHERE siswa.siswa_id = ?
                    AND siswa.siswa_status = 1
                    AND kelas.kelas_ta = (SELECT thnAkademik_year FROM tahun_akademik WHERE thnAkademik_id = ?)
                )
                ORDER BY periode_date DESC, periode_name ASC",
                array(
                    $param['siswa_id'],
                    $param['thnAkademik_id'],
                    $param['siswa_id'],
                    $param['thnAkademik_id']
                )
            )
            ->result();
    }

}