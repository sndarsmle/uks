<?php
class RestAPI extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_APIControl", "mAPIControl");
    }

    function response($code, $data){
        http_response_code($code);
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function withAPI(){
        if(!isset($_GET['key'])){
            $this->response(403,['status' => 403,'message' => 'Api key is required']);
            exit;
        }else{
            $key = $this->input->get('key');
            $result = $this->mAPIControl->findByUnique($key);
            if(!$result){
                $this->response(401,['status' => 401,'message' => 'Unauthorized access, please renew your key']);
                exit;
            }
        }
        return $this;
    }

    function methodPOST(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            $this->response(405,['status' => 405,'message' => 'Method not allowed']);
            exit;
        }
        return $this;
    }

    function methodGET(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
            $this->response(405,['status' => 405,'message' => 'Method not allowed']);
            exit;
        }
        return $this;
    }
}
