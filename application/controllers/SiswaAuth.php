<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SiswaAuth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Halaman Login';
        $this->load->view('masuk_siswa', $data);
    }

    public function error()
    {
        $data['title'] = 'Ooops error';
        $this->load->view('error', $data);
    }

    public function login()
    {
        $username = $this->input->post('username'); // Ambil isi dari inputan username pada form login
        $password = $this->input->post('password'); // Ambil isi dari inputan password pada form login dan encrypt dengan md5
        $user = $this->AuthModel->get($username); // Panggil fungsi get yang ada di UserModel.php        
        if (empty($user)) { // Jika hasilnya kosong / user tidak ditemukan
            $this->session->set_flashdata('message', '<div class ="alert alert-danger" role= "alert">Username belum terdaftar!</div>'); // Buat session flashdata
            redirect('SiswaAuth'); // Redirect ke halaman login
        } else {
            if (password_verify($password, $user['password'])) { // Jika password yang diinput sama dengan password yang didatabase
                $session =
                    array(

                        'nis' => $user['username'],  // Buat session username
                        'level' => 'siswa',  // Buat session level
                    );
                $this->session->set_userdata($session); // Buat session sesuai $session
                redirect('DashboardSiswa'); // Redirect ke halaman welcome
            } else {
                $this->session->set_flashdata('message', '<div class ="alert alert-danger" role= "alert">Password salah!</div>'); // Buat session flashdata
                redirect('SiswaAuth'); // Redirect ke halaman login
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('nis');
        $this->session->unset_userdata('level');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil keluar!</div>');
        redirect('SiswaAuth');
    }
}
