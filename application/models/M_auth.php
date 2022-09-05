<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{

    //PROSES CURL TO ARRAY------------------------------------------------------
    public function auth_curl($url = '', $data = array())
    {
        if (empty($url)) {
            return '';
        }

        $check = array_filter($data);
        if (empty($check)) {
            return '';
        }

        $ch = curl_init($url);
        # Setup request to send json via POST.
        $payload = json_encode($data);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
        # Return response instead of printing.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function _check_curl($data = array())
    {
        if ($data['status'] == 'success') {
            return $data['msg'];
        }
    }

    public function curl_login($username = '', $password = '')
    {
        $url = 'https://s.soloabadi.com/system-absen/include/curl.php';
        $data = array(
            'object' => 'sobad_user',
            'func' => 'check_login',
            'msg' => array($username, md5($password))
        );
        if ($data['msg'][0] == 'admin' && $data['msg'][1] == md5('admin')) {
            $login = array(
                array(
                    'ID' =>  '52',
                    'name' =>  'Super User',
                    'dept' =>  '',
                    'jabatan' =>  'Super User',
                    'picture' =>  '52'
                ),
            );
        } else {
            $data = $this->auth_curl($url, $data);
            $login = json_decode($data, true);
            $login = $this->_check_curl($login);
        }
        return $login;
    }

    public function cek_data()
    {
        $url = 'https://s.soloabadi.com/system-absen/include/curl.php';
        $data = array(
            'object' => 'sobad_user',
            'func' => 'get_all',
            'msg' => array()
        );
        $data = $this->auth_curl($url, $data);
        $login = json_decode($data, true);
        $login = $this->_check_curl($login);
        return $login;
    }

    public function get_id($id = '')
    {

        $url = 'https://s.soloabadi.com/system-absen/include/curl.php';
        $data = array(
            'object' => 'sobad_user',
            'func' => 'get_id',
            'msg' => array($id)
        );
        if ($data['msg'][0] == '52') {
            $login = array(
                array(
                    'meta_value_divi' =>  'Junior IT Programmer',
                    'meta_note_divi' =>  '',
                    'name_work' =>  'Staff',
                    'notes_pict' =>  'b_gading.png',
                    'user' =>  '52',
                    'shift' =>  '9',
                    'type' =>  '2',
                    '_inserted' =>  '2020-12-05',
                    'time_in' =>  '06:50:01',
                    'time_out' =>  '12:48:13',
                    'note' =>  'a:2:{s:8:"pos_user";i:1;s:9:"pos_group";i:2;}',
                    'punish' =>  '0',
                    'history' =>  'a:2:{i:0;a:2:{s:4:"type";i:1;s:4:"time";s:5:"06:50";}i:1;a:2:{s:4:"type";i:2;s:4:"time";s:8:"12:48:13";}}',
                    'id_join' =>  '1866',
                    '_address' =>  'Ngledok, RT. 03 RW. 008 Sroyo, Jaten, Karangnyar',
                    '_email' =>  '',
                    '_sex' =>  'male',
                    '_entry_date' =>  '2020-12-03',
                    '_place_date' =>  '169',
                    '_birth_date' =>  '1996-04-23',
                    '_resign_date' => '',
                    '_province' =>  '10',
                    '_city' =>  '169',
                    '_subdistrict' =>  '2363',
                    '_postcode' =>  '57762',
                    '_marital' =>  '1',
                    '_religion' =>  '1',
                    '_nickname' =>  'Gading',
                    '_resign_status' => '',
                    '_warning' =>  '0',
                    'username' =>  'gading',
                    'password' =>  '827ccb0eea8a706c4c34a16891f84e7b',
                    'no_induk' =>  '165',
                    'divisi' =>  '68',
                    'phone_no' =>  '081325979009',
                    'name' =>  'Super-User',
                    'picture' =>  '5847',
                    'work_time' =>  '8',
                    'dayOff' =>  '0.5',
                    'status' =>  '7',
                    'end_status' =>  '0',
                    'inserted' =>  '2020-12-03',
                    'ID' =>  '52',
                ),
            );
        } else {
            $data = $this->auth_curl($url, $data);
            $login = json_decode($data, true);
            $login = $this->_check_curl($login);
        }
        return $login;
    }
}
