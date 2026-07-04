<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Peminjam extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/login');
        }
    }

    public function index()
    {
        $data['judul'] = 'Data Peminjam';
        $search = $this->input->get('search');
        $page   = $this->input->get('page') ?: 1;
        $limit  = 10;
        $start  = ($page - 1) * $limit;
        $data['peminjam'] = $this->peminjam_model->get_all($limit, $start, $search);
        $data['total']    = $this->peminjam_model->count_all($search);
        $data['limit']    = $limit;
        $data['search']   = $search;
        $data['page']     = $page;
        $data['start']    = $start;

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/peminjam/list', $data);
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Peminjam';
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'trim|max_length[20]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/peminjam/form', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $input = [
                'nama'   => $this->input->post('nama', true),
                'no_hp'  => $this->input->post('no_hp', true),
                'alamat' => $this->input->post('alamat', true),
            ];
            if ($this->peminjam_model->insert($input)) {
                $this->session->set_flashdata('success', 'Peminjam berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan peminjam!');
            }
            redirect('admin/peminjam');
        }
    }

    public function edit($id)
    {
        $data['judul']  = 'Edit Peminjam';
        $data['peminjam'] = $this->peminjam_model->get_by_id($id);
        if (!$data['peminjam']) {
            $this->session->set_flashdata('error', 'Peminjam tidak ditemukan!');
            redirect('admin/peminjam');
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'trim|max_length[20]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/peminjam/form', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $input = [
                'nama'   => $this->input->post('nama', true),
                'no_hp'  => $this->input->post('no_hp', true),
                'alamat' => $this->input->post('alamat', true),
            ];
            if ($this->peminjam_model->update($id, $input)) {
                $this->session->set_flashdata('success', 'Peminjam berhasil diperbarui!');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui peminjam!');
            }
            redirect('admin/peminjam');
        }
    }

    public function hapus($id)
    {
        if ($this->peminjam_model->delete($id)) {
            $this->session->set_flashdata('success', 'Peminjam berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus peminjam!');
        }
        redirect('admin/peminjam');
    }
}
