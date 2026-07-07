<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Peminjaman_model extends CI_Model {

    public function get_all($limit = null, $start = null, $search = '', $status = '')
    {
        $this->db->select('peminjaman.*, peminjam.nama as nama_peminjam, peminjam.no_hp, peminjam.alamat, buku.judul as judul_buku, buku.pengarang, buku.penerbit, buku.isbn');
        $this->db->from('peminjaman');
        $this->db->join('peminjam', 'peminjam.id = peminjaman.peminjam_id', 'left');
        $this->db->join('buku', 'buku.id = peminjaman.buku_id', 'left');
        $this->db->order_by('peminjaman.created_at', 'DESC');
        if ($search) {
            $this->db->like('peminjam.nama', $search);
            $this->db->or_like('buku.judul', $search);
        }
        if ($status == 'terlambat') {
            $this->db->where('peminjaman.status', 'dipinjam');
            $this->db->where('peminjaman.tgl_kembali <', date('Y-m-d'));
        } elseif ($status) {
            $this->db->where('peminjaman.status', $status);
        }
        if ($limit) $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    public function count_all($search = '', $status = '')
    {
        $this->db->select('peminjaman.id');
        $this->db->from('peminjaman');
        $this->db->join('peminjam', 'peminjam.id = peminjaman.peminjam_id', 'left');
        $this->db->join('buku', 'buku.id = peminjaman.buku_id', 'left');
        if ($search) {
            $this->db->like('peminjam.nama', $search);
            $this->db->or_like('buku.judul', $search);
        }
        if ($status == 'terlambat') {
            $this->db->where('peminjaman.status', 'dipinjam');
            $this->db->where('peminjaman.tgl_kembali <', date('Y-m-d'));
        } elseif ($status) {
            $this->db->where('peminjaman.status', $status);
        }
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->select('peminjaman.*, peminjam.nama as nama_peminjam, peminjam.no_hp, peminjam.alamat, buku.judul as judul_buku, buku.isbn, buku.pengarang');
        $this->db->from('peminjaman');
        $this->db->join('peminjam', 'peminjam.id = peminjaman.peminjam_id', 'left');
        $this->db->join('buku', 'buku.id = peminjaman.buku_id', 'left');
        $this->db->where('peminjaman.id', $id);
        return $this->db->get()->row();
    }

    public function get_dipinjam_count()
    {
        return $this->db->where('status', 'dipinjam')->count_all_results('peminjaman');
    }

    public function get_dikembalikan_count()
    {
        return $this->db->where('status', 'dikembalikan')->count_all_results('peminjaman');
    }

    public function get_recent($limit = 5)
    {
        $this->db->select('peminjaman.*, peminjam.nama as nama_peminjam, buku.judul as judul_buku');
        $this->db->from('peminjaman');
        $this->db->join('peminjam', 'peminjam.id = peminjaman.peminjam_id', 'left');
        $this->db->join('buku', 'buku.id = peminjaman.buku_id', 'left');
        $this->db->order_by('peminjaman.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function get_by_peminjam($peminjam_id)
    {
        $this->db->select('peminjaman.*, buku.judul as judul_buku');
        $this->db->from('peminjaman');
        $this->db->join('buku', 'buku.id = peminjaman.buku_id', 'left');
        $this->db->where('peminjaman.peminjam_id', $peminjam_id);
        $this->db->order_by('peminjaman.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function insert($data)
    {
        return $this->db->insert('peminjaman', $data);
    }

    public function update($id, $data)
    {
        return $this->db->update('peminjaman', $data, ['id' => $id]);
    }
}
