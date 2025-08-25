<?php

class M_Minggu extends CI_model
{

    function createRow($Data){
        $Minggu = [
            'minggu_mulai' => $Data['form_nama_jadwal'],
            'minggu_selesai' => $Data['form_jadwal_mulai'],
            'minggu_jadwal' => $Data['form_jadwal_selesai'],
        ];
        $result = $this->db->insert('minggu', $Minggu);
        return $result;
    }

    function findByActive(){
        $this->db->select("minggu_id, DATE_FORMAT(minggu_mulai, '%d - %m - %Y') as minggu_mulai, DATE_FORMAT(minggu_selesai, '%d - %m - %Y') as minggu_selesai");
        $this->db->from("minggu");
        $this->db->where("minggu_active", 1);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0];
        }
        return $result;
    }

    function isValid(){
        $this->db->select("IF((minggu_jadwal <= CURRENT_DATE()) && (minggu_mulai >= CURRENT_DATE()), 1, 0) as isValid");
        $this->db->from("minggu");
        $this->db->where("minggu_active", 1);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0];
        }
        return $result->isValid;
    }

    function findById($mingguID){
        $this->db->select("minggu_id, DATE_FORMAT(minggu_mulai, '%d - %m - %Y') as minggu_mulai, DATE_FORMAT(minggu_selesai, '%d - %m - %Y') as minggu_selesai");
        $this->db->from("minggu");
        $this->db->where("minggu_id", $mingguID);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0];
        }
        return $result;
    }
    function showAll(){
        $this->db->select("minggu_id,  DATE_FORMAT(minggu_jadwal, '%d - %m - %Y') as fminggu_jadwal,minggu_jadwal,  minggu_mulai, minggu_selesai, DATE_FORMAT(minggu_mulai, '%d - %m - %Y') as fminggu_mulai, DATE_FORMAT(minggu_selesai, '%d - %m - %Y') as fminggu_selesai, minggu_active");
        $this->db->from("minggu");
        $this->db->order_by('minggu_jadwal', 'DESC');
        return $this->db->get()->result();
    }

    function updateRow2($mingguID, $status){
        $this->db->set("minggu_active", $status);
        $this->db->where("minggu_id", $mingguID);
        return $this->db->update("minggu");
    }

    function updateRow($Data){
        $this->db->set("minggu_jadwal", $Data['form_nama_jadwal']);
        $this->db->set("minggu_mulai", $Data['form_jadwal_mulai']);
        $this->db->set("minggu_selesai",$Data['form_jadwal_selesai']);
        $this->db->where("minggu_id", $Data['form_id']);
        return $this->db->update("minggu");
    }

    function getStatusOne($mingguID)
    {
        $this->db->select("minggu_active");
        $this->db->from('minggu');
        $this->db->where("minggu_id",$mingguID);
        $result= $this->db->get()->result();
        return $result;

    }
}