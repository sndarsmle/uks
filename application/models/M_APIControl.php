<?php

class M_APIControl extends CI_model
{
    private $table = "api_client";

    function createRow($Data){
        $API = [
            "client" => $Data['form_client'],
            "client_ip" => $Data['form_clientip'],
            "client_token" => $Data['form_clienttoken'],
            "client_description" => $Data['form_clientdesc']
        ];

        $result = $this->db->insert($this->table, $API);
        return $result;
    }

    function findByUnique($token){
        $this->db->select("client_id, client_status")
                ->from($this->table)
                ->where("client_token", $token)
                ->where("client_status", 1);
        return $this->db->get()->row();
    }

    function findByUnique2($token, $refresh){
        $this->db->select("client as client_name, client_token, client_description as client_access")
                ->from($this->table)
                ->where("client_status", 1)
                ->where("client_oldToken", $token)
                ->where("client_id", $refresh);
        return $this->db->get()->row();
    }

    function findById($clientID){
        $this->db->select("*")
                ->from($this->table)
                ->where("client_id", $clientID);
        return $this->db->get()->row();
    }

    function showAll(){
        $this->db->select("client_id, client, client_ip, client_token, client_description")
                ->from($this->table)
                ->order_by('client', 'ASC');
        return $this->db->get()->result();
    }

    function updateRow($Data, $clientID){
        $API = [
            "client" => $Data['form_client'],
            "client_ip" => $Data['form_clientip'],
            "client_description" => $Data['form_clientdesc']
        ];
        $this->db->where("client_id", $clientID);
        return $this->db->update($this->table, $API);
    }

    function updateStatus($Data){
        $this->db->where("client_id", $Data['form_id'])
                ->set("client_status", $Data['form_status']);
        return $this->db->update($this->table);
    }

    function updateToken($Data, $clientID){
        $this->db->where("client_id", $clientID);
        return $this->db->update($this->table, $Data);
    }
}
