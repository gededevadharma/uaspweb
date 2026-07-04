<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class User_model extends CI_Model {

    public function get_all($limit = null, $start = null, $search = '')
    {
        $this->db->order_by('created_at', 'DESC');
        if ($search) {
            $this->db->like('username', $search);
            $this->db->or_like('nama', $search);
            $this->db->or_like('email', $search);
        }
        if ($limit) $this->db->limit($limit, $start);
        return $this->db->get('users')->result();
    }

    public function count_all($search = '')
    {
        if ($search) {
            $this->db->like('username', $search);
            $this->db->or_like('nama', $search);
            $this->db->or_like('email', $search);
        }
        return $this->db->count_all_results('users');
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    public function get_by_username($username)
    {
        return $this->db->get_where('users', ['username' => $username])->row();
    }

    public function insert($data)
    {
        return $this->db->insert('users', $data);
    }

    public function update($id, $data)
    {
        return $this->db->update('users', $data, ['id' => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete('users', ['id' => $id]);
    }

    public function login($username, $password)
    {
        $user = $this->get_by_username($username);
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }

    public function count_member()
    {
        return $this->db->where('level', 'member')->count_all_results('users');
    }

    public function count_admin()
    {
        return $this->db->where('level', 'admin')->count_all_results('users');
    }
}
