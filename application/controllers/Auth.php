<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //check_not_login();
        $this->load->model('m_auth', 'auth');
        $this->load->model('m_user');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/templates-login/header-login');
            $this->load->view('template/templates-login/content-login');
            $this->load->view('template/templates-login/footer-login');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->auth->curl_login($username, $password);

        $id = ($user[0]['ID']);
        $user_id = $this->auth->get_id($id);

        if ($user[0] > 0 && $user_id[0]['status'] == 7) {
            $data = [
                'data' => $user[0],
                'detail' => $user_id[0]
            ];
            $this->session->set_userdata($data);
            redirect('Activity/welcome');
        } elseif ($user[0] > 0 && $user_id[0]['status'] !== 7) {
            $this->session->set_flashdata('message', '<div class="d-flex flex-row-reverse"><div class="alert alert-danger animated fadeInDown mr-5 position-absolute">
            Anda tidak memiliki akses!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            </div>');
            redirect('auth');
        } elseif (empty($user[0])) {
            $this->session->set_flashdata('message', '<div class="d-flex flex-row-reverse"><div class="alert alert-danger animated fadeInDown mr-5 position-absolute">
                Username & Password  salah / Anda tidak terdaftar Program Interneship!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('data');
        $this->session->set_flashdata('message', '<div class="d-flex flex-row-reverse"><div class="alert alert-danger animated fadeInDown  position-absolute mr-5">
            Kamu Telah Logout!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            </div>');
        redirect('auth');
    }
}
