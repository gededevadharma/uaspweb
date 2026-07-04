<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Peminjam_model extends CI_Model {

    public function get_all($limit = null, $start = null, $search = '')
    {
        $this->db->order_by('created_at', 'DESC');
        if ($search) {
            $this->db->like('nama', $search);
            $this->db->or_like('no_hp', $search);
        }
        if ($limit) $this->db->limit($limit, $start);
        return $this->db->get('peminjam')->result();
    }

    public function count_all($search = '')
    {
        if ($search) {
            $this->db->like('nama', $search);
            $this->db->or_like('no_hp', $search);
        }
        return $this->db->count_all_results('peminjam');
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('peminjam', ['id' => $id])->row();
    }

    public function get_by_nama($nama)
    {
        return $this->db->get_where('peminjam', ['nama' => $nama])->row();
    }

    public function search($q)
    {
        $this->db->like('nama', $q);
        $this->db->or_like('no_hp', $q);
        $this->db->limit(10);
        return $this->db->get('peminjam')->result();
    }

    public function insert($data)
    {
        $this->db->insert('peminjam', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        return $this->db->update('peminjam', $data, ['id' => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete('peminjam', ['id' => $id]);
    }

    public function count_all_peminjam()
    {
        return $this->db->count_all('peminjam');
    }
}
