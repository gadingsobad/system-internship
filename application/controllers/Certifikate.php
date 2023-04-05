<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Certifikate extends CI_Controller
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
        $data['title'] = 'Internship Certifikate';
        $data['note'] = 'Hallo! Untuk mendapatkan sertifikat magang, harap selesaikan jadwal magang mu terlebih dahulu ya.';

        $this->load->view('theme/metronic/header');
        $this->load->view('theme/metronic/sidebar', $data);
        $this->load->view('theme/metronic/topbar');
        if ($data['data_user_detail']['_resign_date'] !== date('Y-m-d')) {
            $this->load->view('template/template-view/certivicate-before', $data);
        }
        if ($data['data_user_detail']['_resign_date'] == date('Y-m-d')) {
            $this->load->view('template/template-view/certivicate-after', $data);
        }
        $this->load->view('theme/metronic/footer');
    }

    public function print()
    {
        $data_user_detail = $this->session->userdata(['detail'][0]);
        $data_pdf = array(
            'data_user' => $data_user_detail,
            'batch'     => '4',

        );
        $config_mpdf = array(
            'format'        => 'a4',
            'position'      => 'L',
            'output_name'   => 'Sertifikat Magang',
            'margin_left'   => 5,
            'margin_right'  => 5,
            'margin_top'    => 0,
            'margin_bottom' => 5,
            'margin_header' => 10,
            'margin_footer' => 10,
            'background_content' => "assets/metronic-v7/media/solo-abadi/background-sertifikat-min.png",
            'content'     => array(
                array(
                    'location'     => 'template/template-pdf/certificate-pdf',
                    'data'         => $data_pdf
                ),
            ),
        );

        mpdf_setting($config_mpdf);
    }
}
