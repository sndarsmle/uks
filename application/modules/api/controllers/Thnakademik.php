<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * perform controll Thn Akademik data
 * @property mixed $input service to get input variable from codeigniter 3
 * @property mixed $load service to register module from codeigniter 3
 * @property M_Thakademik $mAkademik model tahun_akademik based on codeigniter model
 */
class Thnakademik extends Middleware
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('thakademik/M_Thakademik', 'mAkademik');
    }

    /**
     * @return void
     */
    public function switch(): void
    {
        $post = $this->input->post();
        if ($post) {
            $isMissing = false;
            if (empty($post['id'])) {
                $isMissing = true;
            }
            if ($isMissing) {
                http_response_code(400);
                $response = ['status' => false, 'msg' => 'bad request'];
            } else {
                $param['thnAkademik_active'] = 1;
                $data['thnAkademik_active'] = 0;
                $this->mAkademik->update($param, $data);
                unset($param['thnAkademik_active']);
                unset($data['thnAkademik_active']);
                $param['thnAkademik_id'] = $post['id'];
                $data['thnAkademik_active'] = 1;
                $update = $this->mAkademik->update($param, $data);
                if ($update) {
                    http_response_code(200);
                    $response = ['status' => true, 'msg' => 'success activated row'];
                } else {
                    http_response_code(500);
                    $response = ['status' => true, 'msg' => 'failed activated row'];
                }
            }
        } else {
            http_response_code(405);
            $response = ['status' => false, 'msg' => 'method not allowed'];
        }
        echo json_encode($response);
    }

    /**
     * @return void
     */
    public function deleteRow(): void
    {
        if ($this->input->post()) {
            $row = $this->mAkademik->deleteRow($this->input->post('form_id'));
            if ($row) {
                http_response_code(200);
                $response = ['status' => true, 'msg' => 'success delete row'];
            } else {
                http_response_code(500);
                $response = ['status' => false, 'msg' => 'failed to delete row'];
            }
        } else {
            http_response_code(405);
            $response = ['status' => false, 'msg' => 'method not allowed'];
        }
        echo json_encode($response);
    }
}