<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_admin();
        $this->load->model('Sekolah_model');
        $this->load->model('Siswa_model');
    }

    public function index()
    {
        
       // $data['sekolah'] = $this->Sekolah_model->get_by_id();
        $data['total_siswa'] = $this->Siswa_model->count_all_siswa();
        $data['total_sekolah'] = $this->Sekolah_model->count_all();
        $data['title'] = "Dashboard";        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer', $data);
    }
}
