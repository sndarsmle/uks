<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * perform controll Periode data
 * @property mixed $input service to get input variable from codeigniter 3
 * @property mixed $load service to register module from codeigniter 3
 * @property M_Periode $mPeriode model tahun_akademik based on codeigniter model
 */
class Periode extends Middleware
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('thakademik/M_Periode', 'mPeriode');
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
            if (!is_numeric($post['status'])) {
                $isMissing = true;
            }
            if ($isMissing) {
                http_response_code(400);
                $response = ['status' => false, 'msg' => 'bad request'];
            } else {
                $status = $post['status'] == 1 ? '0' : '1';
                $param['periode_id'] = $post['id'];
                $data['periode_active'] = $status;
                $update = $this->mPeriode->update($param, $data);
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
    public function update(): void
    {
        $post = $this->input->post();
        if ($post) {
            $isMissing = false;
            if (empty($post['id'])) {
                $isMissing = true;
            }
            if (empty($post['periode'])) {
                $isMissing = true;
            }
            if (empty($post['month'])) {
                $isMissing = true;
            }
            if (empty($post['year'])) {
                $isMissing = true;
            }
            if ($isMissing) {
                http_response_code(400);
                $response = ['status' => false, 'msg' => 'bad request'];
            } else {
                $param['periode_id'] = $post['id'];
                $data['periode_name'] = $post['periode'];
                $data['periode_monthName'] = $post['month'];
                $data['periode_year'] = $post['year'];
                $update = $this->mPeriode->update($param, $data);
                if ($update) {
                    http_response_code(200);
                    $response = ['status' => true, 'msg' => 'success update row'];
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
}