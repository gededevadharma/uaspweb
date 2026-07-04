<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Buku extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/login');
        }
    }

    public function index()
    {
        $data['judul'] = 'Kelola Buku';
        $search = $this->input->get('search');
        $page   = $this->input->get('page') ?: 1;
        $limit  = 10;
        $start  = ($page - 1) * $limit;
        $data['buku']   = $this->buku_model->get_all($limit, $start, $search);
        $data['total']  = $this->buku_model->count_all($search);
        $data['limit']  = $limit;
        $data['search'] = $search;
        $data['page']   = $page;
        $data['start']  = $start;

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/buku/list', $data);
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Buku';
        $this->form_validation->set_rules('judul', 'Judul Buku', 'required|trim|max_length[200]');
        $this->form_validation->set_rules('pengarang', 'Pengarang', 'trim|max_length[150]');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|max_length[150]');
        $this->form_validation->set_rules('isbn', 'ISBN', 'trim|is_unique[buku.isbn]|max_length[20]');
        $this->form_validation->set_rules('tahun', 'Tahun', 'trim|numeric|exact_length[4]');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|numeric|greater_than[0]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/buku/form', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $input = [
                'judul'     => $this->input->post('judul', true),
                'pengarang' => $this->input->post('pengarang', true),
                'penerbit'  => $this->input->post('penerbit', true),
                'isbn'      => $this->input->post('isbn', true),
                'tahun'     => $this->input->post('tahun', true),
                'jumlah'    => $this->input->post('jumlah', true) ?: 1,
                'deskripsi' => $this->input->post('deskripsi', true),
            ];
            $input['tersedia'] = $input['jumlah'];
            if ($this->buku_model->insert($input)) {
                $this->session->set_flashdata('success', 'Buku berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan buku!');
            }
            redirect('admin/buku');
        }
    }

    public function edit($id)
    {
        $data['judul'] = 'Edit Buku';
        $data['buku']  = $this->buku_model->get_by_id($id);
        if (!$data['buku']) {
            $this->session->set_flashdata('error', 'Buku tidak ditemukan!');
            redirect('admin/buku');
        }

        $isbn_lama = $data['buku']->isbn;
        $isbn_baru = $this->input->post('isbn');
        $isbn_unique = ($isbn_baru && $isbn_baru != $isbn_lama) ? '|is_unique[buku.isbn]' : '';

        $this->form_validation->set_rules('judul', 'Judul Buku', 'required|trim|max_length[200]');
        $this->form_validation->set_rules('pengarang', 'Pengarang', 'trim|max_length[150]');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|max_length[150]');
        $this->form_validation->set_rules('isbn', 'ISBN', 'trim' . $isbn_unique . '|max_length[20]');
        $this->form_validation->set_rules('tahun', 'Tahun', 'trim|numeric|exact_length[4]');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/buku/form', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $input = [
                'judul'     => $this->input->post('judul', true),
                'pengarang' => $this->input->post('pengarang', true),
                'penerbit'  => $this->input->post('penerbit', true),
                'isbn'      => $this->input->post('isbn', true),
                'tahun'     => $this->input->post('tahun', true),
                'deskripsi' => $this->input->post('deskripsi', true),
            ];
            $jumlah_baru = $this->input->post('jumlah', true);
            if ($jumlah_baru !== '' && $jumlah_baru !== null) {
                $selisih = $jumlah_baru - $data['buku']->jumlah;
                $input['jumlah']   = $jumlah_baru;
                $input['tersedia'] = $data['buku']->tersedia + $selisih;
            }
            if ($this->buku_model->update($id, $input)) {
                $this->session->set_flashdata('success', 'Buku berhasil diperbarui!');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui buku!');
            }
            redirect('admin/buku');
        }
    }

    public function hapus($id)
    {
        $buku = $this->buku_model->get_by_id($id);
        if (!$buku) {
            $this->session->set_flashdata('error', 'Buku tidak ditemukan!');
            redirect('admin/buku');
        }
        if ($this->buku_model->delete($id)) {
            $this->session->set_flashdata('success', 'Buku berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus buku!');
        }
        redirect('admin/buku');
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Buku';
        $data['buku']  = $this->buku_model->get_by_id($id);
        if (!$data['buku']) {
            $this->session->set_flashdata('error', 'Buku tidak ditemukan!');
            redirect('admin/buku');
        }
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/buku/detail', $data);
        $this->load->view('templates/admin_footer');
    }
}
