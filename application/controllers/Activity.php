<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activity extends CI_Controller
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

    public function default_data()
    {
        $data = array(
            'ID' =>  '',
            'tittle' =>  '',
            'date' =>  '',
            'foto' =>  '',
            'foto2' =>  '',
            'foto3' =>  '',
            'foto4' =>  '',
            'divisi' =>  '',
            'pembimbing' =>  '',
            'link' =>  '',
            'detail' =>  '',
        );
        return $data;
    }

    public function welcome()
    {
        $data['data_user'] = $this->session->userdata(['data'][0]);
        $data['image'] = $this->m_user->curl_image();
        $this->load->view('template/template-view/welcome', $data);
    }

    public function index()
    {
        $config_search = $this->config_search();
        $config_card = $this->card_table();
        $config_table = $this->config_table();
        $table = data_table($config_table);
        $search = search($config_search);

        $pagination =  $this->pagination->create_links();
        $content = array(
            $search,
            $table,
            $pagination
        );
        $data['image'] = $this->m_user->curl_image();
        $data['data_user'] = $this->session->userdata(['data'][0]);
        $data['data_user_detail'] = $this->session->userdata(['detail'][0]);
        $data['card'] = card($config_card, $content);
        $data['sidebar'] = config_sidebar();
        $data['title'] = 'Data Activity';
        $this->load->view('theme/metronic/header');
        $this->load->view('theme/metronic/sidebar', $data);
        $this->load->view('theme/metronic/topbar');
        $this->load->view('theme/metronic/content', $data);
        $this->load->view('theme/metronic/footer');
    }

    public function config_search()
    {
        $data = array(
            array(
                'id'    => 'search',
                'name'  => 'search'
            ),
        );
        return $data;
    }

    public function card_table()
    {
        $data = array(
            array(
                'title'    => 'Data Activity',
                'action'    => 'Activity',
                // Optional Button
                'button' => array(
                    'button_link'      => 'Activity/form',
                    'button_title'    => 'Tambah Data',
                    'button_color'     => 'primary'
                ),
            )
        );
        return $data;
    }

    public function config_pagination()
    {
        $id = $this->session->userdata(['data'][0]);
        $total_row = $this->M_activity->count_data($id['ID']);
        $data = array(
            array(
                'base_url'   => base_url('Activity/index'),
                'total_rows' => $total_row,
                'per_page'  => 5,
            ),
        );
        return $data;
    }

    public function config_table()
    {
        $id = $this->session->userdata(['data'][0]);
        $start = $this->uri->segment(3);
        $perpage  = 5;
        $keyword = $this->input->post('search');
        $data_search = $this->M_activity->get_keyword($keyword, $perpage, $start,  $id['ID'])->result_array();
        $config_pagination = $this->config_pagination();
        $config = pagination($config_pagination);
        $this->pagination->initialize($config);

        $data_activity = $this->M_activity->get_data($perpage, $start,  $id['ID'])->result_array();

        $data['t_head'] = array(
            array(
                'NO',
                'Judul',
                'Tanggal',
                'Foto',
                'Divisi',
                'Pembimbing',
                'Link',
                'Detail',
                'Action',
            )
        );

        if ($data_search == '') {
            $data_table = $data_activity;
        } elseif ($data_search !== '') {
            $data_table = $data_search;
        }

        if (isset($data_table)) {
            foreach ($data_table as $index => $key) {

                $pembimbing = $this->M_activity->get_mentor_name($key['pembimbing']);
                $foto = $this->M_activity->get_foto($key['ID']);

                $divisi = $this->M_activity->get_divisi_name($key['divisi']);


                $config_dropdown_action = array(
                    array(
                        'button_link'      => 'Activity/form/' . $key['ID'],
                        'button_title'     => 'Edit',
                        'button_icon'      => 'far fa-edit'
                    ),
                    array(
                        'button_link'      => 'Activity/delete_data/' . $key['ID'],
                        'button_title'     => 'Hapus',
                        'button_icon'      => 'far fa-trash-alt'
                    )
                );

                $dropdown_action = dropdown_action($config_dropdown_action);

                $data['t_body'][$index] = array(
                    ++$start,
                    $key['tittle'],
                    $key['date'],
                    image($foto),
                    $divisi[0]['team_name'],
                    $pembimbing[0]['user_name'],
                    $key['link'],
                    $key['detail'],
                    $dropdown_action

                );
            }
        } else {
        }
        return $data;
    }

    public function form($id = '')
    {
        $config_form = $this->config_form($id);
        $config_card = $this->card_form($id);

        // Function View Helper
        $form = form($config_form);

        $data['title'] = "Activity Internship";
        $data['card'] = card($config_card, $form);
        $data['sidebar'] = config_sidebar();

        $data['image'] = $this->m_user->curl_image();
        $data['data_user'] = $this->session->userdata(['data'][0]);
        $data['data_user_detail'] = $this->session->userdata(['detail'][0]);

        // Base View
        $this->load->view('theme/metronic/header');
        $this->load->view('theme/metronic/sidebar', $data);
        $this->load->view('theme/metronic/topbar');
        $this->load->view('theme/metronic/content', $data);
        $this->load->view('theme/metronic/footer');
    }

    public function card_form($id)
    {
        $data = array(
            array(
                'title'    => 'Form Activity',
                'action'    =>  $id == '' ? 'Activity/add_data' : 'Activity/update_data',
                'button_save' => array(
                    'button_title'    => 'Save',
                    'button_color'     => 'success',
                    'button_action'      => '#',
                ),
                'button_cancel' => array(
                    'button_title'    => 'Cancel',
                    'button_color'     => 'danger',
                    'button_action'      => 'Activity',
                ),
            )
        );
        return $data;
    }

    public function config_form($id)
    {
        $default_data = $this->default_data();

        $where = @$id;
        $id = $this->session->userdata(['data'][0]);

        $data_args =  $this->M_activity->args_data($where)->result_array();

        if (is_array($data_args) && isset($data_args) && empty($data_args)) {
            $query = $default_data;
        } else {
            $query = $data_args;
        }

        $get_pembimbing = $this->M_activity->option_pembimbing();
        $get_divisi = $this->M_activity->option_divisi();

        foreach ($query as  $key) {
            $foto = $this->M_activity->get_foto($where);
            $data = array(
                array(
                    'column'    => 'col-lg-6',
                    'form' => array(
                        array(
                            'form_title'   => '', // Judul Form
                            'place_holder'  => '', // Isi PlaceHolder
                            'note'          => '', // Note form
                            'type'          => 'hidden',
                            'id'            => 'id_data',
                            'name'          => 'id_data',
                            'value'         =>  @$key['ID'],
                            'validation'    =>  'false',
                            'input-type'     => 'form'
                        ),
                        array(
                            'form_title'   => '', // Judul Form
                            'place_holder'  => '', // Isi PlaceHolder
                            'note'          => '', // Note form
                            'type'          => 'hidden',
                            'id'            => 'id_user',
                            'name'          => 'id_user',
                            'value'         =>   $id['ID'],
                            'validation'    =>  'false',
                            'input-type'     => 'form'
                        ),
                        array(
                            'form_title'   => 'Title', // Judul Form
                            'place_holder'  => 'Silahkan isi Judul Kegiatan', // Isi PlaceHolder
                            'note'          => '', // Note form
                            'type'          => 'text',
                            'id'            => 'title',
                            'name'          => 'title',
                            'validation'    =>  'false',
                            'value'         =>  @$key['tittle'],
                            'input-type'     => 'form'
                        ),
                        array(
                            'form_title'   => 'Tanggal ', // Judul Form
                            'place_holder'  => 'Silahkan isi nomor Tanggal Kegiatan', // Isi PlaceHolder
                            'note'          => '', // Note form
                            'type'          => 'date',
                            'id'            => 'date',
                            'name'          => 'date',
                            'value'         => @$key['date'],
                            'data'          => '',
                            'validation'    =>  'false',
                            'input-type'     => 'form'
                        ),
                        array(
                            'form_title'   => 'Pembimbing',
                            'place_holder'  => '',
                            'note'          => '',
                            'type'          => 'select',
                            'id'            => 'pembimbing',
                            'name'          => 'pembimbing',
                            'validation'    =>  'false',
                            'value'         =>  @$key['pembimbing'],
                            'content_id'    => 'user_id',
                            'content'       => 'user_name',
                            'data'          => $get_pembimbing,
                            'input-type'    => 'select'
                        ),
                        array(
                            'form_title'   => 'Divisi',
                            'place_holder'  => '',
                            'note'          => '',
                            'type'          => 'select',
                            'id'            => 'divisi',
                            'name'          => 'divisi',
                            'validation'    =>  'false',
                            'value'         =>  @$key['divisi'],
                            'content_id'    => 'team_id',
                            'content'       => 'team_name',
                            'data'          => $get_divisi,
                            'input-type'    => 'select'
                        ),
                        array(
                            'form_title'   => 'Link',
                            'place_holder'  => 'Jika di Upload di sosmed sertakan link disini',
                            'note'          => '',
                            'type'          => '',
                            'id'            => 'link',
                            'name'          => 'link',
                            'value'         => @$key['link'],
                            'validation'    =>  'false',
                            'input-type'     => 'text-area'
                        ),

                    ),
                ),
                array(
                    'column'    => 'col-lg-6',
                    'form' => array(
                        array(
                            'form_title'   => 'Upload Foto',
                            'place_holder'  => 'Upload Foto disini !',
                            'data'          => $foto,
                            'validation'    =>  'false',
                            'input-type'     => 'dropzone',
                            'note'          => 'Upload Foto Maksimal 4 file masing" kurang dari 100kb',
                        ),
                        array(
                            'form_title'    => 'Detail Kegiatan',
                            'place_holder'  => 'Ceritakan detail kegiatan mu disini',
                            'note'          => '',
                            'type'          => 'select',
                            'id'            => 'detail',
                            'name'          => 'detail',
                            'value'         => @$key['detail'],
                            'validation'    =>  'false',
                            'input-type'    => 'text-area'
                        ),
                    ),
                ),
            );
        }
        return $data;
    }

    public function dropzone_add()
    {
        if (!empty($_FILES)) {
            $tempFile = $_FILES['userfile']['tmp_name'];
            $fileName = $_FILES['userfile']['name'];
            $targetPath = getcwd() . '/upload-foto/';
            $targetFile = $targetPath . $fileName;
            move_uploaded_file($tempFile, $targetFile);
            $token = $this->input->post('token_foto');
            $this->db->insert('foto', array('content_id' => -1, 'filename' => $fileName, 'token' => $token));

            echo 'File Save Success';
        }
    }

    public function dropzone_remove()
    {
        $token = $this->input->post('token');
        $foto = $this->db->get_where('foto', array('token' => $token));
        if ($foto->num_rows() > 0) {
            $hasil = $foto->row();
            $nama_foto = $hasil->filename;
            if (file_exists($file = FCPATH . '/upload-foto/' . $nama_foto)) {
                unlink($file);
            }
            $this->db->delete('foto', array('token' => $token));
        }

        echo "File Deleted Success";
    }


    public function add_data()
    {
        $id = $this->input->post('id_data');
        $id_user = $this->input->post('id_user');
        $tittle = $this->input->post('title');
        $date = $this->input->post('date');
        $pembimbing = $this->input->post('pembimbing');
        $divisi = $this->input->post('divisi');
        $link = $this->input->post('link');
        $detail = $this->input->post('detail');

        $data = array(
            'id_user'       => $id_user,
            'tittle'        => $tittle,
            'date'          => $date,
            'pembimbing'    => $pembimbing,
            'divisi'        => $divisi,
            'link'          => $link,
            'detail'        => $detail
        );

        $this->M_activity->input_data($data);

        $config_alert_success = array(
            array(
                'title'     => 'Data Berhasil Disimpan ',
                'alert_type' => 'alert-success'
            ),
        );
        $allert_success = allert($config_alert_success);
        $this->session->set_flashdata('msg', $allert_success);
        redirect('Activity/index');
    }

    public function update_data()
    {
        $id = $this->input->post('id_data');
        $id_user = $this->input->post('id_user');
        $tittle = $this->input->post('title');
        $date = $this->input->post('date');
        $pembimbing = $this->input->post('pembimbing');
        $divisi = $this->input->post('divisi');
        $link = $this->input->post('link');
        $detail = $this->input->post('detail');

        $data = array(
            'id_user'       => $id_user,
            'tittle'        => $tittle,
            'date'          => $date,
            'pembimbing'    => $pembimbing,
            'divisi'        => $divisi,
            'link'          => $link,
            'detail'        => $detail
        );

        $where = array(
            'id'    => $id
        );

        $data_image = array(
            'content_id' => $id,
            'user_id'    => $id_user
        );

        $where_image = array('content_id' => -1);
        $this->M_activity->update_data($where, $data, 'kegiatan');
        $this->M_activity->update_data($where_image, $data_image, 'foto');
        $config_alert_success = array(
            array(
                'title'     => 'Data Berhasil di Edit ',
                'alert_type' => 'alert-success'
            ),
        );
        $allert_success = allert($config_alert_success);
        $this->session->set_flashdata('msg', $allert_success);
        redirect('Activity/index');
    }

    public function delete_data($id)
    {
        $where = array('id' => $id);
        $this->M_activity->delete_data($where, 'kegiatan');
        $foto = $this->db->get_where('foto', array('content_id' => $id));
        $image = $foto->result_array();
        foreach ($image as  $val) {
            $token = $val['token'];
            if ($foto->num_rows() > 0) {
                $hasil = $foto->row();
                $nama_foto = $hasil->filename;
                if (file_exists($file = FCPATH . '/upload-foto/' . $val['filename'])) {
                    unlink($file);
                }
                $this->db->delete('foto', array('token' => $token));
            }
        }

        $config_alert_danger = array(
            array(
                'title'     => 'Data Berhasil dihapus',
                'alert_type' => 'alert-warning'
            ),
        );
        $allert_danger = allert($config_alert_danger);
        $this->session->set_flashdata('msg', $allert_danger);
        redirect('Activity/index');
    }
}
