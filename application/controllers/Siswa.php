<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
 public $CI = NULL;
    public function __construct()
    {
        parent::__construct();
        $this->CI = & get_instance();
        $this->load->model('Sekolah_model');
        $this->load->model('Siswa_model');
       // $this->load->model('Siswa_model');
        $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
    }

    public function index($id_sekolah)
    {
        switch ($id_sekolah) {
            case 2 :
                $data['title'] = " Data Siswa SMA";
                break;
            case 3 :
                $data['title'] = " Data Siswa SMP";
                break;
                case 4 :
                    $data['title'] = " Data Siswa SD";
                    break;
                    case 5 :
                        $data['title'] = " Data Siswa TK";
                        break;
                        default :
                        $data['title'] = " Data Siswa";
        }
        
        $data['id_sekolah'] = $id_sekolah;
        $this->load->view('templates/header', $data);
        $this->load->view('admin/siswa', $data);
        $this->load->view('templates/footer', $data);
    }
    
     private function uploadAndResize($name)
    {
        $config['upload_path']          = 'asset/kartu/foto';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['file_name']            =  $name;
        $config['overwrite']            = true;
        $config['max_size']             = 4072;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $gbr = $this->upload->data();
            //Compress Image
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'asset/kartu/foto/' . $gbr['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '70%';
            //$config['width']= 918;
            //$config['height']= 1632;
            $config['new_image'] = 'asset/kartu/foto/' . $gbr['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            return $this->upload->data("file_name");
        } else {
            echo $this->upload->display_errors();
        }

        return "default.png";
    }

     private function stnkUpload($name)
    {
        $config['upload_path']          = 'asset/kartu/stnk';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['file_name']            =  $name;
        $config['overwrite']            = true;
        $config['max_size']             = 4072;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $gbr = $this->upload->data();
            //Compress Image
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'asset/kartu/stnk/' . $gbr['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '70%';
            //$config['width']= 918;
            //$config['height']= 1632;
            $config['new_image'] = 'asset/kartu/stnk/' . $gbr['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            return $this->upload->data("file_name");
        } else {
            echo $this->upload->display_errors();
        }

        return "default.png";
    }


    function check_user_nis($niy)
    {
        $id = $this->input->post('id_siswa');
        $queryId = $this->db->get_where('siswa', ['id_siswa' => $id])->row_array();
        $query = $this->db->get_where('siswa', ['nis' => $niy]);
        if ($query->num_rows() > 0 && $queryId['nis'] !== $niy) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function updateSTNK()
    {
         $nis = htmlspecialchars($this->input->post('nis', true));         
            $where = ['nomor_induk_siswa' => $nis];
            $data = [
                'nomor_induk_siswa' => htmlspecialchars($this->input->post('nis', true)),               
                'tipe_kendaraan' => htmlspecialchars($this->input->post('tipe_kendaraan', true)),
                'nomor_polisi' => htmlspecialchars($this->input->post('no_polisi', true)),
                'foto_stnk' => $this->stnkUpload($nis)                
            ];
            if ($this->Siswa_model->update($where,$data) > 0) {              
               $json = "success";
            } else {
                $json = "failed";
            }
             $jsons = [
            'status' => $json,
            'data_berhasil' => "Data STNK berhasil di update",
            ];
        $this->output->set_content_type('application/json')->set_output(json_encode($jsons));
        
    }

    function doUpdate()
    {
         $nis = htmlspecialchars($this->input->post('nis', true));         
            $where = ['nomor_induk_siswa' => $nis];
            $data = [
                'nomor_induk_siswa' => htmlspecialchars($this->input->post('nis', true)),
                'nama_siswa' => htmlspecialchars($this->input->post('nama', true)),
                'jk' => htmlspecialchars($this->input->post('jk', true)),
                'tempat_lahir' => htmlspecialchars($this->input->post('tempat_lahir', true)),
                'tanggal_lahir' => htmlspecialchars($this->input->post('tanggal_lahir', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'tipe_kendaraan' => htmlspecialchars($this->input->post('tipe_kendaraan', true)),
                'nomor_polisi' => htmlspecialchars($this->input->post('no_polisi', true)),
                'foto_siswa' => $this->uploadAndResize($nis)                
            ];
            if ($this->Siswa_model->update($where,$data) > 0) {
                $this->load->library('ciqrcode'); //pemanggilan library QR CODE
                $config['cacheable']    = true; //boolean, the default is true
                $config['cachedir']     = './assets/'; //string, the default is application/cache/
                $config['errorlog']     = './assets/'; //string, the default is application/logs/
                $config['imagedir']     = './asset/kartu/qr/'; //direktori penyimpanan qr code
                $config['quality']      = true; //boolean, the default is true
                $config['size']         = '1024'; //interger, the default is 1024
                $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
                $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
                $this->ciqrcode->initialize($config);

                $image_name = $nis . '.png'; //buat name dari qr code sesuai dengan nip

                $params['data'] = $nis; //data yang akan di jadikan QR CODE
                $params['level'] = 'H'; //H=High
                $params['size'] = 10;
                $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
                $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
               $json = "success";
            } else {
                $json = "failed";
            }
             $jsons = [
            'status' => $json,
            'data_berhasil' => "Data siswa berhasil di update",
            ];
        $this->output->set_content_type('application/json')->set_output(json_encode($jsons));
        
    }
    // AKHIR update SISWA

    public function get_data_siswa($id_sekolah)
    {
        $hasil = $this->Siswa_model->get_datatables($id_sekolah);
        // var_dump($hasil);
        // die;

        $data = [];
        $no = $_POST['start'];
        //pengulangan sesuai tabel yang ingin ditampilkan
        foreach ($hasil as $h) {
            $baris = [];
            $baris[] = ++$no; //nomor ururt
            $baris[] = $h->nomor_induk_siswa; // nama field yang mau ditampilkan
            $baris[] = $h->nama_siswa; // nama field yang mau ditampilkan
            $baris[] = '<div class="text-center">            
            <a class="btn btn-sm btn-success" href="#" title="Print" onclick="byid(' . "'" . $h->nomor_induk_siswa ."/".$h->id_jenjang. "', 'print'" . ')"><i class="fas fa-print"></i></a>
            <a class="btn btn-sm btn-info" href="#" title="Edit" onclick="byid(' . "'" . $h->id_siswa . "', 'edit'" . ')"><i class="fas fa-edit"></i></a>
			<a class="btn btn-sm btn-danger" href="#" title="Hapus" onclick="byid(' . "'" . $h->id_siswa . "', 'hapus'" . ')"><i class="fas fa-trash-alt"></i></a></div>';
            $data[] = $baris;
        }
        
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Siswa_model->count_all($id_sekolah),
            "recordsFiltered" => $this->Siswa_model->count_filtered($id_sekolah),
            "data" => $data,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function byid($id)
    {
        $data = $this->Siswa_model->get_by_id($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function print($id)
    {
        $data = $this->Sekolah_model->get_by_id();
        $ids = $data['id_desain'];
        if ($ids == 1) {
            $data['sekolah'] = $this->Sekolah_model->get_by_id();
            $data['s'] = $this->Siswa_model->get_by_id($id);
            $this->load->view('print2', $data);
        } else {
            $data['sekolah'] = $this->Sekolah_model->get_by_id();
            $data['s'] = $this->Siswa_model->get_by_id($id);
            $this->load->view('print2', $data);
        }
    }

    public function print_single($nis,$idsekolah)
    {                 
        $data = $this->Sekolah_model->get_by_id($idsekolah);
        $ids = $data['id_desain'];
        $this->makeQR($nis);
        $id = $nis;
        if ($ids == 1) {
            $data['sekolah'] = $this->Sekolah_model->get_by_id($idsekolah);
            $data['s'] = $this->Siswa_model->getSiswaDanKartu($id);            
            $this->load->view('print4', $data);
        } else {
            $id = $this->session->userdata('nis');
            $data['sekolah'] = $this->Sekolah_model->get_by_id($idsekolah);
            $data['s'] = $this->Siswa_model->get_by_id($id);
            $this->load->view('print3', $data);
        }
    }

     

    private function makeQR($data){
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['cacheable'] = true; //boolean, the default is true
        $config['cachedir'] = './assets/'; //string, the default is application/cache/
        $config['errorlog'] = './assets/'; //string, the default is application/logs/
        $config['imagedir'] = './asset/kartu/qr/'; //direktori penyimpanan qr code
        $config['quality'] = true; //boolean, the default is true
        $config['size'] = '1024'; //interger, the default is 1024
        $config['black'] = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white'] = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $data . '.png'; //buat name dari qr code sesuai dengan nis

        $params['data'] = base_url('detail_siswa/').$data; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params);
    }


    public function hapus_data_siswa($id)
    {
        if ($this->Siswa_model->delete_by_id($id) > 0) {
            $output = [
                'success'   => true,
            ];
        } else {
            $output = [
                'success'   => false,
            ];
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function cutText($text, $length, $mode = 2)
    {
    $num_char = "";
    if ($mode != 1)
    {
    $char = $text{$length - 1};
    switch($mode)
    {
    case 2:
    while($char != ' ') {
    $char = $text{--$length};
    }
    case 3:
    while($char != ' ') {
    $char = $text{++$num_char};
    }
    }
    }
    return substr($text, 0, $length);
    }

  /*  public function edit_data_siswa()
    {
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required', [
            'required' => 'Kelas tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_pk', 'Jurusan', 'required', [
            'required' => 'Jurusan tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Nama tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Password tidak boleh kosong!'
        ]);
        $data = [ 'id_kelas' => htmlspecialchars($this->input->post('id_kelas', true)), 'id_pk' => htmlspecialchars($this->input->post('id_pk', true)), 'nis' => htmlspecialchars($this->input->post('nis', true)), 'nama' => htmlspecialchars($this->input->post('nama', true)), 'username' => htmlspecialchars($this->input->post('username', true)), 'password' => htmlspecialchars($this->input->post('password', true)), ];
        if ($this->form_validation->run() == FALSE) {
            $output = [
                'error'   => true,
                'id_kelas_error' => form_error('id_kelas'),
                'id_pk_error' => form_error('id_pk'),
                'nama_error' => form_error('nama'),
                'password_error' => form_error('password'),
            ];
        } else {
            if ($this->Siswa_model->update(['id_siswa' => $this->input->post('id_siswa')], $data) > 0) {
                $output = [
                    'success'   => true,
                ];
            } else {
                $output = [
                    'success'   => false,
                ];
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    } */

     public function edit_data($id)
    {        
        //$data['sekolah'] = $this->Sekolah_model->get_by_id();
        $data['siswa'] = $this->Siswa_model->get_siswa_id($id);
        $data['title'] = "Ubah Data Siswa";
        $this->load->view('templates/header', $data);
        $this->load->view('siswa/data_siswa', $data);
        $this->load->view('templates/footer_siswa');
    }


}