<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OpenAPI extends RestAPI {

    function __construct()
    {
        parent::__construct();
    }
    
    function index(){
        $this->load->model("M_APIControl","mAPIControl");

        $this->methodPOST();
        $form = $this->input->post();

        $isMissing = 0;

        if(isset($form['old_token']) && isset($form['refresh_token'])){
            if($form['old_token'] == "" || $form['refresh_token'] == ""){
                $isMissing = 1;
            }
        }else{
            $isMissing = 1;
        }

        if($isMissing == 0){
            $result = $this->mAPIControl->findByUnique2($form['old_token'], $form['refresh_token']);
            if($result){
                $this->response(200, ['status' => 200,'message' => 'Success load data', 'data' => $result]);
            }else{
                $this->response(403, ['status' => 403,'message' => 'Forbidden access, failed authentication']);
            }
        }else{
            $this->response(400, ['status' => 400,'message' => 'Bad request, missing some field']);
        }
    }

    function requestOTP(){
        $this->methodPOST()->withAPI();
        $form = $this->input->post();
        $key = $this->input->get('key');
        $isMissing = 0;

        if(isset($form['id'])){
            $id = $form['id'];
            if($id == ""){
                $isMissing = 1;
            }
        }else{
            $isMissing = 1;
        }
        if($isMissing == 1){
            $this->response(400, ['status' => 400,'message' => 'Bad request, missing some field']);
        }else{
            $this->load->model("M_APIOTP", "mOTP");
            $randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, 8);
            $otp = $this->mOTP->findByParentId($id);
            if($otp){
                $data['otp_code'] = $randomString;
                $data['otp_updated_at'] = date('Y-m-d H:i:s', time());
                $result = $this->mOTP->updateRow($data, $id);
                if($result){
                    $otp = $this->mOTP->findByParentId($id);
                    $this->response(200, ['status' => 200,'message' => 'This otp code is only available for short time', 'data' => $otp]);
                }else{
                    $this->response(500, ['status' => 500,'message' => 'Internal Server Error']);
                }
            }else{
                $data['siswa_id'] = $id;
                $data['otp_code'] = $randomString;
                $result = $this->mOTP->createRow($data);
                if($result){
                    $otp = $this->mOTP->findByParentId($id);
                    $this->response(200, ['status' => 200,'message' => 'This otp code is only available for short time', 'data' => $otp]);
                }else{
                    $this->response(500, ['status' => 500,'message' => 'Internal Server Error']);
                }
            }
            
        }
    }
}