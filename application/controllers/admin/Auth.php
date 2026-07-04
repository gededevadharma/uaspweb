<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function login()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('admin/dashboard');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Login Admin';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('admin/auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $username = $this->input->post('username', true);
            $password = $this->input->post('password', true);
            $user = $this->user_model->login($username, $password);

            if ($user) {
                $sess_data = [
                    'id'        => $user->id,
                    'username'  => $user->username,
                    'nama'      => $user->nama,
                    'level'     => $user->level,
                    'logged_in' => TRUE
                ];
                $this->session->set_userdata($sess_data);
                $this->session->set_flashdata('success', 'Selamat datang, ' . $user->nama . '!');
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah!');
                redirect('admin/login');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/login');
    }
}
