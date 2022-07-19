<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_activity extends CI_Model
{
    public function get_data($perpage, $start, $id_user)
    {
        $this->db->select('*');
        $this->db->from('kegiatan');
        // $this->db->join('foto', 'foto.content_id=kegiatan.ID', 'left');
        $this->db->limit($perpage, $start);
        $this->db->where('kegiatan.id_user', $id_user);
        $query = $this->db->get();
        return $query;
    }

    public function get_activity($id_user)
    {
        $this->db->select('*');
        $this->db->from('kegiatan');
        $this->db->where('kegiatan.id_user', $id_user);
        $query = $this->db->get();
        return $query;
    }

    public function get_foto($id)
    {
        $this->db->select('*');
        $this->db->from('foto');
        $this->db->where('content_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function args_data($id)
    {
        $this->db->select('*');
        $this->db->from('kegiatan');
        // $this->db->join('foto', 'foto.content_id=kegiatan.ID', 'left');
        $this->db->where('kegiatan.ID', $id);
        $query = $this->db->get();
        return $query;
    }

    public function get_keyword($keyword, $perpage, $start,  $id_user)
    {
        $this->db->select('*');
        $this->db->where('id_user', $id_user);
        $this->db->group_start(); // Penggunaan group_start & group_end Untuk melakukan query where dan like or like
        $this->db->limit($perpage, $start);
        $this->db->like('tittle', $keyword);
        $this->db->or_like('link', $keyword);
        $this->db->or_like('detail', $keyword);
        $this->db->group_end();
        $this->db->from('kegiatan');
        // $this->db->join('foto', 'foto.content_id=kegiatan.ID', 'left');
        return $this->db->get();
    }

    function get_mentor_name($name_id = '')
    {
        $this->db->select('user_name');
        $this->db->from('pembimbing');
        $this->db->where('user_id', $name_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_divisi_name($id = '')
    {
        $this->db->select('team_name');
        $this->db->from('divisi');
        $this->db->where('team_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_data($id)
    {
        $this->db->from('kegiatan');
        $this->db->where('id_user', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function option_pembimbing()
    {
        $this->db->from('pembimbing');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function option_divisi()
    {
        $res = $this->db->get('divisi');
        return $res->result_array();
    }

    public function input_data($data)
    {

        $this->db->insert('kegiatan', $data);
        $id = $this->db->insert_id();
        $data = array(
            'user_id'       => $data['id_user'],
            'content_id'    => $id
        );
        $where = array(
            'content_id'    => -1
        );

        $this->update_data($where, $data, 'foto');
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function delete_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
