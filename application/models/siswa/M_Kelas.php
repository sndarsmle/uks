<?php

class M_Kelas extends CI_model
{
    private $table = "kelas";

    function createRow($data){
        $kelasSiswa = [
            'siswa_id' => $data->siswa_id,
            'kelas_tingkat' => $data->kelas_tingkat_nama,
            'kelas_rombel' => $data->rombel_nama,
            'kelas_ta' => $data->ta_mulai,
        ];
        $result = $this->db->insert($this->table, $kelasSiswa);
        return $result;
    }

    public function update($kelas_id, $data): bool
    {
        $this->db->trans_start();
        $this->db->update($this->table, $data, ["kelas_id" => $kelas_id]);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function find($params)
    {
        return $this->db
            ->select()
            ->from($this->table)
            ->where($params)
            ->get()
            ->row_object()
        ;
    }

    public function filter($params)
    {
        return $this->db->select()
            ->from($this->table)
            ->where($params)
            ->order_by('kelas_ta', 'DESC')
            ->get()
            ->result_object()
        ;
    }

    function isExist($data){
        $this->db->select("kelas_id")
                ->from($this->table)
                ->where("siswa_id", $data->siswa_id)
                ->where("kelas_ta", $data->ta_mulai);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0];
        }
        return $result;
    }

    function getListKelas(){
        return $this->db->distinct()
            ->select("siswa.siswa_jenjang, kelas.kelas_tingkat, kelas.kelas_rombel")
            ->from($this->table)
            ->join("siswa", "{$this->table}.siswa_id = siswa.siswa_id")
            ->join("tahun_akademik", "kelas.kelas_ta = tahun_akademik.thnAkademik_year")
            ->where("tahun_akademik.thnAkademik_active", 1)
            ->order_by("siswa.siswa_jenjang ASC, {$this->table}.kelas_tingkat ASC, {$this->table}.kelas_rombel ASC")
            ->get()
            ->result();
    }
}