<?php

class M_DCU extends CI_model
{
    private $table = "dcu";

    function createRow($Data){
        $DCU = [
            'periode_id' => $Data['form_periode'],
            'siswa_id' => $Data['form_siswa'],
            'dcu_date' => $Data['form_tgl'],
            'dcu_location' => $Data['form_lokasi'],
            'dcu_ageY' => $Data['form_tahun'],
            'dcu_ageM' => $Data['form_bulan'],
            'dcu_code' => $Data['form_code'],
        ];
        $result = $this->db->insert($this->table, $DCU);
        return $result;
    }

    function updateRow($Data){
        $DCU = [
            'periode_id' => $Data['form_periode'],
            'siswa_id' => $Data['form_siswa'],
            'dcu_date' => $Data['form_tgl'],
            'dcu_location' => $Data['form_lokasi'],
            'dcu_ageY' => $Data['form_tahun'],
            'dcu_ageM' => $Data['form_bulan'],
            'dcu_code' => $Data['form_code'],
        ];
        $this->db->where("dcu_id", $Data['form_id']);
        $result = $this->db->update($this->table, $DCU);
        return $result;
    }

    function getRowId($Data){
        $DCU = [
            'periode_id' => $Data['form_periode'],
            'siswa_id' => $Data['form_siswa'],
            'dcu_date' => $Data['form_tgl'],
            'dcu_location' => $Data['form_lokasi'],
            'dcu_ageY' => $Data['form_tahun'],
            'dcu_ageM' => $Data['form_bulan'],            
            'dcu_code' => $Data['form_code'],
        ];
        $this->db->select("dcu_id")
                ->from($this->table)
                ->where($DCU);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0]->dcu_id;
        }
        return $result;
    }

    function isExist($Data){
        $DCU = [
            'periode_id' => $Data['form_periode'],
            'siswa_id' => $Data['form_siswa'],            
        ];
        $this->db->select("dcu_id")
                ->from($this->table)
                ->where($DCU);
        return $this->db->get()->result();
    }

    function findById($dcuID){
        $this->db->select("*")
                ->from($this->table)
                ->join("periode", "periode_id")
                ->where("dcu_id", $dcuID);
        return $this->db->get()->row();
    }

    function showAll(){
        $this->db->select("jadwal_mcu.id, jadwal_mcu.periode_mcu, COUNT(dcu_id) as jumlah_data")
                ->from($this->table)
                ->join('jadwal_mcu', 'jadwal_mcu.id = dcu.jadwal_id', 'LEFT')
                ->group_by('dcu_id');
        return $this->db->get()->result();
    }

    function showByParentId($jadwalID){
        $this->db->select("dcu_id, coba_siswa.nama, coba_siswa.nis, dcu.dcu_tgl, dcu.dcu_dokter, CONCAT(kelas_tingkat, kelas_rombel) as kelas")
                ->from($this->table)
                ->join('coba_siswa', 'siswa_id = coba_siswa.idsiswa', 'LEFT')
                ->join('kelas', 'kelas.siswa_id = coba_siswa.idsiswa', 'LEFT')
                ->where("jadwal_id", $jadwalID);
        return $this->db->get()->result();
    }

    function UpdateStatusFinish($data){
        $this->db->set("dokter_id", $data['form_admin'])
                ->set("dcu_isfinish", "1")
                ->where("dcu_id", $data['form_id']);
        return $this->db->update($this->table);
    }
}