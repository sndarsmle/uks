<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privateee extends Middleware {
    private $length = 30;

	function __construct()
	{
        parent::__construct();
        $this->load->model("M_APIControl", "mAPICtrl");
    }

    function index(){
        $this->response(404, ['status' => 404,'message' => 'Service not found']);
    }

    function updateStatus(){
        $this->methodPOST();
        $post = $this->input->post();
        if($post){
            $result = $this->mAPICtrl->updateStatus($post);
            if($result){
                $this->response(200, ['status' => 200,'message' => 'Berhasil']);
            }else{
                $this->response(500, ['status' => 500,'message' => 'Internal server error']);
            }
        }else{
            $this->response(400, ['status' => 400,'message' => 'Bad request']);
        }
    }

    function newToken(){
        $this->methodPOST();
        $post = $this->input->post();
        if($post){
            $clientID = $post['form_id'];
            $old = $this->mAPICtrl->findById($clientID);
            if($old){
                $newToken = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($this->length/strlen($x)) )),1,$this->length);
                $new['client_token'] = $newToken;
                $new['client_oldToken'] = $old->client_token;

                $result = $this->mAPICtrl->updateToken($new, $clientID);
                if($result){
                    $this->response(200, ['status' => 200,'message' => 'Berhasil', 'newToken' => $newToken]);
                }else{
                    $this->response(500, ['status' => 500,'message' => 'Internal Server Error']);
                }
            }else{
                $this->response(403, ['status' => 403,'message' => 'Forbidden, unauthorized access']);
            }
        }else{
            $this->response(400, ['status' => 400,'message' => 'Bad request']);
        }
    }

}
