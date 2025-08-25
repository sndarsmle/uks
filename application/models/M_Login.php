<?php

class M_Login extends CI_model
{
    private $table = 'user';
    private $tableDokter = 'dokter';
    private const DOKTER = 1;
    private const UKS = 0;
    
    function login($Data, $mode)
    {
        if($mode == self::DOKTER){
            $this->db->select("dokter_fullname as nama_user, dokter_id as user_id, 3 as user_role, dokter_password as user_password")
            ->from($this->tableDokter)
            ->where("dokter_username", $Data['username']);
        }else{
            $this->db->select("*")
            ->from($this->table)
            ->where("username", $Data['username']);
        }
        $User = $this->db->get()->result();
        if($User){
            $User = $User[0];
            if(password_verify($Data['password'], $User->user_password)){
                unset($User->user_password);
                $this->session->set_userdata( (array) $User);
                $this->session->set_userdata( ['skrining' => TRUE ] );
                
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function logout() {
        $this->session->sess_destroy();
    }

    function getNameUser(){
        return $this->session->userdata()['nama_user'];
    }
    
    function getUserID(){
        return $this->session->userdata()['user_id'];
    }

    function getUserRole()
    {
        return $this->session->userdata()['user_role'];
    }

    function getUserClass(){
        return $this->session->userdata()['kelas_tingkat'].$this->session->userdata()['kelas_rombel'];
    }

    function isLogin()
    {
        if( count( $this->session->userdata() ) == 0 ){
            return FALSE;
        }else if( ! isset( $this->session->userdata['skrining'] ) ){
            return FALSE;
        }else if( $this->session->userdata['skrining']  ){
            return TRUE;
        } 
    }
}