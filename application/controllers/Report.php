<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('m_auth', 'auth');
        $this->load->library('form_validation');
        $this->load->model('m_user');
        $this->load->model('M_activity');
        $this->auth->curl_login();
    }

    public function index()
    {
        $data['image'] = $this->m_user->curl_image();
        $data['data_user'] = $this->session->userdata(['data'][0]);
        $data['data_user_detail'] = $this->session->userdata(['detail'][0]);
        $data['sidebar'] = config_sidebar();
        $data['title'] = 'Internship Report';
        $data['note'] = 'Hallo! Untuk mendapatkan laporan magang, harap selesaikan jadwal magang mu terlebih dahulu ya.';


        $this->load->view('theme/metronic/header');
        $this->load->view('theme/metronic/sidebar', $data);
        $this->load->view('theme/metronic/topbar');
        if ($data['data_user_detail']['_resign_date'] !== date('Y-m-d')) {
            $this->load->view('template/template-view/report-before', $data);
        }
        if ($data['data_user_detail']['_resign_date'] == date('Y-m-d')) {
            $this->load->view('template/template-view/report-after', $data);
        }
        $this->load->view('theme/metronic/footer');
    }

    public function print()
    {
        $data_user = $this->session->userdata(['data'][0]);
        $data_user_detail = $this->session->userdata(['detail'][0]);
        $data_actvity = $this->M_activity->get_activity($data_user['ID'])->result_array();
        $data_pdf = array(
            'name'      => $data_user_detail['name'],
            'content'   => $data_actvity,
            'batch'     => '4',
            'id_user'   => $data_user_detail['ID'],
        );
        $config_mpdf = array(
            'format'        => 'a4',
            'position'      => 'P',
            'margin_left'   => 5,
            'margin_right'  => 5,
            'margin_top'    => 5,
            'margin_bottom' => 5,
            'margin_header' => 10,
            'margin_footer' => 10,
            'content'     => array(
                array(
                    'location'     => 'template/template-pdf/report-cover-pdf',
                    'data'         => $data_pdf
                ),
                array(
                    'location'     => 'template/template-pdf/report-content-pdf',
                    'data'         => $data_pdf
                ),
            ),
        );

        mpdf_setting($config_mpdf);
    }
}
