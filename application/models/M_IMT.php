<?php

class M_IMT extends CI_model{
    private $tableL = "imt_laki";
    private $tableP = "imt_perempuan";

    function getIMTPrediction($year, $month, $gender, $limit){
        $grafik = array();
        
        $umur = $year;
        for($i = 0 ; $i <= $limit; $i++){
            $umur += 1;
            if(($umur == 19) && ($month > 0)){
                break;
            }else{
                $this->db->select("*");
                if($gender == "L"){
                    $this->db->from($this->tableL);
                }else if ($gender == "P"){
                    $this->db->from($this->tableP);
                }
                $this->db->where("tahun_usia", $umur);
                $this->db->where("bulan_usia", $month);
                $this->db->limit(1);
                $grafik[$i] = $this->db->get()->row();
            }
        }
        return $grafik;
    }

    function findByUnique($year, $month, $gender){
        $this->db->select("*");
        if($gender){
            if($gender == "L"){
                $this->db->from($this->tableL);
            }else if ($gender == "P"){
                $this->db->from($this->tableP);
            }
        }
        $this->db->where("tahun_usia", $year);
        $this->db->where("bulan_usia", $month);
        return $this->db->get()->row();
    }
}