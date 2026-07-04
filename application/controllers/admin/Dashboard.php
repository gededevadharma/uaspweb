<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/login');
        }
    }

    public function index()
    {
        $data['judul']              = 'Dashboard';
        $data['user']               = $this->session->userdata();
        $data['total_buku']         = $this->buku_model->count_all();
        $data['total_peminjam']     = $this->peminjam_model->count_all_peminjam();
        $data['total_dikembalikan'] = $this->peminjaman_model->get_dikembalikan_count();
        $data['peminjaman_terbaru'] = $this->peminjaman_model->get_recent(5);
        $data['buku_terbaru']       = $this->buku_model->get_all(5);
        $data['peminjam_terbaru']   = $this->peminjam_model->get_all(5);

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/dashboard/index', $data);
        $this->load->view('templates/admin_footer');
    }
}
