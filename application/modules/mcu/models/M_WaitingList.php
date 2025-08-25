<?php

class M_WaitingList extends CI_Model
{
    private string $table = "waiting_list";

    public function showAll($params = null)
    {
        $this->db->select("waiting_list.*, DATE_FORMAT(waiting_time, '%H : %i , %d - %m - %Y') as waiting_ftime, siswa.siswa_nama, periode_monthName, periode_year, periode_name,
                            (SELECT CONCAT(kelas_tingkat, ' ', kelas_rombel) FROM kelas k WHERE k.siswa_id = waiting_list.siswa_id ORDER BY kelas_ta DESC LIMIT 1) as siswa_kelas")
            ->from($this->table)
            ->join("siswa", "siswa_id", "LEFT")
            ->join("periode", "periode_id", "LEFT")
            ->where("waiting_isfinish", 0);

        if (isset($params['periode_id']) && $params['periode_id'] != null) {
            $this->db->where("periode_id", $params['periode_id']);
        }
        if (isset($params['all_mcu']) && $params['all_mcu']) {
            $this->db->where("periode_name", 'MCU');
        }
        if (isset($params['all_dcu']) && $params['all_dcu']) {
            $this->db->where("periode_name", 'DCU');
        }

        return $this->db
            ->order_by('waiting_time', 'DESC')
            ->group_by('waiting_id, periode_id, siswa_id, waiting_code, waiting_time, waiting_location, waiting_type')
            ->get()
            ->result();
    }

    public function findById($waitingId)
    {
        $this->db->select("*")
            ->from($this->table)
            ->where("waiting_id", $waitingId);
        return $this->db->get()->row();
    }

    public function getPeriodeListByActiveYear()
    {
        return $this->db
            ->distinct()
            ->select("
                periode_id
                , periode_name
                , periode_monthName
                , periode_year
                , periode_created_at
            ")
            ->from($this->table)
            ->join('periode', 'periode_id')
            ->join('tahun_akademik', 'thnAkademik_id')
            ->where('thnAkademik_active', 1)
            ->where("waiting_isfinish", 0)
            ->order_by('periode_created_at', 'desc')
            ->get()
            ->result();
    }
}