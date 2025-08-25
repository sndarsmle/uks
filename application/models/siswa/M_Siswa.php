<?php

class M_Siswa extends CI_model
{
    private $table = "siswa";

    function createRow($Data){
        $Siswa = [
            'siswa_id' => $Data->siswa_id,
            'siswa_nis' => $Data->siswa_nis,
            'siswa_nama' => $Data->siswa_nama_full,
            'siswa_kelamin' => $Data->siswa_kelamin,
            'siswa_tgl_lahir' => $Data->siswa_tgl_lhr,
            'siswa_jenjang' => $Data->jenjang,
            'siswa_angkatan' => $Data->siswa_angkatan,
        ];
        $result = $this->db->insert($this->table, $Siswa);
        return $result;
    }

    function isExist($siswaID){
        $this->db->select("siswa_id")
                ->from($this->table)
                ->where("siswa_id", $siswaID);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0];
        }
        return $result;
    }

    function findById($siswaID){
        $this->db->select("siswa.*, CONCAT(kelas_tingkat, kelas_rombel) as siswa_kelas,
                            TIMESTAMPDIFF( YEAR, siswa_tgl_lahir, NOW() ) as siswa_umurT, 
                            TIMESTAMPDIFF( MONTH, siswa_tgl_lahir, NOW() ) % 12 as siswa_umurB")
                ->from($this->table)
                ->join('kelas', 'siswa_id', 'LEFT')
                ->where("siswa_id", $siswaID)
                ->order_by('kelas_ta', 'DESC')
                ->limit(1);
        return $this->db->get()->row();
    }

    function findByIdAndParentId($siswaID, $thnAkademikId){
        $this->db->select("thnAkademik_year");
        $this->db->from("tahun_akademik");
        $this->db->where("thnAkademik_id", $thnAkademikId);
        $thnAkademik = $this->db->get_compiled_select();

        $this->db->select("
                    *
                    , TIMESTAMPDIFF( YEAR, siswa_tgl_lahir, NOW() ) as siswa_umurT
                    , TIMESTAMPDIFF( MONTH, siswa_tgl_lahir, NOW() ) % 12 as siswa_umurB
                ")
                ->from($this->table)
                ->join('kelas', 'siswa_id', 'LEFT')
                ->where("siswa_id", $siswaID)
                ->where("kelas_ta", "(".$thnAkademik.")", false);
        return $this->db->get()->row();
    }

    function findByIdd($siswaID){
        $this->db->select("siswa.*, CONCAT(kelas_tingkat, kelas_rombel) as siswa_kelas,
                            TIMESTAMPDIFF( YEAR, siswa_tgl_lahir, NOW() ) as siswa_umurT, 
                            TIMESTAMPDIFF( MONTH, siswa_tgl_lahir, NOW() ) % 12 as siswa_umurB")
                ->from($this->table)
                ->join('kelas', 'siswa_id', 'LEFT')
                ->where("siswa_id", $siswaID);
        $result = $this->db->get()->result();
        // if($result){
        //     $result = $result[0];
        // }
        return $result;
    }

    function findByNis($niss){
        $this->db->select("coba_siswa.*, CONCAT(kelas_tingkat, kelas_rombel) as kelas")
                ->from($this->table)
                ->join('kelas', 'siswa_id = idsiswa', 'LEFT')
                ->where("nis", $niss);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0];
        }
        return $result;
    }

    function showByUnique($name, $jenjang){
        $this->db->select("siswa_id, siswa_nis, siswa_nama");
        $this->db->from($this->table);
        $this->db->like("siswa_nama", $name);
        if($jenjang == 22){
            $this->db->group_start();
            $this->db->where("siswa_jenjang", $jenjang);
            $this->db->or_where("siswa_jenjang", 11);
            $this->db->group_end();
        }else{
            $this->db->where("siswa_jenjang", $jenjang);
        }
        return $this->db->get()->result();
    }

    function getByKelas($param)
    {
        return $this->db
            ->select('siswa.siswa_id
                    , siswa.siswa_nis
                    , siswa.siswa_nama')
            ->from($this->table)
            ->join("kelas", "siswa.siswa_id = kelas.siswa_id")
            ->where([
                "siswa.siswa_status" => 1,
                "kelas.kelas_tingkat" => $param['kelas_tingkat'],
                "kelas.kelas_rombel" => $param['kelas_rombel'],
                "siswa.siswa_jenjang" => $param['jenjang']
            ])
            ->where("kelas.kelas_ta = (SELECT thnAkademik_year FROM tahun_akademik WHERE thnAkademik_id = '".$param['thnAkademik_id']."')")
            ->order_by("siswa.siswa_nama ASC")
            ->get()
            ->result();
    }

    public function getAll()
    {
        return $this->db
            ->from($this->table)
            ->get()
            ->result_object()
        ;
    }

    public function get($siswa_id)
    {
        return $this->db
            ->from($this->table)
            ->where("{$this->table}.siswa_id", $siswa_id)
            ->get()
            ->row_object()
        ;
    }

    public function update($siswa_id, $data)
    {
        $this->db->trans_start();

        $this->db->update($this->table, $data, ["siswa_id" => $siswa_id]);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function getSummarySiswa($params)
    {
        return $this->db
            ->select("
                {$this->table}.siswa_id
                , {$this->table}.siswa_nis AS nis
                , {$this->table}.siswa_nama AS nama
                , CONCAT(kelas.kelas_tingkat, kelas.kelas_rombel) AS kelas
                , {$this->table}.siswa_kelamin AS kelamin
                , TIMESTAMPDIFF(YEAR, {$this->table}.siswa_tgl_lahir, NOW()) AS siswa_umurTahun
                , TIMESTAMPDIFF(MONTH, {$this->table}.siswa_tgl_lahir, NOW()) % 12 AS siswa_umurBulan")
            ->from($this->table)
            ->join("kelas", "{$this->table}.siswa_id = kelas.siswa_id")
            ->where([
                "{$this->table}.siswa_status" => 1,
                "{$this->table}.siswa_jenjang" => $params['jenjang'],
                "kelas.kelas_tingkat" => $params['kelas_tingkat'],
                "kelas.kelas_rombel" => $params['kelas_rombel'],
                "kelas.kelas_ta" => $params['thnAkademik_year'],
            ])
            ->order_by("{$this->table}.siswa_nama ASC")
            ->get()
            ->result_object();
    }
}