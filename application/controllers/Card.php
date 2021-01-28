<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Card extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_siswa_login();
        $this->load->model('Sekolah_model');
        $this->load->model('Siswa_model');
        $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
    }

    public function index()
    {
        $data['sekolah'] = $this->Sekolah_model->get_by_id();
        $data['siswa'] = $this->Siswa_model->get_by_id($this->session->userdata('nis'));
        $data['title'] = " Data Siswa";
        $this->load->view('siswa/kartu_siswa', $data);
    }

    public function print_single()
    {
         is_siswa_login();
        $data = $this->Sekolah_model->get_by_id();
        $ids = $data['id_desain'];
        $id = $this->session->userdata('nis');
        if ($ids == 1) {
            $data['sekolah'] = $this->Sekolah_model->get_by_id();
            $data['s'] = $this->Siswa_model->get_by_id($id);
            $this->load->view('print4', $data);
        } else {
            $id = $this->session->userdata('nis');
            $data['sekolah'] = $this->Sekolah_model->get_by_id();
            $data['s'] = $this->Siswa_model->get_by_id($id);
            $this->load->view('print3', $data);
        }
    }
   
}
