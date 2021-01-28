<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardSiswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_siswa_login();
        $this->load->model('Siswa_model');
        $this->load->model('Sekolah_model');
    }

    public function index()
    {
        is_siswa_login();
        $data['sekolah'] = $this->Sekolah_model->get_by_id();
        $data['siswa'] = $this->Siswa_model->get_by_id($this->session->userdata('nis'));
        $data['title'] = " Dashboard";
        $this->load->view('templates/header_siswa', $data);
        $this->load->view('siswa/siswa_dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function edit_data()
    {
        is_siswa_login();
        $data['sekolah'] = $this->Sekolah_model->get_by_id();
        $data['siswa'] = $this->Siswa_model->get_by_id($this->session->userdata('nis'));
        $data['title'] = " Data Siswa";
        $this->load->view('templates/header_siswa', $data);
        $this->load->view('siswa/data_siswa', $data);
        $this->load->view('templates/footer');
    }
}
