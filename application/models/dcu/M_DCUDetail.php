<?php

class M_DCUDetail extends CI_model
{
    private $table = "dcu_detail";

    function createRow($Data){
        $DCU = [
            'dcu_id' => $Data['form_id'],
            'dcuDetail_oklusi' => $Data['form_oklusi'],
            'dcuDetail_muklosa' => $Data['form_mukosa'],
            'dcuDetail_d' => $Data['form_d'],
            'dcuDetail_m' => $Data['form_m'],
            'dcuDetail_f' => $Data['form_f'],
            'dcuDetail_freq_sikat' => $Data['form_freq_sikat'],
            'dcuDetail_waktu_sikat' => $Data['form_wkt_sikat'],
            'dcuDetail_pasta' => $Data['form_pasta'],
            'dcuDetail_manis' => $Data['form_makan_manis'],
            'dcuDetail_di' => $Data['form_di_skor'],
            'dcuDetail_di1' => $Data['form_di1'],
            'dcuDetail_di2' => $Data['form_di2'],
            'dcuDetail_di3' => $Data['form_di3'],
            'dcuDetail_di4' => $Data['form_di4'],
            'dcuDetail_di5' => $Data['form_di5'],
            'dcuDetail_di6' => $Data['form_di6'],
            'dcuDetail_ci' => $Data['form_ci_skor'],
            'dcuDetail_ci1' => $Data['form_ci1'],
            'dcuDetail_ci2' => $Data['form_ci2'],
            'dcuDetail_ci3' => $Data['form_ci3'],
            'dcuDetail_ci4' => $Data['form_ci4'],
            'dcuDetail_ci5' => $Data['form_ci5'],
            'dcuDetail_ci6' => $Data['form_ci6'],
            'dcuDetail_ohis' => $Data['form_ohis_skor'],
            'dcuDetail_ohis_status' => $Data['form_ohis_status'],
            'dcuDetail_Kettambahan' => $Data['dcuDetail_Kettambahan'],

        ];
        $result = $this->db->insert($this->table, $DCU);
        return $result;
    }

    function getID($Data){
        $DCU = [
            'dcu_oklusi' => $Data['form_oklusi'],
            'dcu_muklosa' => $Data['form_mukosa'],
            'dcu_freq_sikat' => $Data['form_freq_sikat'],
            'dcu_waktu_sikat' => $Data['form_wkt_sikat'],
            'dcu_pasta' => $Data['form_pasta'],
            'dcu_manis' => $Data['form_makan_manis'],
            'dcu_di' => $Data['form_di_skor'],
            'dcu_di1' => $Data['form_di1'],
            'dcu_di2' => $Data['form_di2'],
            'dcu_di3' => $Data['form_di3'],
            'dcu_di4' => $Data['form_di4'],
            'dcu_di5' => $Data['form_di5'],
            'dcu_di6' => $Data['form_di6'],
            'dcu_ci' => $Data['form_ci_skor'],
            'dcu_ci1' => $Data['form_ci1'],
            'dcu_ci2' => $Data['form_ci2'],
            'dcu_ci3' => $Data['form_ci3'],
            'dcu_ci4' => $Data['form_ci4'],
            'dcu_ci5' => $Data['form_ci5'],
            'dcu_ci6' => $Data['form_ci6'],
            'dcu_ohis' => $Data['form_ohis_skor'],
            'dcu_ohis_status' => $Data['form_ohis_status'],
            'dcuDetail_Kettambahan' => $Data['dcuDetail_Kettambahan'],
            'dcu_tgl' => $Data['form_tgl'],
            'dcu_dokter' =>$Data['form_dokter'],
        ];
        $this->db->select("dcu_id")
                ->from($this->table)
                ->where($DCU);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0];
        }
        return $result;
    }

    function updateRow($Data){
        $DCU = [
            'dcuDetail_oklusi' => $Data['form_oklusi'],
            'dcuDetail_muklosa' => $Data['form_mukosa'],
            'dcuDetail_d' => $Data['form_d'],
            'dcuDetail_m' => $Data['form_m'],
            'dcuDetail_f' => $Data['form_f'],
            'dcuDetail_freq_sikat' => $Data['form_freq_sikat'],
            'dcuDetail_waktu_sikat' => $Data['form_wkt_sikat'],
            'dcuDetail_pasta' => $Data['form_pasta'],
            'dcuDetail_manis' => $Data['form_makan_manis'],
            'dcuDetail_di' => $Data['form_di_skor'],
            'dcuDetail_di1' => $Data['form_di1'],
            'dcuDetail_di2' => $Data['form_di2'],
            'dcuDetail_di3' => $Data['form_di3'],
            'dcuDetail_di4' => $Data['form_di4'],
            'dcuDetail_di5' => $Data['form_di5'],
            'dcuDetail_di6' => $Data['form_di6'],
            'dcuDetail_ci' => $Data['form_ci_skor'],
            'dcuDetail_ci1' => $Data['form_ci1'],
            'dcuDetail_ci2' => $Data['form_ci2'],
            'dcuDetail_ci3' => $Data['form_ci3'],
            'dcuDetail_ci4' => $Data['form_ci4'],
            'dcuDetail_ci5' => $Data['form_ci5'],
            'dcuDetail_ci6' => $Data['form_ci6'],
            'dcuDetail_ohis' => $Data['form_ohis_skor'],
            'dcuDetail_ohis_status' => $Data['form_ohis_status'],
            'dcuDetail_Kettambahan' => $Data['dcuDetail_Kettambahan'],
        ];
        $this->db->where("dcu_id", $Data['form_id']);
        $result = $this->db->update($this->table, $DCU);
        return $result;
    }

    function findByParentId($dcuID){
        $this->db->select("*")
                ->from($this->table)
                ->where("dcu_id", $dcuID);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0];
        }
        return $result;
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
}