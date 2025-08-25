
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DcuDiag extends Middleware {

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Login', 'mLogin');
        $this->load->model('dcu/M_DCUDiag', 'mDCUDiag');
    }

    function deleteRow(){
        if($this->input->post()){
            $row = $this->mDCUDiag->deleteRow($this->input->post('form_id'));
            if ($row) {
                $response = array('status' => '1', 'msg' => '');
                echo json_encode($response);
            }else {
                $response = array('status' => '0', 'msg' => '');
                echo json_encode($response);
            } 
        }
    }
}