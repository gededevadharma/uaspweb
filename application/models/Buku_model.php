<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Buku_model extends CI_Model {

    public function get_all($limit = null, $start = null, $search = '')
    {
        $this->db->order_by('created_at', 'DESC');
        if ($search) {
            $this->db->like('judul', $search);
            $this->db->or_like('pengarang', $search);
            $this->db->or_like('penerbit', $search);
            $this->db->or_like('isbn', $search);
        }
        if ($limit) $this->db->limit($limit, $start);
        return $this->db->get('buku')->result();
    }

    public function count_all($search = '')
    {
        if ($search) {
            $this->db->like('judul', $search);
            $this->db->or_like('pengarang', $search);
            $this->db->or_like('penerbit', $search);
            $this->db->or_like('isbn', $search);
        }
        return $this->db->count_all_results('buku');
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('buku', ['id' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert('buku', $data);
    }

    public function update($id, $data)
    {
        return $this->db->update('buku', $data, ['id' => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete('buku', ['id' => $id]);
    }

    public function count_all_buku()
    {
        return $this->db->count_all('buku');
    }

    public function count_total_tersedia()
    {
        $this->db->select_sum('tersedia');
        return $this->db->get('buku')->row()->tersedia;
    }

    public function count_total_jumlah()
    {
        $this->db->select_sum('jumlah');
        return $this->db->get('buku')->row()->jumlah;
    }

    public function get_most_dipinjam($limit = 5)
    {
        $this->db->select('buku.*, COUNT(peminjaman.id) as total_dipinjam');
        $this->db->from('buku');
        $this->db->join('peminjaman', 'peminjaman.buku_id = buku.id', 'left');
        $this->db->group_by('buku.id');
        $this->db->order_by('total_dipinjam', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function tersedia_dipinjam($buku_id, $jumlah = 1)
    {
        $buku = $this->get_by_id($buku_id);
        if ($buku && $buku->tersedia >= $jumlah) {
            return true;
        }
        return false;
    }

    public function kurangi_tersedia($id)
    {
        $this->db->set('tersedia', 'tersedia - 1', FALSE);
        $this->db->where('id', $id);
        $this->db->where('tersedia >', 0);
        return $this->db->update('buku');
    }

    public function tambah_tersedia($id)
    {
        $this->db->set('tersedia', 'tersedia + 1', FALSE);
        $this->db->where('id', $id);
        return $this->db->update('buku');
    }
}
