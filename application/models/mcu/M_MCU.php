<?php

class M_MCU extends CI_model
{
    private $table = "mcu";

    function createRow($Data){
        $MCU = [
            'periode_id' => $Data['form_periode'],
            'siswa_id' => $Data['form_siswa'],
            'mcu_date' => $Data['form_tgl'],
            'mcu_location' => $Data['form_lokasi'],
            'mcu_ageY' => $Data['form_tahun'],
            'mcu_ageM' => $Data['form_bulan'],
            'mcu_code' => $Data['form_code'],
        ];
        $result = $this->db->insert($this->table, $MCU);
        return $result;
    }

    function updateRow($Data){
        $MCU = [
            'periode_id' => $Data['form_periode'],
            'siswa_id' => $Data['form_siswa'],
            'mcu_date' => $Data['form_tgl'],
            'mcu_location' => $Data['form_lokasi'],
            'mcu_ageY' => $Data['form_tahun'],
            'mcu_ageM' => $Data['form_bulan'],
            'mcu_code' => $Data['form_code'],
        ];
        $this->db->where("mcu_id", $Data['form_id']);
        $result = $this->db->update($this->table, $MCU);
        return $result;
    }

    function getRowId($Data){
        $MCU = [
            'periode_id' => $Data['form_periode'],
            'siswa_id' => $Data['form_siswa'],
            'mcu_date' => $Data['form_tgl'],
            'mcu_location' => $Data['form_lokasi'],
            'mcu_ageY' => $Data['form_tahun'],
            'mcu_ageM' => $Data['form_bulan'],            
            'mcu_code' => $Data['form_code'],
        ];
        $this->db->select("mcu_id")
                ->from($this->table)
                ->where($MCU);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0]->mcu_id;
        }
        return $result;
    }

    function isExist($Data){
        $MCU = [
            'periode_id' => $Data['form_periode'],
            'siswa_id' => $Data['form_siswa'],           
        ];
        $this->db->select("mcu_id")
                ->from($this->table)
                ->where($MCU);
        return $this->db->get()->result();
    }

    function findById($mcuID){
        $this->db->select("*, concat(periode.periode_monthName,' ', periode.periode_year) as periode_nameCC")
                ->from($this->table)
                ->join("periode", "mcu.periode_id = periode.periode_id")
                ->join("tahun_akademik", "thnAkademik_id", "LEFT")
                ->where("mcu_id", $mcuID);
        return $this->db->get()->row();
    }

    function countRowByDate($date){
        $this->db->select("count(mcu_id) as rowCount")
                ->from($this->table)
                ->where("mcu_date", $date);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0]->rowCount;
        }
        return $result;
    }

    function showAll(){
        $this->db->select("*")
                ->from($this->table)
                ->where("mcu_active", 0)
                ->order_by("thnAkademik_yearstart", "DESC");
        return $this->db->get()->result();
    }

    function showNotActiveRow(){
        $this->db->select("DATE_FORMAT(mcu_created_at, '%H : %i , %d - %m - %Y') as mcu_registerTime, siswa.siswa_nama, periode_monthName, periode_year, periode_name, CONCAT(kelas_tingkat, kelas_rombel) as siswa_kelas, mcu.*")
                ->from($this->table)
                ->join("siswa","siswa_id","LEFT")
                ->join("kelas","siswa_id","LEFT")
                ->join("periode","periode_id","LEFT")
                ->where("mcu_isfinish", 0)
                ->order_by("mcu_created_at", "ASC");
        return $this->db->get()->result();
    }

    function updateDate($post){ 
        $this->db->set("mcu_date", $post['form_tgl'])
                ->where("mcu_id", $post['form_id']);
        return $this->db->update($this->table);
    }

    function deleteRow($rowID)
    {
        $this->db->where('thnAkademik_id', $rowID);
        return $this->db->delete($this->table);
    }

    function findByIdAllDataSMP($mcuID){
        $this->db->select("*")
                ->from($this->table)
                ->join("siswa","mcu.siswa_id = siswa.siswa_id","LEFT")
                ->join('kelas', 'mcu.siswa_id = kelas.siswa_id', 'LEFT')
                ->join("mcu_bersihsmp","mcu_id","LEFT")
                ->join("mcu_gizi_smp","mcu_id","LEFT")
                ->join("mcu_matatelingasmp","mcu_id","LEFT")
                ->join("mcu_mulutsmp","mcu_id","LEFT")
                ->join("mcu_vitalsmp","mcu_id","LEFT")
                ->join("mcu_lainsmp","mcu_id","LEFT")
                ->join("periode", "mcu.periode_id = periode.periode_id")
                ->where("mcu_id", $mcuID);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0];
        }
        return $result;
    }

    function findByIdAllDataSD($mcuID){
        $this->db->select("*")
                ->from($this->table)
                ->join("siswa","mcu.siswa_id = siswa.siswa_id","LEFT")
                ->join('kelas', 'mcu.siswa_id = kelas.siswa_id', 'LEFT')
                ->join("mcu_gizi_sd","mcu_id","LEFT")
                ->join("mcu_matatelingasd","mcu_id","LEFT")
                ->join("mcu_mulut_sd","mcu_id","LEFT")
                ->join("mcu_umum_sd","mcu_id","LEFT")
                ->join("mcu_lainsd","mcu_id","LEFT")
                ->join("periode", "mcu.periode_id = periode.periode_id")
                ->where("mcu_id", $mcuID);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0];
        }
        return $result;
    }

    function findByIdAllDataDckbtk($mcuID){
        $this->db->select("*")
                ->from($this->table)
                ->join("siswa","mcu.siswa_id = siswa.siswa_id","LEFT")
                ->join('kelas', 'mcu.siswa_id = kelas.siswa_id', 'LEFT')
                ->join("mcu_gizi_dckbtk","mcu_id","LEFT")
                ->join("mcu_matatelingadckbtk","mcu_id","LEFT")
                ->join("mcu_mulut_dckbtk","mcu_id","LEFT")
                ->join("mcu_umum_dckbtk","mcu_id","LEFT")
                ->join("mcu_laindckbtk","mcu_id","LEFT")
                ->join("periode", "mcu.periode_id = periode.periode_id")
                ->where("mcu_id", $mcuID);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0];
        }
        return $result;
    }

    function UpdateStatusFinish($data){
        $this->db->set("dokter_id", $data['form_admin'])
                ->set("mcu_isfinish", "1")
                ->where("mcu_id", $data['form_id']);
        return $this->db->update($this->table);
    }

    public function findByIdAllDataSMA($mcu_id)
    {
        return $this->db
            ->select("*")
            ->from($this->table)
            ->join("siswa", "mcu.siswa_id = siswa.siswa_id", "LEFT")
            ->join('kelas', 'mcu.siswa_id = kelas.siswa_id', 'LEFT')
            ->join("mcu_bersihsma", "mcu_id", "LEFT")
            ->join("mcu_gizi_sma", "mcu_id", "LEFT")
            ->join("mcu_matatelingasma", "mcu_id", "LEFT")
            ->join("mcu_mulutsma", "mcu_id", "LEFT")
            ->join("mcu_vitalsma", "mcu_id", "LEFT")
            ->join("mcu_lainsma", "mcu_id", "LEFT")
            ->join("periode", "mcu.periode_id = periode.periode_id")
            ->where("mcu_id", $mcu_id)
            ->get()
            ->row();
    }
}