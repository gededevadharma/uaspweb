<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Peminjaman extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['judul'] = 'Kelola Peminjaman';
        $search = $this->input->get('search');
        $status = $this->input->get('status');
        $page   = $this->input->get('page') ?: 1;
        $limit  = 10;
        $start  = ($page - 1) * $limit;

        $data['peminjaman'] = $this->peminjaman_model->get_all($limit, $start, $search, $status);
        $data['total']      = $this->peminjaman_model->count_all($search, $status);
        $data['limit']      = $limit;
        $data['search']     = $search;
        $data['status_filter'] = $status;
        $data['page']       = $page;
        $data['start']      = $start;

        $this->load->view('templates/admin_header', $data);
        $this->load->view('peminjaman/list', $data);
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Peminjaman';
        $data['buku']  = $this->buku_model->get_all();

        $this->form_validation->set_rules('nama', 'Nama Peminjam', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'trim|max_length[20]');
        $this->form_validation->set_rules('buku_id', 'Buku', 'required|numeric');
        $this->form_validation->set_rules('tgl_pinjam', 'Tanggal Pinjam', 'required|trim');
        $this->form_validation->set_rules('tgl_kembali', 'Tanggal Kembali', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('peminjaman/form', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $buku = $this->buku_model->get_by_id($this->input->post('buku_id'));
            if (!$buku || $buku->tersedia < 1) {
                $this->session->set_flashdata('error', 'Buku tidak tersedia!');
                redirect('peminjaman/tambah');
            }

            $this->db->trans_start();

            $peminjam_id = $this->peminjam_model->insert([
                'nama'   => $this->input->post('nama', true),
                'no_hp'  => $this->input->post('no_hp', true),
                'alamat' => $this->input->post('alamat', true),
            ]);

            $this->peminjaman_model->insert([
                'peminjam_id' => $peminjam_id,
                'buku_id'     => $this->input->post('buku_id'),
                'tgl_pinjam'  => $this->input->post('tgl_pinjam'),
                'tgl_kembali' => $this->input->post('tgl_kembali'),
                'status'      => 'dipinjam'
            ]);
            $this->buku_model->kurangi_tersedia($this->input->post('buku_id'));

            $this->db->trans_complete();

            if ($this->db->trans_status()) {
                $this->session->set_flashdata('success', 'Peminjaman berhasil dicatat!');
            } else {
                $this->session->set_flashdata('error', 'Gagal mencatat peminjaman!');
            }
            redirect('peminjaman');
        }
    }

    public function kembali($id)
    {
        $peminjaman = $this->peminjaman_model->get_by_id($id);
        if (!$peminjaman) {
            $this->session->set_flashdata('error', 'Data peminjaman tidak ditemukan!');
            redirect('peminjaman');
        }
        if ($peminjaman->status != 'dipinjam') {
            $this->session->set_flashdata('error', 'Buku sudah dikembalikan!');
            redirect('peminjaman');
        }

        $this->db->trans_start();
        $this->peminjaman_model->update($id, [
            'tgl_dikembalikan' => date('Y-m-d'),
            'status'           => 'dikembalikan'
        ]);
        $this->buku_model->tambah_tersedia($peminjaman->buku_id);
        $this->db->trans_complete();

        if ($this->db->trans_status()) {
            $this->session->set_flashdata('success', 'Buku berhasil dikembalikan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengembalikan buku!');
        }
        redirect('peminjaman');
    }
}
